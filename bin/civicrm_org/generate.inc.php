<?php
// Database is already initialized from ../generate.php
$result = $dbh->query("SELECT fq_name FROM extensions_dir WHERE fq_name > ''", PDO::FETCH_ASSOC);
foreach ($result as $row) {
  if (strlen($row['fq_name']) < 2) continue;
  $queries[] = array(
    'file' => "ext/$row[fq_name].json",
    'query' => "
      SELECT COUNT(*) AS num_sites
        FROM pingback_extension
   	   WHERE `name` = '$row[fq_name]'
  ",
    'subqueries' => array(
      'installs_by_version' => "
        SELECT LEFT(version, LOCATE('.', s.version, 4)-1) AS short_version, COUNT(*) AS num_sites
          FROM pingback_extension e
               LEFT JOIN pingback_site s ON s.id = e.site_id
   	     WHERE `name` = '$row[fq_name]'
   	     GROUP BY short_version
   	     ORDER BY short_version
      ",
      'installs_by_language' => "
        SELECT lang, COUNT(*) AS num_sites
          FROM pingback_extension e
               LEFT JOIN pingback_site s ON s.id = e.site_id
   	     WHERE `name` = '$row[fq_name]'
   	     GROUP BY lang
   	     ORDER BY num_sites DESC
      ",
      'installs_by_extension_version' => "
        SELECT e.version, COUNT(*) AS num_sites
          FROM pingback_extension e
               LEFT JOIN pingback_site s ON s.id = e.site_id
   	     WHERE `name` = '$row[fq_name]'
   	     GROUP BY e.version
   	     ORDER BY num_sites DESC
      "
    )
  );
}