<?php

// Make sure we are called from index.php
if (!defined('SECURITY')) die('Hacking attempt');

// Check user to ensure they are admin
if (!$user->isAuthenticated() || !$user->isAdmin($_SESSION['USERDATA']['id'])) {
  header("HTTP/1.1 404 Page not found");
  die("404 Page not found");
}

// Fetch settings to propagate to template
$aCronStatus = array(
  'statistics' => array (
    array( 'NAME' => 'Exit Code', 'STATUS' => $monitoring->getStatus('statistics_status') ),
    array( 'NAME' => 'Active', 'STATUS' => $monitoring->getStatus('statistics_active') ),
    array( 'NAME' => 'Runtime', 'STATUS' => $monitoring->getStatus('statistics_runtime') ),
    array( 'NAME' => 'Last Message', 'STATUS' => $monitoring->getStatus('statistics_message') ),
  ),
  'auto_payout' => array (
    array( 'NAME' => 'Exit Code', 'STATUS' => $monitoring->getStatus('auto_payout_status') ),
    array( 'NAME' => 'Active', 'STATUS' => $monitoring->getStatus('auto_payout_active') ),
    array( 'NAME' => 'Runtime', 'STATUS' => $monitoring->getStatus('auto_payout_runtime') ),
    array( 'NAME' => 'Last Message', 'STATUS' => $monitoring->getStatus('auto_payout_message') ),
  ),
  'archive_cleanup' => array (
    array( 'NAME' => 'Exit Code', 'STATUS' => $monitoring->getStatus('archive_cleanup_status') ),
    array( 'NAME' => 'Active', 'STATUS' => $monitoring->getStatus('archive_cleanup_active') ),
    array( 'NAME' => 'Runtime', 'STATUS' => $monitoring->getStatus('archive_cleanup_runtime') ),
    array( 'NAME' => 'Last Message', 'STATUS' => $monitoring->getStatus('archive_cleanup_message') ),
  ),
  'blockupdate' => array (
    array( 'NAME' => 'Exit Code', 'STATUS' => $monitoring->getStatus('blockupdate_status') ),
    array( 'NAME' => 'Active', 'STATUS' => $monitoring->getStatus('blockupdate_active') ),
    array( 'NAME' => 'Runtime', 'STATUS' => $monitoring->getStatus('blockupdate_runtime') ),
    array( 'NAME' => 'Last Message', 'STATUS' => $monitoring->getStatus('blockupdate_message') ),
  ),
  'findblock' => array (
    array( 'NAME' => 'Exit Code', 'STATUS' => $monitoring->getStatus('findblock_status') ),
    array( 'NAME' => 'Active', 'STATUS' => $monitoring->getStatus('findblock_active') ),
    array( 'NAME' => 'Runtime', 'STATUS' => $monitoring->getStatus('findblock_runtime') ),
    array( 'NAME' => 'Last Message', 'STATUS' => $monitoring->getStatus('findblock_message') ),
  )
);
// Payout system specifics
switch ($config['payout_system']) {
case 'pplns':
  $aCronStatus['pplns_payout'] = array (
    array( 'NAME' => 'Exit Code', 'STATUS' => $monitoring->getStatus('pplns_payout_status') ),
    array( 'NAME' => 'Active', 'STATUS' => $monitoring->getStatus('pplns_payout_active') ),
    array( 'NAME' => 'Runtime', 'STATUS' => $monitoring->getStatus('pplns_payout_runtime') ),
    array( 'NAME' => 'Last Message', 'STATUS' => $monitoring->getStatus('pplns_payout_message') ),
  );
  break;
case 'pps':
  $aCronStatus['pps_payout'] = array(
    array( 'NAME' => 'Exit Code', 'STATUS' => $monitoring->getStatus('pps_payout_status') ),
    array( 'NAME' => 'Active', 'STATUS' => $monitoring->getStatus('pps_payout_active') ),
    array( 'NAME' => 'Runtime', 'STATUS' => $monitoring->getStatus('pps_payout_runtime') ),
    array( 'NAME' => 'Last Message', 'STATUS' => $monitoring->getStatus('pps_payout_message') ),
  );
  break;
case 'prop':
  $aCronStatus['proportional_payout'] = array(
    array( 'NAME' => 'Exit Code', 'STATUS' => $monitoring->getStatus('proportional_payout_status') ),
    array( 'NAME' => 'Active', 'STATUS' => $monitoring->getStatus('proportional_payout_active') ),
    array( 'NAME' => 'Runtime', 'STATUS' => $monitoring->getStatus('proportional_payout_runtime') ),
    array( 'NAME' => 'Last Message', 'STATUS' => $monitoring->getStatus('proportional_payout_message') ),
  );
  break;
}
$smarty->assign("CRONSTATUS", $aCronStatus);

// Tempalte specifics
$smarty->assign("CONTENT", "default.tpl");
?>
