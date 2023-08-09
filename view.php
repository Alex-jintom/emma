<?php
include "header.php";

$bid=$_GET["bid"];
$result = $mysqli->query("select * from board where bid=".$bid) or die("query error => ".$mysqli->error);
$rs = $result->fetch_object();

$query="select * from memo where status=1 and bid=".$rs->bid." order by memoid asc";
$memo_result = $mysqli->query($query) or die("query error => ".$mysqli->error);
while($mrs = $memo_result->fetch_object()){
    $memoArray[]=$mrs;
}
?>
      <h3 class="pb-4 mb-4 fst-italic border-bottom" style="text-align:center;">
        - 게시판 보기 -
      </h3>

      <article class="blog-post">
        <h2 class="blog-post-title"><?php echo $rs->subject;?></h2>
        <p class="blog-post-meta"><?php echo $rs->regdate;?> by <a href="#"><?php echo $rs->userid;?></a></p>

        <hr>
        <p>
          <?php echo $rs->content;?>
        </p>
        <hr>
      </article>

      <nav class="blog-pagination" aria-label="Pagination">
        <a class="btn btn-outline-secondary" href="index.php">목록</a>

        <a class="btn btn-outline-secondary" href="write.php?parent_id=<?php echo $rs->bid;?>">답글</a>

        <a class="btn btn-outline-secondary" href="write.php?bid=<?php echo $rs->bid;?>">수정</a>
        <a class="btn btn-outline-secondary" href="delete.php?bid=<?php echo $rs->bid;?>">삭제</a>
      </nav>

      <div style="margin-top:20px;">
        <form class="row g-3">
          <div class="col-md-10">
            <textarea class="form-control" placeholder="댓글을 입력해주세요." id="memo" style="height: 60px"></textarea>
          </div>
          <div class="col-md-2">
            <button type="button" class="btn btn-secondary" id="memo_button">댓글등록</button>
          </div>
        </form>
      </div>
      <div id="memo_place">
      <?php
        foreach($memoArray as $ma){
      ?>
        <div class="card mb-4" style="max-width: 100%;margin-top:20px;">
          <div class="row g-0">
            <div class="col-md-12">
              <div class="card-body">
                <p class="card-text"><?php echo $ma->memo;?></p>
                <p class="card-text"><small class="text-muted"><?php echo $ma->userid;?> / <?php echo $ma->regdate;?></small></p>
              </div>
            </div>
          </div>
        </div>
      <?php }?>
      </div>

<script>
  $("#memo_button").click(function () {
   
        var data = {
            memo : $('#memo').val() ,
            bid : <?php echo $bid;?>
        };
            $.ajax({
                async : false ,
                type : 'post' ,
                url : 'memo_write.php' ,
                data  : data ,
                dataType : 'html' ,
                error : function() {} ,
                success : function(return_data) {
                  if(return_data=="member"){
                    alert('로그인 하십시오.');
                    return;
                  }else{
                    $("#memo_place").append(return_data);
                  }
                }
        });
    });
</script>


      <?php
include "footer.php";
?>