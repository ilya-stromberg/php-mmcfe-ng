<?php

// Make sure we are called from index.php
if (!defined('SECURITY'))
    die('Hacking attempt');

if (!$smarty->isCached('master.tpl', md5(serialize($_REQUEST)))) {
  $debug->append('No cached version available, fetching from backend', 3);
  if ($bitcoin->can_connect() === true){
    $dDifficulty = $bitcoin->query('getdifficulty');
    if (is_array($dDifficulty) && array_key_exists('proof-of-work', $dDifficulty))
      $dDifficulty = $dDifficulty['proof-of-work'];
    $iBlock = $bitcoin->query('getblockcount');
  } else {
    $dDifficulty = 1;
    $iBlock = 0;
    $_SESSION['POPUP'][] = array('CONTENT' => 'Unable to connect to litecoind RPC service: ' . $bitcoin->can_connect(), 'TYPE' => 'errormsg');
  }
  $smarty->assign("CURRENTBLOCK", $iBlock);
  $smarty->assign("DIFFICULTY", $dDifficulty);
} else {
  $debug->append('Using cached page', 3);
}

$smarty->assign("CONTENT", "default.tpl");
?>
