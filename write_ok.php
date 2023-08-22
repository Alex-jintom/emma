<?php session_start();
include "dbcon.php";//dbcon.php 안에는 session_start()가 없기때문에 위에 따로 선언해준다.


if(!$_SESSION['UID']){
    echo "<script>alert('회원 전용 게시판입니다.');location.href='index.php';</script>";
    exit;
}

// echo "<pre>";
// print_r($_FILES);
// exit;


$subject=$_POST["subject"];
$content=$_POST["content"];
$bid=$_POST["bid"];//bid값이 있으면 수정이고 아니면 등록이다.
$parent_id=$_POST["parent_id"];//parent_id가 있으면 답글이다.
$userid=$_SESSION['UID'];//userid는 세션값으로 넣어준다.
$status=1;//status는 1이면 true, 0이면 false이다.

if($bid){//bid값이 있으면 수정이고 아니면 등록이다.
    $result = $mysqli->query("select * from board where bid=".$bid) or die("query error => ".$mysqli->error);
    $rs = $result->fetch_object();

    if($rs->userid!=$_SESSION['UID']){
        echo "<script>alert('본인 글이 아니면 수정할 수 없습니다.');location.href='/';</script>";
        exit;
    }

    $sql="update board set subject='".$subject."', content='".$content."', modifydate=now() where bid=".$bid;

}else{

    if($parent_id){//답글인 경우 쿼리를 수정해서 parent_id를 넣어준다.
        $sql="insert into board (userid,subject,content,parent_id) values ('".$userid."','".$subject."','".$content."','".$parent_id."')";
    }else{
        $sql="insert into board (userid,subject,content) values ('".$userid."','".$subject."','".$content."')";
    }
   
}
$result=$mysqli->query($sql) or die($mysqli->error);
if(!$bid)$bid = $mysqli -> insert_id;




//추가한 코드//


    // 임시 저장된 정보
    $myTempFile = $_FILES['imgFile']['tmp_name'];


    // 파일명을 기존의 파일명을 그대로 쓰고 싶은 경우
    $fileName = $_FILES['imgFile']['name'];
    // 파일 타입 및 확장자 구하기
    //$fileTypeExtension = explode("/", $_FILES['imgFile']['type']);

    // 파일 타입
    //$fileType = $fileTypeExtension[0];
    // 파일 확장자
    //$extention = $fileTypeExtension[1];

    // 확장자 검사
    //$isExtGood = true;

    //switch ($extention) {
     // case 'jpeg':
     // case 'bmp':
     // case 'gif':
     // case 'png':
     //   $isExtGood = true;
     //   break;
      //default:
      //  echo "허용하는 확장자는 jpg, bmp, gif, png 입니다. - switch";
     //   exit;
      //  break;
    //}

    // 이미지 파일이 맞는지 확인
    //if ($fileType  == 'image') {
      // 허용할 확장자를 jpg, bmp, gif, png로 정함, 그 외는 업로드 불가
      //if ($isExtGood) {
        // 임시 파일 옮길 폴더 및 파일명
        $myFile = "/var/www/html/data/".$fileName;
        // 임시 저장된 파일을 우리가 저장할 장소 및 파일명으로 옮김
        $imageUpload = move_uploaded_file($myTempFile, $myFile);

        // 업로드 성공 여부 확인
        if ($imageUpload == true) {
          echo "파일이 정상적으로 업로드 되었습니다. <br>";
          echo "<img src='{$myFile}' width='200' />";
        }
      //}
      // 확장자가 jpg, bmp, gif, png가 아닐때
      else {
        echo "허용하는 확장자는 jpg, bmp, gif, png 입니다. - else";
        exit;
      }
    //}
    // type이 image가 아닐때
   // else {
     // echo "이미지 파일이 아닙니다.";
      //exit;
  //  }


//여기까지 추가한 코드//



 

//if($_FILES["upfile"]["name"]){//첨부한 파일이 있으면

    if($_FILES['upfile']['size']>10240000){//10메가
        echo "<script>alert('10메가 이하만 첨부할 수 있습니다.');history.back();</script>";
        exit;
    }

    if($_FILES['upfile']['type']!='image/jpeg' and $_FILES['upfile']['type']!='image/gif' and $_FILES['upfile']['type']!='image/png' and $_FILES['upfile']['type']!='image/jpg'){//이미지가 아니면, 다른 type은 and로 추가
        echo "<script>alert('이미지만 첨부할 수 있습니다.');history.back();</script>";
        exit;
    }

    $save_dir = "/var/www/html/data/";//파일을 업로드할 디렉토리
    $filename = $_FILES["upfile"]["name"];
    $ext = pathinfo($filename,PATHINFO_EXTENSION);//확장자 구하기
    $newfilename = date("YmdHis").substr(rand(),0,6);
    $upfile = $newfilename.".".$ext;//새로운 파일이름과 확장자를 합친다

   
   // if(move_uploaded_file($_FILES["upfile"]["tmp_name"], $save_dir.$upfile)){//파일 등록에 성공하면 디비에 등록해준다.
        move_uploaded_file($_FILES["upfile"]["tmp_name"], $save_dir.$upfile);
      $sql="INSERT INTO jin.file_table
        (bid, userid, filename)
        VALUES(".$bid.", '".$_SESSION['UID']."', '".$upfile."')";
        $result=$mysqli->query($sql) or die($mysqli->error);
    //}

//}


if($result){
    echo "<script>location.href='index.php';</script>";
    exit;
}else{
    echo "<script>alert('글등록에 실패했습니다.');history.back();</script>";
    exit;
}


?>