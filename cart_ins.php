<?php session_start();
include "dbcon.php";
ini_set( 'display_errors', '0' );

$pid = $_POST['pid'];
$opts = $_POST['opts'];
$cnt = $_POST['cnt'];
$ssid = session_id();
$userid = $_SESSION['UID'];

$query = "select cartid from cart where ssid='".$ssid."' and pid='".$pid."'";
$result = $mysqli->query($query) or die("query error => ".$mysqli->error);
$rs = $result->fetch_object();
if($rs->cartid){
    $sql="update cart set cnt=".$cnt.", options='".$opts."' where ssid='".$ssid."' and pid='".$pid."'";
    $result=$mysqli->query($sql) or die($mysqli->error);
}else{
    $sql="INSERT INTO `cart`
    (`pid`,
    `userid`,
    `ssid`,
    `options`,
    `cnt`,
    `regdate`)
    VALUES
    ('".$pid."',
    '".$userid."',
    '".$ssid."',
    '".$opts."',
    ".$cnt.",
    now())";
    $result=$mysqli->query($sql) or die($mysqli->error);
}
if($result){
    $data = array("result"=>"ok");
}else{
    $data = array("result"=>"fail");
}
echo json_encode($data);



?>