<?php
require __DIR__ . "/../vendor/autoload.php";

/**
 * @return chobie\Jira\Api
 */
function getApiClient() {
    $api = new \chobie\Jira\Api(
        "https://issues.civicrm.org/jira",
        new \chobie\Jira\Api\Authentication\Basic(JIRA_USERNAME, JIRA_PASSWORD)
    );
    return $api;
}