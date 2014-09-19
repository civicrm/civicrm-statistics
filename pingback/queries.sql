-- Count unique sites
SELECT COUNT(DISTINCT hash)
  FROM stats

-- Count active sites
SELECT COUNT(DISTINCT hash)
  FROM stats
  WHERE `time` > (NOW() - INTERVAL 1 MONTH)

-- Latest active sites with 2 pings or more
SELECT COUNT(*)
  FROM (
    SELECT hash, MAX(`time`) AS latest_ping, COUNT(*) as num_pings
      FROM stats
     GROUP BY hash
  ) temp
 WHERE latest_ping > (NOW() - INTERVAL 6 MONTH)
       AND num_pings > 1

-- Number of pings per site
SELECT hash, MAX( `time` ) AS latest_ping, COUNT( * ) AS num_pings
  FROM stats
 GROUP BY hash
 ORDER BY id, num_pings DESC

-- Number of pings per month
SELECT DATE_FORMAT(`time`, '%Y-%m') AS `month`, COUNT( * ) AS num_pings
  FROM stats
 GROUP BY `month`
 ORDER BY `month` ASC

-- Managed entities count for active sites
SELECT COUNT(*) AS active_sites, SUM(contacts) AS total_contacts, SUM(contributions) AS total_contributions, SUM(participants) AS total_participants
  FROM (
    SELECT s.hash, e1.size AS contacts, e2.size AS contributions, e3.size AS participants
      FROM stats s
           LEFT JOIN entities e1 ON e1.stat_id = s.id AND e1.name = 'Contact'
           LEFT JOIN entities e2 ON e2.stat_id = s.id AND e2.name = 'Contribution'
           LEFT JOIN entities e3 ON e3.stat_id = s.id AND e3.name = 'Participant'
     WHERE s.time > (NOW() - INTERVAL 3 MONTH)
     GROUP BY s.hash
  )

-- Number of contacts per active site
SELECT COUNT(*) as num_sites, Contact
  FROM pingback_site
 WHERE is_active = 1
 GROUP BY Contact
 ORDER BY num_sites DESC