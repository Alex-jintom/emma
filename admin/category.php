<?php
include "/var/www/html/header.php";

$query="select * from category where step=1";
$result = $mysqli->query($query) or die("query error => ".$mysqli->error);
while($rs = $result->fetch_object()){
    $cate1[]=$rs;
}
?>
    <div style="margin-top:20px;">
        <form class="row g-3">
            <div class="col-md-4">
                <select class="form-select" name="cate1" id="cate1" aria-label="Default select example">
                    <option value="">대분류</option>
                    <?php
                        foreach($cate1 as $c){
                    ?>
                        <option value="<?php echo $c->code;?>"><?php echo $c->name;?></option>
                    <?php }?>
                </select>
            </div>
            <div class="col-md-4">
                <select class="form-select" name="cate2" id="cate2" aria-label="Default select example">
                    <option value="">중분류</option>
                </select>
            </div>
            <div class="col-md-4">
                <select class="form-select" name="cate3" id="cate3" aria-label="Default select example">
                    <option value="">소분류</option>
                </select>
            </div>
        </form>
    </div>
    <?php
include "/var/www/html/footer.php";
?>