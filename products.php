<?php ob_start();// 이값이 있어야 쿠키가 제대로 작동한다. 안그러면 쿠키 설정을 소스의 맨위에 두어야 한다.
include "top.php";
$pid  = $_GET['pid'];

//제품 정보 불러오기
$query = "select p.*, (select sum(cnt) from wms w where w.pid=p.pid) as sumcnt from products p where p.status=1 and p.pid=".$pid;
$result = $mysqli->query($query) or die("query error => ".$mysqli->error);
$rs = $result->fetch_object();

if(!$rs or !$rs->sumcnt){
    echo "<script>alert('제품이 없거나 품절된 제품입니다.');location.href='/';</script>";
    exit;
}
// 최근 본 상품 세팅
$j=0;

    if($_COOKIE['recently_products']){//쿠키에 값이 있으면 시작
        $prs = json_decode($_COOKIE['recently_products']);//쿠키의 JSON값을 배열로 변경
        if(!in_array($rs, $prs)){//새로 등록할 상품이 기존 배열에 없으면 등록
            if(sizeof($prs)>=3){//배열에 3개만 등록할거니까 3개가 넘으면 하나를 삭제
                unset($prs[0]);
            }
            ksort($prs);//키값을 기준으로 정렬
            foreach($prs as $ps){//쿠키에 있는 값들을 가져와서 다시 담는다.
                $cvalarray[$j] = $ps;
                $j++;
            }

            $cvalarray[$j] = $rs;//마지막에 현재 상품을 배열에 담는다.
            $cval = json_encode($cvalarray);//json으로 바꾼다.
            setcookie("recently_products",$cval,time()+86400);//쿠키에 값을 담는다.
        }
    }else{
        $cvalarray[$j] = $rs;//쿠키에 최근 본 상품이 없으면 담는다.
        $cval = json_encode($cvalarray);
        setcookie("recently_products",$cval,time()+86400);
    }

    //옵션 정보 가져오기
    $query2="select * from product_options where cate='컬러' and pid=".$pid;
    $result2 = $mysqli->query($query2) or die("query error => ".$mysqli->error);
    while($rs2 = $result2->fetch_object()){
        $options1[]=$rs2;
    }

    $query2="select * from product_options where cate='사이즈' and pid=".$pid;
    $result2 = $mysqli->query($query2) or die("query error => ".$mysqli->error);
    while($rs2 = $result2->fetch_object()){
        $options2[]=$rs2;
    }

?>
<style>
    .col{
        border: 1px solid #f1f1f1;
    }

    [type=radio] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    [type=radio] + span {
        cursor: pointer;
    }
    [type=radio]:checked + span {
        outline: 5px solid indigo;
    }
</style>
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Shop</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
   
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Search Products</h2>
                        <form action="">
                            <input type="text" placeholder="Search products...">
                            <input type="submit" value="Search">
                        </form>
                    </div>
                   
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Products</h2>
                        <div class="thubmnail-recent">
                            <img src="img/product-thumb-1.jpg" class="recent-thumb" alt="">
                            <h2><a href="">Sony Smart TV - 2015</a></h2>
                            <div class="product-sidebar-price">
                                <ins>$700.00</ins> <del>$800.00</del>
                            </div>                            
                        </div>
                        <div class="thubmnail-recent">
                            <img src="img/product-thumb-1.jpg" class="recent-thumb" alt="">
                            <h2><a href="">Sony Smart TV - 2015</a></h2>
                            <div class="product-sidebar-price">
                                <ins>$700.00</ins> <del>$800.00</del>
                            </div>                            
                        </div>
                        <div class="thubmnail-recent">
                            <img src="img/product-thumb-1.jpg" class="recent-thumb" alt="">
                            <h2><a href="">Sony Smart TV - 2015</a></h2>
                            <div class="product-sidebar-price">
                                <ins>$700.00</ins> <del>$800.00</del>
                            </div>                            
                        </div>
                        <div class="thubmnail-recent">
                            <img src="img/product-thumb-1.jpg" class="recent-thumb" alt="">
                            <h2><a href="">Sony Smart TV - 2015</a></h2>
                            <div class="product-sidebar-price">
                                <ins>$700.00</ins> <del>$800.00</del>
                            </div>                            
                        </div>
                    </div>
                   
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Recent Posts</h2>
                        <ul>
                            <li><a href="">Sony Smart TV - 2015</a></li>
                            <li><a href="">Sony Smart TV - 2015</a></li>
                            <li><a href="">Sony Smart TV - 2015</a></li>
                            <li><a href="">Sony Smart TV - 2015</a></li>
                            <li><a href="">Sony Smart TV - 2015</a></li>
                        </ul>
                    </div>
                </div>
               
                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="product-breadcroumb">
                            <a href="/">Home</a>
                            <a href="">Category Name</a>
                        </div>
                       
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="product-images">
                                    <div class="product-main-img">
                                        <img id="pimg" src="<?php echo $rs->thumbnail;?>" style="max-width:360px;height:460px;">
                                    </div>
                                   
                                    <div class="product-gallery">
                                        <?php
                                        $query3="select * from product_image_table where pid=".$pid;
                                        $result3 = $mysqli->query($query3) or die("query error => ".$mysqli->error);
                                        while($rs3 = $result3->fetch_object()){
                                        ?>
                                            <img src="<?php echo $rs3->filename;?>" alt="" style="width:76px;height:68px;">
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-sm-6">
                                <div class="product-inner">
                                    <h2 class="product-name"><?php echo $rs->name;?></h2>
                                    <div class="product-inner-price">
                                        <ins id="price"><?php echo number_format($rs->sale_price);?></ins>원 <del><?php echo number_format($rs->price);?>원</del>
                                    </div>    

                                    <div>
                                        <?php foreach($options1 as $op1){?>
                                            <input type="radio" name="poption1" id="poption1_<?php echo $op1->poid;?>" value="<?php echo $op1->poid;?>">
                                                <span  onclick="jQuery('#poption1_<?php echo $op1->poid;?>').click();" style="content:url(<?php echo $op1->image_url;?>);height:100px;width:100px;"></span>
                                            </input>
                                        <?php }?>
                                       
                                    </div>
                                    <br>
                                    <div>
                                        <?php foreach($options2 as $op2){
                                            $option_name=$op2->option_name;
                                            if($op2->option_price)$option_name.="(+".number_format($op2->option_price).")";
                                            ?>
                                            <input type="radio" name="poption2" id="poption2_<?php echo $op2->poid;?>" value="<?php echo $op2->poid;?>">
                                                <span  onclick="jQuery('#poption2_<?php echo $op2->poid;?>').click();"><?php echo $option_name;?></span>
                                            </input>
                                        <?php }?>
                                       
                                    </div>
                                   
                                    <form action="" class="cart">
                                        <div class="quantity">
                                            <input type="number" size="4" class="input-text qty text" title="cnt" value="1" name="cnt" id="cnt" min="1" step="1">
                                        </div>
                                        <button class="add_to_cart_button" type="button" onclick="cart_ins()">장바구니에담기</button>
                                    </form>  
                                   
                                    <div role="tabpanel">
                                        <ul class="product-tab" role="tablist">
                                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                                <?php echo nl2br(stripslashes($rs->content));?>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="profile">
                                                <h2>Reviews</h2>
                                                <div class="submit-review">
                                                    <p><label for="name">Name</label> <input name="name" type="text"></p>
                                                    <p><label for="email">Email</label> <input name="email" type="email"></p>
                                                    <div class="rating-chooser">
                                                        <p>Your rating</p>

                                                        <div class="rating-wrap-post">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                    </div>
                                                    <p><label for="review">Your review</label> <textarea name="review" id="" cols="30" rows="10"></textarea></p>
                                                    <p><input type="submit" value="Submit"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                       
                       
                        <div class="related-products-wrapper">
                            <h2 class="related-products-title">Related Products</h2>
                            <div class="related-products-carousel">
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="img/product-1.jpg" alt="">
                                        <div class="product-hover">
                                            <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                            <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                        </div>
                                    </div>

                                    <h2><a href="">Sony Smart TV - 2015</a></h2>

                                    <div class="product-carousel-price">
                                        <ins>$700.00</ins> <del>$800.00</del>
                                    </div>
                                </div>
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="img/product-2.jpg" alt="">
                                        <div class="product-hover">
                                            <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                            <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                        </div>
                                    </div>

                                    <h2><a href="">Apple new mac book 2015 March :P</a></h2>
                                    <div class="product-carousel-price">
                                        <ins>$899.00</ins> <del>$999.00</del>
                                    </div>
                                </div>
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="img/product-3.jpg" alt="">
                                        <div class="product-hover">
                                            <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                            <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                        </div>
                                    </div>

                                    <h2><a href="">Apple new i phone 6</a></h2>

                                    <div class="product-carousel-price">
                                        <ins>$400.00</ins> <del>$425.00</del>
                                    </div>                                
                                </div>
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="img/product-4.jpg" alt="">
                                        <div class="product-hover">
                                            <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                            <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                        </div>
                                    </div>

                                    <h2><a href="">Sony playstation microsoft</a></h2>

                                    <div class="product-carousel-price">
                                        <ins>$200.00</ins> <del>$225.00</del>
                                    </div>                            
                                </div>
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="img/product-5.jpg" alt="">
                                        <div class="product-hover">
                                            <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                            <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                        </div>
                                    </div>

                                    <h2><a href="">Sony Smart Air Condtion</a></h2>

                                    <div class="product-carousel-price">
                                        <ins>$1200.00</ins> <del>$1355.00</del>
                                    </div>                                
                                </div>
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="img/product-6.jpg" alt="">
                                        <div class="product-hover">
                                            <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                            <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                        </div>
                                    </div>

                                    <h2><a href="">Samsung gallaxy note 4</a></h2>

                                    <div class="product-carousel-price">
                                        <ins>$400.00</ins>
                                    </div>                            
                                </div>                                    
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
<script>
    $("input[name='poption1']:radio,input[name='poption2']:radio").change(function () {
        var poid1 = $('input:radio[name="poption1"]:checked').val();
        var poid2 = $('input:radio[name="poption2"]:checked').val();

        var data = {
            poid1 : poid1,
            poid2 : poid2
        };
            $.ajax({
                async : false ,
                type : 'post' ,
                url : '/admin/option_change.php' ,
                data  : data ,
                dataType : 'json' ,
                error : function() {} ,
                success : function(data) {
                    var price=parseInt(data.option_price1)+parseInt(data.option_price2)+<?php echo $rs->sale_price;?>;
                    $("#pimg").attr("src", data.image_url);
                    $("#price").text(number_format(price));
                }
        });
    });

    function number_format(num){
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g,',');
    }

    function cart_ins(){

        var poid1 = $('input:radio[name="poption1"]:checked').val();
        var poid2 = $('input:radio[name="poption2"]:checked').val();
        var opts = poid1+'||'+poid2
        var cnt = $('#cnt').val();
        var data = {
            pid : <?php echo $pid;?>,
            opts : opts,
            cnt : cnt
        };
            $.ajax({
                async : false ,
                type : 'post' ,
                url : 'cart_ins.php' ,
                data  : data ,
                dataType : 'json' ,
                error : function() {} ,
                success : function(data) {
                    if(data.result=="ok"){
                        alert('장바구니에 입력했습니다.');
                    }else{
                        alert('실패했습니다. 다시 시도해주세요.');
                    }
                }
        });
    }
</script>

<?php
include "bot.php";
?>        