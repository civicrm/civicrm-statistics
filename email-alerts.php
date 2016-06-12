<?php
require_once('vendor/autoload.php');
require_once('config.php');

$alerts = array(
  array(
    'recipients' => array('nicolas@cividesk.com'),
    'subject' => '[CiviCRM] Weekly security issues status',
    'query' => "
      SELECT issue, summary, priority, SUBSTRING(security, 12) as security, resolution, assignee
        FROM jira_issue
       WHERE status = 'Open' AND security IS NOT NULL
       ",
    'template' => 'security.twig',
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
    ->setFrom(array('info@civicrm.org' => 'CiviCRM'))
    ->setTo($alert['recipients'])
    ->setBody($body, 'text/html');
  $mailer->send($message);
}