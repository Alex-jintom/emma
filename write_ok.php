<?php
include "dbcon.php";

$userid="hong";//userid는 없어서 임의로 넣어줬다.
$subject=$_POST["subject"];
$content=$_POST["content"];
$status=1;//status는 1이면 true, 0이면 false이다.

$sql="INSERT INTO board (userid,subject,content) VALUES ('".$userid."','".$subject."','".$content."')";
$result=$mysqli->query($sql) or die($mysqli->error);

if($result){
    echo "<script>location.href='index.php';</script>";
    exit;
}else{
    echo "<script>alert('글등록에 실패했습니다.');history.back();</script>";
    exit;
}


?>