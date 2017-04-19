<?php
require_once('config.php');
$directory = __DIR__ . '/json';

// Initialize database
$dbh = new PDO('mysql:dbname='.DBNAME.';host='.DBHOST, DBUSER, DBPASS);

// Initialize the queries array from each subdirectories' include file
$queries = array();
$files = glob_recursive('generate.inc.php');
foreach ($files as $file) {
  require_once($file);
}

// Create target directories if non existent
foreach (array($directory, "$directory/ext") as $dir) {
  if (!file_exists($dir)) {
    mkdir($dir);
  }
}

// Run the queries and generate target file
foreach ($queries as $query) {
  echo "Creating $query[file] ...";
  $count = 0;
  $out = '[';
  foreach ($dbh->query($query['query'], PDO::FETCH_ASSOC) as $row) {
    if (isset($query['subqueries'])) {
      foreach ($query['subqueries'] as $attr => $subquery) {
        $row[$attr] = array();
        foreach ($dbh->query($subquery, PDO::FETCH_ASSOC) as $subrow) {
          $row[$attr][] = $subrow;
        }
      }
    }
    $out .= json_encode($row) . ',';
    $count ++;
  }

  $out[strlen($out)-1] = ']';
  file_put_contents($directory . '/' . $query['file'], $out);
  echo " ($count records)" . PHP_EOL;
}

function glob_recursive($pattern, $flags = 0) {
  $files = glob($pattern, $flags);
  foreach (glob(dirname($pattern).'/*', GLOB_ONLYDIR|GLOB_NOSORT) as $dir)
    $files = array_merge($files, glob_recursive($dir.'/'.basename($pattern), $flags));
  return $files;
}