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
const DBUSER = 'root';
const DBPASS = '';

// Ping-backs database (http://latest.civicrm.org)
const DBPING = 'civicrm_raw_stats';
// Downloads database (http://civicrm.org/download)
const DBDOWN = 'civicrm_downloads';
// Forum database (http://forum.civicrm.org)
const DBFORUM = 'civicrm_forum';

const DATESTART = '2004-12-07 06:13:00'; // Date of the start of the project (from JIRA)