<?php
$historical = __DIR__ . '/json/historical';
chdir(__DIR__ . '/../archive/');

$reports = array(
  'active-sites-version.json' => array(
    'start_date' => '2015-12-01',
    'increment'  => '1 month',
    'key' => 'short_version',
    'value' => 'num_sites',
  ),
);

foreach($reports as $file => $params) {
  $dir = $params['start_date'];
  $report = array();
  while(file_exists("$dir/$file")) {
    $data = json_decode(file_get_contents("$dir/$file"), true);
    if (empty($params['key'])) {
      $report[$dir] = $data;
    } else {
      $results = array();
      foreach ($data as $result) {
        $results[$result[$params['key']]] = $result[$params['value']];
      }
      $report[$dir] = $results;
    }
    $dir = date('Y-m-d', strtotime("$dir + $params[increment]"));
  }
  file_put_contents("$historical/$file", json_encode($report));
}