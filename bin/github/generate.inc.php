<?php
$queries[] = array(
  'file' => "commits-by-month.json",
  'query' => "
      SELECT `date`, commits, (@runtot := @runtot + q1.commits) AS runtot
      FROM (
         SELECT DATE_FORMAT(committer_date, '%Y-%m') AS `date`, COUNT(*) AS commits
           FROM github_commit
          GROUP BY `date`
          ORDER BY `date` ASC
      ) q1
      JOIN (SELECT @runtot := 0 AS var1) init;
  ",
);
$queries[] = array(
  'file' => "commits-by-author.json",
  'query' => "
      SELECT u.login AS login, u.name, u.company, u.location, COUNT(*) AS commits
        FROM github_commit c
        LEFT JOIN github_user u ON u.login = c.author_login
       WHERE c.author_login > ''
       GROUP BY login
       ORDER BY commits DESC
  ",
);