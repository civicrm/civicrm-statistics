<?php
require_once(dirname(__DIR__) . '/config.php');

// Initialize database
$dbh = new PDO('mysql:dbname='.DBNAME.';host='.DBHOST, DBUSER, DBPASS);

// Start from the last summarized pingback
$result = $dbh->query("SELECT MAX(last_ping_id) FROM pingback_site;")->fetch();
if (empty($result[0])) $result[0] = 0;
echo "Starting from stat_id: $result[0]" . PHP_EOL;

// Feed raw pings into the summary database
$query = "
INSERT INTO pingback_site
  (`hash`, `version`, `lang`, `uf`, `ufv`, `civi_country`,
   `geoip_country`, `MySQL`, `PHP`,
   `first_ping_id`, `first_timestamp`, `last_ping_id`, `last_timestamp`, `num_pings`,
   `Contact`, `Contribution`, `Participant`)
   SELECT
     hash, version, lang, uf, ufv, c.name
     geoip_country, MySQL, PHP,
     id, `time`, id, `time`, 1,
     e1.size AS Contact, e2.size AS Contribution, e3.size as Participant
   FROM " . DBPING . ".stats s
   LEFT JOIN civicrm_country c ON c.id = s.co
   LEFT JOIN " . DBPING . ".entities e1 ON e1.stat_id = s.id AND e1.name = 'Contact'
   LEFT JOIN " . DBPING . ".entities e2 ON e2.stat_id = s.id AND e2.name = 'Contribution'
   LEFT JOIN " . DBPING . ".entities e3 ON e3.stat_id = s.id AND e3.name = 'Participant'
   WHERE `id` > $result[0]
   ORDER BY `id` ASC
   LIMIT 30000
ON DUPLICATE KEY UPDATE
   version = s.version, lang = s.lang, uf = s.uf, ufv = s.ufv, civi_country = c.name,
   geoip_country = s.geoip_country, MySQL = s.MySQL, PHP = s.PHP,
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

// Now calculate the extension stats
$dbh->query("TRUNCATE pingback_extension");
$query = "
INSERT INTO pingback_extension
  (`name`, `num_sites`)
  SELECT e.name, COUNT(*) AS num_sites
    FROM pingback_site s
         LEFT JOIN " . DBPING . ".extensions e ON e.stat_id = s.last_ping_id AND e.enabled = 1
   WHERE s.is_active = 1
         AND LENGTH(e.name) > 2 AND e.name NOT LIKE 'org.civicrm.component%'
   GROUP BY e.name
   ";
$dbh->query($query);
$result = $dbh->query("SELECT COUNT(*) FROM pingback_extension")->fetch();
echo "Unique active extensions: $result[0]" . PHP_EOL;
$result = $dbh->query("SELECT SUM(num_sites) FROM pingback_extension")->fetch();
echo "Total enabled extensions: $result[0]" . PHP_EOL;
