<?php session_start();
include "dbcon.php";
include "lang.php";
ini_set( 'display_errors', '0' );

function islanguage($n){

    switch($n) {
        case "kr":$rs="한국어";
        break;
        case "en":$rs="English";
        break;
        case "jp":$rs="日本語";
        break;
    }
    return $rs;

}

?>
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eElectronics - HTML eCommerce Template</title>
   
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
   
    <!-- Bootstrap -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
   
    <!-- Font Awesome -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
   
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/owl.carousel.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="/css/responsive.css">

    <script  src="http://code.jquery.com/jquery-latest.min.js"></script>

  </head>
  <body>
   
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                        <ul>
                            <li><a href="#"><i class="fa fa-user"></i> <?php echo $_LANG[$_CONFIG["LANGSET"]]['top']['myaccount'];?></a></li>
                            <li><a href="#"><i class="fa fa-heart"></i> <?php echo $_LANG[$_CONFIG["LANGSET"]]['top']['wishlist'];?></a></li>
                            <li><a href="cart.php"><i class="fa fa-user"></i> My Cart</a></li>
                            <li><a href="checkout.html"><i class="fa fa-user"></i> Checkout</a></li>
                            <li><a href="login.php"><i class="fa fa-user"></i> Login</a></li>
                        </ul>
                    </div>
                </div>
               
                <div class="col-md-4">
                    <div class="header-right">
                        <ul class="list-unstyled list-inline">
                            <li class="dropdown dropdown-small">
                                <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key">currency :</span><span class="value">USD </span><b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">USD</a></li>
                                    <li><a href="#">INR</a></li>
                                    <li><a href="#">GBP</a></li>
                                </ul>
                            </li>

                            <li class="dropdown dropdown-small">
                                <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key"></span><span class="value"><?php echo islanguage($_CONFIG["LANGSET"]);?> </span><b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="lang_set.php?langset=kr">한국어</a></li>
                                    <li><a href="lang_set.php?langset=en">English</a></li>
                                    <li><a href="lang_set.php?langset=jp">日本語</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End header area -->
   
    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1><a href="/">e<span>Electronics</span></a></h1>
                    </div>
                </div>
               
                <div class="col-sm-6">
                    <div class="shopping-item">
                        <a href="cart.php">Cart - <span class="cart-amunt">$800</span> <i class="fa fa-shopping-cart"></i> <span class="product-count">5</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End site branding area -->
   
    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="/">Home</a></li>
                        <li><a href="shop.html">Shop page</a></li>
                        <li><a href="single-product.html">Single product</a></li>
                        <li><a href="">Cart</a></li>
                        <li><a href="checkout.html">Checkout</a></li>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Others</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->