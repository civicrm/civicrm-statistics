<?php
$queries[] = array(
  'file' => 'sourceforge-by-country.json',
  'query' => "
      SELECT label AS country, value
        FROM sourceforge_download
       WHERE type='C'
       ORDER BY value DESC
   ",
);
$queries[] = array(
  'file' => 'sourceforge-by-month.json',
  'query' => "
      SELECT label AS month, value
        FROM sourceforge_download
       WHERE type='M'
       ORDER BY month ASC
   ",
);
