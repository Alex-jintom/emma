<?php

$hostname="localhost";
$dbuserid="root";
$dbpasswd="!qas123456789";
$dbname="jin";

$mysqli = new mysqli($hostname, $dbuserid, $dbpasswd, $dbname);
if ($mysqli->connect_errno) {
    die('Connect Error: '.$mysqli->connect_error);
}

?>