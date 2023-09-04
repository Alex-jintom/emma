<?php session_start();
include "dbcon.php";
ini_set( 'display_errors', '0' );

$cid = $_POST['cid'];
$qty = $_POST['qty'];
$price = $_POST['price'];
$price = $price * $qty;

$sql="update cart set cnt=".$qty." where cartid=".$cid;//테이블에 업데이트 해줌.
$result=$mysqli->query($sql) or die($mysqli->error);

$data = array("qty"=>$qty,"amount"=>$amount,"price"=>$price);
echo json_encode($data);

?>