<?php
require_once(dirname(__DIR__) . '/config.php');

// Initialize database
$dbh = new PDO('mysql:dbname='.DBNAME.';host='.DBHOST, DBUSER, DBPASS);

// Calculate start and end date (monthly stats only)
$start_date = '2006-09-01';
$end_date = date('Y-m-01', strtotime('-1 month'));

// Get statistics from Sourceforge
$url = "http://sourceforge.net/projects/civicrm/files/stats/json?start_date=$start_date&end_date=$end_date";
$result = json_decode(file_get_contents($url));
//print_r($result);

// by country
$dbh->query("DELETE FROM sourceforge_download WHERE type='C'");
$query = "INSERT INTO sourceforge_download (type, label, value) VALUES ";
foreach ($result->countries as $stat) {
  $query .= "('C', \"$stat[0]\", $stat[1]),";
}
$dbh->query(substr($query,0,-1));

// by month
$dbh->query("DELETE FROM sourceforge_download WHERE type='M'");
$query = "INSERT INTO sourceforge_download (type, label, value) VALUES ";
foreach ($result->downloads as $stat) {
  $stat[0] = substr($stat[0], 0, 7); // keep only month part of string
  $query .= "('M', '$stat[0]', $stat[1]),";
}
$dbh->query(substr($query,0,-1));