<?php
require_once(dirname(__DIR__) . '/config.php');
require_once('stackapi.php');

// Initialize database
$dbh = new PDO('mysql:dbname='.DBNAME.';host='.DBHOST, DBUSER, DBPASS);

// Get civicrm SE site statistics
$url = "https://api.stackexchange.com/2.2/info?site=civicrm";
$fields = $se_fields['site'];
$result = json_decode(stackapi($url));
if ($result->items) {
  $values = array();
  foreach ($fields as $field) {
    $values[$field] = $result->items[0]->$field;
  }
  $dbh->query("
    INSERT INTO stackexchange_history (" . implode(',', $fields) . ")
    VALUES (" . implode(',', $values) . ")
  ");
}

// Get civicrm SE site users
$dbh->query("TRUNCATE stackexchange_users");
$url = "https://api.stackexchange.com/2.2/users?site=civicrm&pagesize=100";
$fields = $se_fields['users'];
$page = 1; $count = 1;
do {
  $result = json_decode(stackapi($url . "&page=$page"));
  $lines = array();
  foreach ($result->items as $item) {
    $line = array();
    foreach ($fields as $field) {
      if (substr($field, 0, 6) == 'badges') {
        $badge = substr($field, 7);
        $line[$field] = $item->badge_counts->$badge;
      } elseif (isset($item->$field)) {
        $line[$field] = is_numeric($item->$field) ? $item->$field : $dbh->quote($item->$field);
      } else
        $line[$field] = 'NULL'; // SE remove fields that are NULL from API output
    }
    $lines[] = '(' . implode(',', $line) . ')';
    $count++;
  }
  $dbh->query("
    INSERT INTO stackexchange_users (" . implode(',', $fields) . ")
    VALUES " . implode(',', $lines)
  );
  echo '.';
  $page++;
} while($result->has_more);
echo " $count users created or updated" . PHP_EOL;