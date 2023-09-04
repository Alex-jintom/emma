<?php ob_start();
$langset = $_GET['langset'];
setcookie('lang_set', $langset, time() + (86400 * 30), "/");
header( 'Location: /' );
?>