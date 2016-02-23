<?php
// Issue statuses - so we have the same definitions in all queries
$status = array(
  'open'   => "('Open', 'In Progress', 'Reopened')",
  'closed' => "('Closed', 'In Verification', 'In Quality Assurance')",
);

// General queries
$queries[] = array(
  'file' => 'issues-created-history.json',
  'query' => "
      SELECT DATE_FORMAT(m.month, '%Y-%m') AS `month`,
             (
             SELECT COUNT(*)
               FROM jira_issue i
              WHERE i.created < m.month
                    AND (i.resolved IS NULL OR i.resolved > m.month)
             ) AS num_issues
        FROM common_month m
        ORDER BY m.month ASC
   ",
);
$queries[] = array(
  'file' => 'issues-by-status.json',
  'query' => "
      SELECT status, COUNT(*) AS num_issues
        FROM jira_issue
       GROUP BY status
   ",
);
$queries[] = array(
  'file' => 'issues-by-type.json',
  'query' => "
      SELECT type, COUNT(*) AS num_issues
        FROM jira_issue
       GROUP BY type
   ",
);

// Open issue queries - calculated on 'Affects' version
$queries[] = array(
  'file' => 'issues-open-by-version.json',
  'query' => "
      SELECT SUBSTRING_INDEX(v.version, '.', 2) AS minor, COUNT(*) AS num_issues
        FROM jira_issue i
             LEFT JOIN jira_version v
                    ON v.issue = i.issue AND v.type = 'Affects'
       WHERE v.version REGEXP '^[0-9]' -- Discard 'Future' and other placeholder versions
             AND status IN $status[open]
       GROUP BY minor
       ORDER BY minor DESC
   ",
);
$queries[] = array(
  'file' => 'issues-open-by-priority.json',
  'query' => "
      SELECT priority, COUNT(*) AS num_issues
        FROM jira_issue
       WHERE status IN $status[open]
       GROUP BY priority
   ",
);

// Closed issues queries - calculated on 'Fix' version
$queries[] = array(
  'file' => 'issues-closed-by-version.json',
  'query' => "
      SELECT SUBSTRING_INDEX(v.version, '.', 2) AS minor, COUNT(*) AS num_issues
        FROM jira_issue i
             LEFT JOIN jira_version v
                    ON v.issue = i.issue AND v.type = 'Fix'
       WHERE v.version REGEXP '^[0-9]' -- Discard 'Future' and other placeholder versions
             AND status IN $status[closed]
       GROUP BY minor
       ORDER BY minor DESC
   ",
);
$queries[] = array(
  'file' => 'issues-closed-by-resolution.json',
  'query' => "
      SELECT COALESCE(resolution, 'Other') as resolved, COUNT(*) AS num_issues
        FROM jira_issue
       WHERE status IN $status[closed]
       GROUP BY resolution
       ORDER BY num_issues DESC
   ",
);