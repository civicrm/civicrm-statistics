<?php
require_once('vendor/autoload.php');
require_once('config.php');

$alerts = array(
  array(
    'recipients' => array('civicrm-secteam@lists.civicrm.org'),
    'subject' => 'Weekly CiviCRM security issues recap',
    'query' => "
      SELECT issue, CONCAT('https://issues.civicrm.org/jira/browse/', issue) AS issue_url, summary,
             priority, status, assignee
        FROM jira_issue
       WHERE status != 'Closed' AND security IS NOT NULL
       ORDER BY priority, jira_id
       ",
    'template' => 'security.twig',
  ),
  array(
    'recipients' => array('civicrm-dev@lists.civicrm.org'),
    'subject' => 'Weekly CiviCRM critical issues recap',
    'query' => "
      SELECT issue, CONCAT('https://issues.civicrm.org/jira/browse/', issue) AS issue_url, summary,
             priority, status, assignee
        FROM jira_issue
       WHERE priority <= 'Critical' AND status != 'Closed' AND security IS NULL
       ORDER BY priority, jira_id
       ",
    'template' => 'critical.twig',
  ),
);

// Initialize database
$dbh = new PDO('mysql:dbname='.DBNAME.';host='.DBHOST, DBUSER, DBPASS);

// Initialize Twig
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
  'cache' => 'tmp_cache',
));

// Initialize SwiftMailer
$transport = Swift_SendmailTransport::newInstance();
$mailer = Swift_Mailer::newInstance($transport);

// Loop on each alert, query, format, compose and send
foreach ($alerts as $alert) {
  // Run the query
  $results = $dbh->query($alert['query']);
  // Format the email with the template
  $variables = array(
    'results' => $results
  );
  $body = $twig->render($alert['template'], $variables);
  // Compose and send the email
  $message = Swift_Message::newInstance()
    ->setSubject($alert['subject'])
    // Need to use a From: email address authorized to all lists
    ->setFrom(array('nicolas@cividesk.com' => 'CiviCRM (no replies)'))
    ->setTo($alert['recipients'])
    ->setBody($body, 'text/html');
  $mailer->send($message);
}