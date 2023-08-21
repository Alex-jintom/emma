<?php
include "header.php";


if(!$_SESSION['UID']){
    echo "<script>alert('회원 전용 게시판입니다.');history.back();</script>";
    exit;
}

$bid=$_GET["bid"];//get으로 넘겼으니 get으로 받는다.
$parent_id=$_GET["parent_id"];

if($bid){//bid가 있다는건 수정이라는 의미다.

    $result = $mysqli->query("select * from board where bid=".$bid) or die("query error => ".$mysqli->error);
    $rs = $result->fetch_object();

    if($rs->userid!=$_SESSION['UID']){
        echo "<script>alert('본인 글이 아니면 수정할 수 없습니다.');history.back();</script>";
        exit;
    }

}

if($parent_id){//parent_id가 있다는건 답글이라는 의미다.

    $result = $mysqli->query("select * from board where bid=".$parent_id) or die("query error => ".$mysqli->error);
    $rs = $result->fetch_object();
    $rs->subject = "[RE]".$rs->subject;
}
?>



<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>파일 업로드 폼</title>
</head>
<body>
  <form name="fileUpload" method="post" action="write_ok.php" enctype="multipart/form-data">
    <input type="file" name="imgFile" />
    <input type="submit" value="업로드" />
  </form>
</body>
</html>





        <form method="post" action="write_ok.php" enctype="multipart/form-data">
            <input type="hidden" name="bid" value="<?php echo $bid;?>">

            <input type="hidden" name="parent_id" value="<?php echo $parent_id;?>">
            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">제목</label>
                <input type="text" name="subject" class="form-control" id="exampleFormControlInput1" placeholder="제목을 입력하세요." value="<?php echo $rs->subject;?>">
            </div>
            <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">내용</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="content" rows="3"><?php echo $rs->content;?></textarea>
            </div>
            <div class="mb-3">
                <input type="file" name="upfile">
            </div>
            <button type="submit" class="btn btn-primary">등록</button>
        </form>



        <?php
include "footer.php";
?>
 