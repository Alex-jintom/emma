<?php
include "dbcon.php";

$result = $mysqli->query("SELECT * from board") or die("query error => ".$mysqli->error);
while($rs = $result->fetch_object()){
    $rsc[]=$rs;
}

// echo "<pre>";
// print_r($rsc);

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <title>게시판 리스트</title>
  </head>
  <body>

<table class="table" style="width:70%;margin:auto;">
<thead>
<tr>
<th scope="col">번호</th>
<th scope="col">글쓴이</th>
<th scope="col">제목</th>
<th scope="col">등록일</th>
</tr>
</thead>
<tbody>
<?php 
$i=1;
foreach($rsc as $r){
?>
<tr>
<th scope="row"><?php echo $i++;?></th>
<td><?php echo $r->userid?></td>
<td><a href="/view.php?bid=<?php echo $r->bid;?>"><?php echo $r->subject?></a></td>
<td><?php echo $r->regdate?></td>
</tr>
<?php }?>
</tbody>
</table>

<div class="col-md-4" style="float:right;padding:20px;">
<a href="write.php"><button type="button" class="btn btn-primary">등록</button><a>
</div>

</body>
</html>