<?php

session_start();
header('Content-Type: text/html; charset=utf-8'); // utf-8인코딩

$db = new mysqli("localhost", "root", "!qas123456789", "jin");
$db->set_charset("utf8");

function mq($sql)
{
global $db;
return $db->query($sql);
}





// $conn = mysqli_connect("localhost", "root", "비밀번호", "DB 이름"); <- php에서 MySQL에 연결하는 함수는 2개가 있다. 이걸로 해도 된다.

$conn = new mysqli("localhost", "root", "!qas123456789", "jin");
if ($conn->connect_error) {
  die("연결 실패 : " .$conn->connect_error); // 연결 실패 시 원인을 출력한다
} else {
  echo "연결 성공"; // 연결 성공 시 웹 페이지 좌상단에 연결 성공이라는 문구를 출력한다
}

//$sql = "INSERT INTO board(userid)
//  VALUES('yunstone');";

//  $result = mysqli_query($db, $sql); // DB 연결 결과와 SQL문을 $result 변수 안에 넣고

//  if ($result === false) { // false가 나왔다면 무슨 에러인지 출력한다(29번 줄의  태그를 주석 쳐야 제대로 볼 수 있다)
//    echo mysqli_error($db);
//  }

?>
~








<?php
include "dbccnn.php";

$sql = "INSERT INTO board(userid)VALUES('yunstone1');";
  $result = mysqli_query($db, $sql); // DB 연결 결과와 SQL문을 $result 변수 안에 넣고

  if ($result === false) { // false가 나왔다면 무슨 에러인지 출력한다(29번 줄의  태그를 주석 쳐야 제대로 볼 수 있다)
    echo mysqli_error($db);
  }

?>
~
~
~
~
~
~
~
~
~
~

~
~
