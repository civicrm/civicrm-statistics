<?php
/*
 * Maintains up to date the common tables used for reporting
 */
require_once(dirname(__DIR__) . '/config.php');

// Initialize database and prepared statements
$dbh = new PDO('mysql:dbname='.DBNAME.';host='.DBHOST, DBUSER, DBPASS);
$stm_m = $dbh->prepare("
  INSERT INTO common_month (month)
  VALUES (:month)
");

/*
 * The common_month table has all months from the beginning of the project till now
 */
// Get the latest month already in the database
$result = $dbh->query("SELECT MAX(month) FROM common_month;")->fetch();
if (empty($result[0])) $result[0] = DATESTART;
$current = $result[0];
// And loop until today, creating each month as we go
while (strtotime($current) < time()) {
  $current = date('Y-m-01 00:00:00', strtotime("$current +1 month"));
  $stm_m->bindParam(':month', $current);
  $stm_m->execute();
}

