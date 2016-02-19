<?php
$tabs = array(
  'about' => array('title' => 'About'),
  'geography' => array('title' => 'Geographical reach', 'iframe' => "https://app.klipfolio.com/published/7116be5f80d3752214b0fa836f7c273e/geographical-reach-"),
  'sites' => array('title' => 'Active Sites', 'iframe' => "https://app.klipfolio.com/published/ab444b80434b9a91cb5f0b8f92dacf4c/active-sites"),
  'technology' => array('title' => 'Server Technologies', 'iframe' => "https://app.klipfolio.com/published/ad17065438d34cf0d4ee688245aa7bde/server-technologies"),
  'issues' => array('title' => 'Issues tracking', 'iframe' => "https://app.klipfolio.com/published/2ef307a2fe4ddcf05826ee84ecc6bdb8/issues-tracking"),
);
$tab = reset(array_keys($tabs));
if (!empty($_REQUEST['tab']) || in_array($_REQUEST['tab'], array_keys($tabs))) {
  $tab = $_REQUEST['tab'];	
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>CiviCRM statistics</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style="margin:20px;">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	<div style="width:100%">
	  <div style="float:right;"><h3 style="margin: 0;">by <a href="http://www.cividesk.com">
  	      <img style="margin-bottom: 10px; height: auto; max-width: 180px;" src="https://www.cividesk.com/sites/cividesk.com/themes/cividesk_theme/logo.png"></img>
		</a></h3></div>
	  <div><h1>CiviCRM Statistics</h1></div>
	</div>
	<div style="display:block; float: none;">
	  <ul class="nav nav-tabs">
<?php
foreach ($tabs as $key => $props) {
  echo '<li role="presentation"' . ($tab == $key ? ' class="active"' : '') . "><a href=\"?tab=$key\">$props[title]</a></li>";
}
?>
	  </ul>
	</div>
<?php
if (!empty($tabs[$tab]['iframe'])) {
  echo '<iframe src="' . $tabs[$tab]['iframe'] . '" frameborder="0" style="overflow:hidden; display:block; position: absolute; height: 100%; width: 98%"></iframe>';
} else {
?>
    <h3>What are the CiviCRM statistics?</h3>
	<p>As the CiviCRM community grows and is active in so many ways, the need emerged to measure our work, our impact, our communications and many other aspects of this community in order to judge our progress and influence our roadmap.</p>
	<p>The CiviCRM statistics project was born.</p>
	<p>Since it's inception, it has grown in scope and capabilities and now makes available real-time statistics on:</p>
	<ul>
	  <li>the users of CiviCRM (counted as 'sites' representing an active installation of CiviCRM),</li>
	  <li>key operational (# contacts, #transactions, ...) and technical metrics (server configuration) on these active installations,</li>
	  <li>CiviCRM downloads per day, including from which country,</li>
	  <li>metrics on software issues logged into our bug tracker,</li>
	  <li>and many more ...</li>
    </ul>
    <p>All of these statistics are produced with the upmost respect for the privacy of our users and contrinbutors: no identifying data of any sort is ever collected (yes, even IP addresses ...), these statistics are always outputed as aggregates, values below certain thresholds are discarded, etc.</p>
    <h3>What are these statistics used for?</h3>
	<p>Well ... click on the tabs and you will see some nice graphics!</p>
	<p>But seriously, these statistics now provide key data points and influence a number of decisions for our marketing, technology roadmap, communications, etc. Example of such decisions include:</p>
	<ul>
	  <li>whether we should obsolete support for certain versions of PHP in newer releases,</li>
	  <li>if and when we should recruit volunteers to aid in translation to a given language,</li>
	  <li>which extensions should be considered stable and/or more actively promoted.</li>
	</ul>
    <h3>How do we produce these statistics?</h3>
	<p>These statistics are produced from a number of data sources, including:</p>
	<ul>
	  <li>the pingback data from CiviCRM instances</li>
	  <li>download data from sourceforge.net</li>
	  <li>API calls to GitHub, JIRA and our forums</li>
	</ul>
	<p>These data sources are regularely queried for new data, this data is aggregated in a central database and statistics are produced from this database on a daily basis.</p>
    <h3>For more information</h3>
	<p>Additional resources include:</p>
	<ul>
	  <li>the <a href="https://civicrm.org/blog/tags/statistics">blog posts</a> published on these statistics</li>
	  <li>the <a href="https://stats.civicrm.org/json">data files</a> used to produce these graphics - reuse, remix!</li>
	  <li>the <a href="https://github.com/civicrm/civicrm-statistics">civicrm-statistics</a> project on github</li>
	</ul>
	<p>Finaly, please feel free to contact Nicolas at Cividesk with any questions, concerns or encouragements related to these statistics.</p>
<?php } ?>
  </body>
</html>