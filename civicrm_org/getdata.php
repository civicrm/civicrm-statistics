<?php
require_once(dirname(__DIR__) . '/config.php');
require_once('class.api.php');

// Initialize database
$dbh = new PDO('mysql:dbname='.DBNAME.';host='.DBHOST, DBUSER, DBPASS);

// Get data from civicrm.org
$api = new civicrm_api3(array(
  'server' => CO_CIVIURL,
  'api_key' => CO_USERKEY,
  'key' => CO_SITEKEY,
));
if (!$api->ExtensionDir->Get()) {
  echo 'Unable to retrieve ExtensionDir: ' . $api->errorMsg() . PHP_EOL;
  exit;
};

// Save in database, replacing existing data
$dbh->query('TRUNCATE TABLE extensions_dir');
$stm = $dbh->prepare("
  INSERT INTO extensions_dir (nid, title, created, fq_name, git_url)
         VALUES (:nid, :title, :created, :fq_name, :git_url)
  ");
$count = 0;
foreach ($api->values() as $row) {
  $stm->bindValue(':nid', $row->nid, PDO::PARAM_INT);
  $stm->bindValue(':title', $row->title, PDO::PARAM_STR);
  $stm->bindValue(':created', $row->created, PDO::PARAM_INT);
  $stm->bindValue(':fq_name', $row->fq_name, PDO::PARAM_STR);
  $stm->bindValue(':git_url', $row->git_url, PDO::PARAM_STR);
  if ($stm->execute()) $count++;
}
echo "$count CiviCRM-native extensions found in the Extensions Directory." . PHP_EOL;