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
// If the dashboard service can interpret this ...
$queries[] = array(
  'file' => 'active-sites.json',
  'query' => "
      SELECT version, lang, uf, MySQL, PHP, Contact, Contribution, Participant
        FROM pingback_site
       WHERE is_active = 1
 ",
);
// Otherwise let's pre-digest the information
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
  'file' => 'active-sites-lang.json',
  'query' => "
      SELECT lang, COUNT(*) AS num_sites
        FROM pingback_site
       WHERE is_active = 1
       GROUP BY lang
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
  'file' => 'extensions-detail.json',
  'query' => "
      SELECT * FROM pingback_extension
       ORDER BY num_sites DESC
 ",
);
