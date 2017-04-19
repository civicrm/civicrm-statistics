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
    $stm_id->bindParam(':issue', $issue->getKey());
    $stm_id->execute();   
    // Create or Update the issue itself
    $stm_ii->bindParam(':jira_id', $issue->getId());
    $stm_ii->bindParam(':project', $project);
    $stm_ii->bindParam(':issue', $issue->getKey());
    $stm_ii->bindParam(':summary', $issue->getSummary());
    $issueType = $issue->getIssueType();
    $stm_ii->bindParam(':type', $issueType['name']);
    $priority = $issue->getPriority();
    $stm_ii->bindParam(':priority', $priority['name']);
    $security = $issue->get('Security Level');
    $stm_ii->bindValue(':security', $security ? $security['name'] : NULL);
    $reporter = $issue->getReporter();
    $stm_ii->bindParam(':reporter', $reporter['name']);
    $assignee = $issue->getAssignee();
    $stm_ii->bindParam(':assignee', $assignee['name']);
    $status = $issue->getStatus();
    $stm_ii->bindParam(':status', $status['name']);
    $resolution = $issue->getResolution();
    $stm_ii->bindParam(':resolution', $resolution['name']);
    $stm_ii->bindParam(':created', $issue->getCreated());
    $stm_ii->bindParam(':updated', $issue->getUpdated());
    $stm_ii->bindParam(':resolved', $issue->get('Resolved'));
    $stm_ii->execute();

    // Clean-up if we already had this issue in the database
    $stm_vd->bindParam(':issue', $issue->getKey());
    $stm_vd->execute();
    // Create or Update the affects and fix version references
    $stm_vi->bindParam(':issue', $issue->getKey());
    $type = 'Affects';
    $stm_vi->bindParam(':type', $type);
    $affects = $issue->get('Affects Version/s');
    foreach ($affects as $version) {
      $stm_vi->bindParam(':version', $version['name']);
      $stm_vi->execute();
    }
    $type = 'Fix';
    $stm_vi->bindParam(':type', $type);
    $fixes = $issue->get('Fix Version/s');
    foreach ($fixes as $version) {
      $stm_vi->bindParam(':version', $version['name']);
      $stm_vi->execute();
    }

    // Limit as otherwise the walker goes through the whole database
    $count++;
    if ($count >= 1000) break;
  }
  echo "$project: $count issue(s) created or updated" . PHP_EOL;
}