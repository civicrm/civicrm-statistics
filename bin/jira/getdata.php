<?php
require_once(dirname(__DIR__) . '/config.php');
$projects = array(
  'CRM',
);

// Initialize database and prepared statements
$dbh = new PDO('mysql:dbname='.DBNAME.';host='.DBHOST, DBUSER, DBPASS);
$stm_id = $dbh->prepare("
  DELETE FROM jira_issue WHERE issue=:issue
");
$stm_ii = $dbh->prepare("
  INSERT INTO jira_issue (jira_id, project, issue, summary, type, priority, security, reporter, assignee, status, resolution, created, updated, resolved)
  VALUES (:jira_id, :project, :issue, :summary, :type, :priority, :security, :reporter, :assignee, :status, :resolution, :created, :updated, :resolved);
");
$stm_vd = $dbh->prepare("
  DELETE FROM jira_version WHERE issue=:issue;
");
$stm_vi = $dbh->prepare("
  INSERT INTO jira_version (issue, type, version)
  VALUES (:issue, :type, :version);
");

// Initialize JIRA REST API
require_once('common.php');
$api = getApiClient();
$walker = new \chobie\Jira\Issues\Walker($api);

foreach ($projects as $project) {
  // Get the latest updated timestamp from the database and find all issues created or updated after that
  $result = $dbh->query("SELECT MAX(updated) FROM jira_issue WHERE project='$project';")->fetch();
  if (empty($result[0])) $result[0] = DATESTART;
  // For some reason JQL does NOT accept seconds in datetime
  $datetime = substr($result[0], 0, -3);
  // the ORDER BY is critical to catching all updated/created issues incrementally
  // DO NOT try to sort based on issueKey as this will break the incremental updates!
  $jqlquery = "project = '$project' AND updated >= '$datetime' ORDER BY updated ASC";
  $walker->push($jqlquery, "*navigable");

  $count = 0;
  foreach ($walker as $k => $issue) {
    // Clean-up if we already had this issue in the database
    $params = array(
      ':issue' => $issue->getKey(),
    );
    $stm_id->execute($params);
    // Create or Update the issue itself
    $issueType = $issue->getIssueType();
    $priority = $issue->getPriority();
    $security = $issue->get('Security Level');
    $reporter = $issue->getReporter();
    $assignee = $issue->getAssignee();
    $status = $issue->getStatus();
    $resolution = $issue->getResolution();
    $params = array(
      ':jira_id' => $issue->getId(),
      ':project' => $project,
      ':issue' => $issue->getKey(),
      ':summary' => substr($issue->getSummary(), 0, 128),
      ':type' => $issueType['name'],
      ':priority' => $priority['name'],
      ':security' => ($security ? $security['name'] : NULL),
      ':reporter' => $reporter['name'],
      ':assignee' => $assignee['name'],
      ':status' => $status['name'],
      ':resolution' => $resolution['name'],
      ':created' => date('Y-m-d H:i:s', strtotime($issue->getCreated())),
      ':updated' => date('Y-m-d H:i:s', strtotime($issue->getUpdated())),
      ':resolved' => date('Y-m-d H:i:s', strtotime($issue->get('Resolved'))),
    );
    if (!$stm_ii->execute($params)) {
      $errorInfo = $stm_ii->errorInfo();
      echo $errorInfo[2] . PHP_EOL;
    }

    // Clean-up if we already had this issue in the database
    $stm_vd->execute(array(':issue' => $issue->getKey()));
    // Create or Update the affects and fix version references
    foreach (array('Affects', 'Fix') as $type) {
      $params = array(
        ':issue' => $issue->getKey(),
        ':type' => $type,
      );
      $versions = $issue->get("$type Version/s");
      foreach ($versions as $version) {
        $params[':version'] = $version['name'];
        $stm_vi->execute($params);
      }
    }

    // Limit as otherwise the walker goes through the whole database
    $count++;
    if ($count >= 1000) break;
  }
  echo "$project: $count issue(s) created or updated" . PHP_EOL;
}
