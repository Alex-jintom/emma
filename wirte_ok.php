<?php
include $_SERVER["DOCUMENT_ROOT"]."/dbcon.php";

$subject=$_POST["subject"];
$content=$_POST["content"];
$userid="hong";//userid는 없어서 임의로 넣어줬다.
$status=1;//status는 1이면 true, 0이면 false이다.

$sql="insert into board (userid,subject,content) values ('".$userid."','".$subject."','".$content."')";
$result=$mysqli->query($sql) or die($mysqli->error);

if($result){
    echo "<script>location.href='/index.php';</script>";
    exit;
}else{
    echo "<script>alert('글등록에 실패했습니다.');history.back();</script>";
    exit;
}


?>