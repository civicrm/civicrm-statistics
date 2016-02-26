<?php
// StackExchange compresses all API output regardless of http headers!
// see. https://api.stackexchange.com/docs/compression
// So we need a special function to deal with this ...

function stackapi($url) {
  $curl_handle = curl_init();
  curl_setopt($curl_handle, CURLOPT_URL, $url);
  curl_setopt($curl_handle, CURLOPT_ENCODING, 'gzip');
  curl_setopt($curl_handle, CURLOPT_USERAGENT, 'StackApi');
  curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
  $data = curl_exec($curl_handle);

  if($data === FALSE)
    throw new \Exception('cURL ERROR "' . curl_error($curl_handle) . '"');
  return $data;
}

$se_fields = array(
  'site' => array('total_users', 'total_badges', 'total_questions', 'total_answers', 'total_unanswered', 'total_accepted', 'total_votes', 'total_comments'),
  'users' => array('account_id', 'display_name', 'user_type', 'location', 'reputation', 'accept_rate', 'badges_gold', 'badges_silver', 'badges_bronze'),
);