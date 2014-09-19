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
  'file' => 'active-sites-stats.json',
  'query' => "
      SELECT COUNT(*) AS active_sites, SUM(Contact) AS total_contacts, SUM(Contribution) AS total_contributions, SUM(Participant) AS total_participants
        FROM pingback_site
       WHERE is_active = 1
 ",
);
$queries[] = array(
  'file' => 'active-sites-version.json',
  'query' => "
      SELECT version, COUNT(*) AS num_sites
        FROM pingback_site
       WHERE is_active = 1
       GROUP BY version
       ORDER BY num_sites DESC
 ",
);
$queries[] = array(
  'file' => 'extensions-detail.json',
  'query' => "
      SELECT * FROM pingback_extension
       ORDER BY num_sites DESC
 ",
);
