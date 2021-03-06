<?php
require_once(dirname(__DIR__) . '/config.php');

// Initialize database
$dbh = new PDO('mysql:dbname='.DBNAME.';host='.DBHOST, DBUSER, DBPASS);

// Start from the last summarized pingback
$result = $dbh->query("SELECT MAX(last_ping_id) FROM pingback_site")->fetch();
if (empty($result[0])) $result[0] = 0;
echo "Starting from stat_id: $result[0]" . PHP_EOL;

// Feed raw pings into the summary database
$query = "
INSERT INTO pingback_site
  (`hash`, `version`, `lang`, `uf`, `ufv`, `civi_country`,
   `geoip_isoCode`, `MySQL`, `PHP`,
   `first_ping_id`, `first_timestamp`, `last_ping_id`, `last_timestamp`, `num_pings`,
   `Contact`, `Contribution`, `Participant`, `Mailing`, `Delivered`)
   SELECT
     hash, version, lang, uf, ufv, c.name,
     geoip_isoCode, MySQL, PHP,
     s.id, s.time, s.id, s.time, 1,
     e1.size AS Contact, e2.size AS Contribution, e3.size as Participant, e4.size as Mailing, e5.size as Delivered
   FROM " . DBPING . ".stats s
   LEFT JOIN civicrm_country c ON c.id = s.co
   LEFT JOIN " . DBPING . ".entities e1 ON e1.stat_id = s.id AND e1.name = 'Contact'
   LEFT JOIN " . DBPING . ".entities e2 ON e2.stat_id = s.id AND e2.name = 'Contribution'
   LEFT JOIN " . DBPING . ".entities e3 ON e3.stat_id = s.id AND e3.name = 'Participant'
   LEFT JOIN " . DBPING . ".entities e4 ON e4.stat_id = s.id AND e4.name = 'Mailing'
   LEFT JOIN " . DBPING . ".entities e5 ON e5.stat_id = s.id AND e5.name = 'Delivered'
   WHERE s.id > $result[0]
   ORDER BY s.id ASC
   LIMIT 300000
ON DUPLICATE KEY UPDATE
   version = s.version, lang = s.lang, uf = s.uf, ufv = s.ufv, civi_country = c.name,
   geoip_isoCode = s.geoip_isoCode, MySQL = s.MySQL, PHP = s.PHP,
   last_ping_id = s.id, last_timestamp = s.time, num_pings = num_pings + 1,
   Contact = e1.size, Contribution = e2.size, Participant = e3.size
   ";
$dbh->query($query);
$result = $dbh->query("SELECT COUNT(*) FROM pingback_site;")->fetch();
echo "Total sites: $result[0]" . PHP_EOL;

// Set the DB flavor - MySQL, MariaDB, Percona
$query = "
UPDATE pingback_site
   SET DB = CASE
         WHEN MySQL LIKE '%percona%' THEN 'Pr'
	     WHEN MySQL LIKE '%MariaDB%' THEN 'Ma'
	     ELSE 'My' END
 WHERE DB IS NULL";
$dbh->query($query);

// Calculate the active sites flag
$dbh->query("
UPDATE pingback_site
   SET is_active = (
         last_timestamp > (NOW() - INTERVAL 100 DAY)
         AND Contact > 10 AND Contact NOT IN (201, 202, 203, 204)
       )
");
$result = $dbh->query("SELECT COUNT(*) FROM pingback_site WHERE is_active = 1;")->fetch();
echo "Total active sites: $result[0]" . PHP_EOL;

// Create the cohort data on the first of each month
if (date('j') == 1) {
  echo "Recalculating cohort data:";
  // We need to calculate cohort data all over again since the
  // values might have changed with sites that have lingered
  // ex: someone from cohort X reconnects this month after been absent for a few months
  // Clear the cohort table
  $dbh->query("TRUNCATE pingback_cohort");
  // Loop over all previous cohorts and recalculate previous month's data
  $cohort = '2014-09';
  $thismonth = date('Y-m');
  while ($cohort < $thismonth) {
    echo " $cohort";
    $month = $cohort;
    while ($month < $thismonth) {
      $dbh->query("
INSERT INTO pingback_cohort (`cohort`, `month`, `num_sites`)
VALUES ('$cohort', '$month', (
            SELECT COUNT(*) FROM pingback_site
             WHERE LEFT(first_timestamp,7) = '$cohort' AND last_timestamp >= CONCAT('$month', '-01')))");
      $month = date('Y-m', strtotime($month.'-01 +1 month'));
    }
    $cohort = date('Y-m', strtotime($cohort.'-01 +1 month'));
  }
  echo PHP_EOL;
}

// Now calculate the extension stats
$dbh->query("TRUNCATE pingback_extension");
$query = "
INSERT INTO pingback_extension
  (`name`, `site_id`, `version`)
  SELECT e.name, s.id, e.version
    FROM pingback_site s
         LEFT JOIN " . DBPING . ".extensions e ON e.stat_id = s.last_ping_id AND e.enabled = 1
   WHERE s.is_active = 1
         AND LENGTH(e.name) > 2 AND e.name NOT LIKE 'org.civicrm.component%'
   ";
$dbh->query($query);
$result = $dbh->query("SELECT COUNT(DISTINCT `name`) FROM pingback_extension")->fetch();
echo "Unique active extensions: $result[0]" . PHP_EOL;
$result = $dbh->query("SELECT COUNT(*) FROM pingback_extension")->fetch();
echo "Total enabled extensions: $result[0]" . PHP_EOL;
