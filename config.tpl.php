<?php
/*
 * ATTENTION: You need to copy this file to 'config.php'
 * and personalize it for your environment!
 *
 * The DBUSER MySQL user must have:
 * - full privileges on the DBNAME database
 * - read privileges on all other databases
 */
 
const DBHOST = 'localhost';
const DBNAME = 'stats_central';
const DBUSER = '<username>';
const DBPASS = '<password>';

// Ping-backs database (http://latest.civicrm.org)
const DBPING = 'civicrm_raw_stats';
// Downloads database (http://civicrm.org/download)
const DBDOWN = 'civicrm_downloads';
// Forum database (http://forum.civicrm.org)
const DBFORUM = 'civicrm_forum';

// Date of the start of the project (from JIRA)
const DATESTART = '2004-12-07 06:13:00';

// GitHub credentials
define('GITHUB_USERNAME', '<username>');
define('GITHUB_PASSWORD', '<password>');

// JIRA credentials
define('JIRA_USERNAME', '<username>');
define('JIRA_PASSWORD', '<password>');