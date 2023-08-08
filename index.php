<?php
include "header.php";

$result = $mysqli->query("select * from board") or die("query error => ".$mysqli->error);
while($rs = $result->fetch_object()){
    $rsc[]=$rs;
}
?>

<table class="table">
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
        <td><a href="view.php?bid=<?php echo $r->bid;?>"><?php echo $r->subject?></a></td>
        <td><?php echo $r->regdate?></td>
    </tr>
<?php }?>
</tbody>
</table>

<p style="text-align:right;">

<?php
if($_SESSION['UID']){//세션값이 있는지 여부를 확인해서 로그인 했는지를 체크한다.
?>
    <a href="write.php"><button type="button" class="btn btn-primary">등록</button><a>
    <a href="logout.php"><button type="button" class="btn btn-primary">로그아웃</button><a>
<?php
}else{
?>
    <a href="login.php"><button type="button" class="btn btn-primary">로그인</button><a>
    <a href="signup.php"><button type="button" class="btn btn-primary">회원가입</button><a>
<?php
}
?>

</p>
<?php
include "footer.php";
?>