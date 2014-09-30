<?php
$queries[] = array(
  'file' => 'pingbacks-per-month.json',
  'query' => "
      SELECT DATE_FORMAT(`time`, '%Y-%m') AS `month`, COUNT( * ) AS num_pings
        FROM " . DBPING . ".stats
       GROUP BY `month`
       ORDER BY `month` ASC
  ",
);
$queries[] = array(
  'file' => 'active-sites-version.json',
  'query' => "
      SELECT CONCAT(LEFT(version, 3), '.x') AS short_version, COUNT(*) AS num_sites
        FROM pingback_site
       WHERE is_active = 1
       GROUP BY short_version
       ORDER BY num_sites DESC
       LIMIT 10 -- we do not need more for the graph
  ",
);
$queries[] = array(
  'file' => 'active-sites-lang.json',
  'query' => "
      SELECT COALESCE(l.language, 'Other') AS language, COUNT(*) AS num_sites
        FROM pingback_site s
             LEFT JOIN common_language l ON l.iso = LEFT(s.lang,2)
       WHERE is_active = 1
       GROUP BY language
       ORDER BY num_sites DESC
  ",
);
$queries[] = array(
  'file' => 'active-sites-uf.json',
  'query' => "
      SELECT uf, COUNT(*) AS num_sites
        FROM pingback_site
       WHERE is_active = 1
       GROUP BY uf
       ORDER BY num_sites DESC
       LIMIT 4 -- this hides the Standalone and Drupal8 data
  ",
);
$queries[] = array(
  'file' => 'active-sites-stats.json',
  'query' => "
      SELECT COUNT(*) AS active_sites, SUM(Contact) AS total_contacts, SUM(Contribution) AS total_contributions, SUM(Participant) AS total_participants
        FROM pingback_site
       WHERE is_active = 1
  ",
);
$queries[] = array(
  'file' => 'extensions-stats.json',
  'query' => "
      SELECT COUNT(*) AS num_extensions, SUM(num_sites) AS num_installs
        FROM pingback_extension
  ",
);$queries[] = array(
  'file' => 'extensions-detail.json',
  'query' => "
      SELECT * FROM pingback_extension
       ORDER BY num_sites DESC
       LIMIT 25 -- this hides the non-public extensions
  ",
);