<?php
session_start();
require_once "config.php";
include ('function.inc.php');
include('constant.inc.php');
$totalPrice=0;

if(isset($_POST['update_cart'])){
    foreach($_POST['qty'] as $key=>$val){
        if(isset($_SESSION['FOOD_USER_ID'])){
            if($val[0]==0){
                // The query is similar of updated query below
                mysqli_query($con,"delete from dish_cart where dish_detail_id='$key' and user_id=".$_SESSION['FOOD_USER_ID']);
            }else{
                //Updated dish_cart qty. qty is set to $val[0] which is we are getting from cart.php. The query will update qty where the dish_detail_id is $key. And user_id we are getting from login session.
                mysqli_query($con,"update dish_cart set qty='".$val[0]."' where dish_detail_id='$key' and user_id=".$_SESSION['FOOD_USER_ID']);
            }
        }else{
            // If we set the value of qty is 0 then we will unset the dish.
            if($val[0]==0){
                unset($_SESSION['cart'][$key]['qty']);
            }else{
                $_SESSION['cart'][$key]['qty']=$val[0];
            }
        }
    }
}

$cartArr=getUserFullCart();

$totalPrice=getcartTotalPrice();
$totalCartDish=count($cartArr);
/*$cartArr=array();
if(isset($_SESSION['FOOD_USER_ID'])){
    $getUserCart=getUserCart();
    $cartArr=array();
    foreach($getUserCart as $list){
        $cartArr[$list['dish_detail_id']]['qty']=$list['qty'];
    }
}
else{
    if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0){
        $cartArr=$_SESSION['cart'];
    }
}
//prx($cartArr);
*/
//prx($cartArr);
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo FRONT_SITE_NAME ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/chosen.min.css">
    <link rel="stylesheet" href="assets/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/simple-line-icons.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.css">
    <link rel="stylesheet" href="assets/css/meanmenu.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
<!-- header start -->
<header class="header-area">
    <div class="header-top black-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12 col-sm-4">
                    <div class="welcome-area">
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-12 col-sm-8">
                    <div class="account-curr-lang-wrap f-right">
                        <?php
                            if(isset($_SESSION['FOOD_USER_NAME'])){
                            ?>  
                            <ul>
                                <li class="top-hover"><a href="#"><?php echo "Welcome ".$_SESSION['FOOD_USER_NAME'];?>  <i class="ion-chevron-down"></i></a>
                                    <ul>
                                        <li><a href="profile.php">Profile  </a></li>
                                        <li><a href="order_history.php">Order History</a></li>
                                        <li><a href="logout.php">Logout</a></li>
                                    </ul>
                                 </li>
                           </ul>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12 col-sm-4">
                    <div class="logo">
                        <a href="index.php">
                            <img alt="" src="assets/img/logo/logo2.png">
                        </a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-12 col-sm-8">
                    <div class="header-middle-right f-right">
                        <div class="header-login">
                            <?php
                                    if(!isset($_SESSION['FOOD_USER_NAME'])){
                                        ?>
                                    <a href="login-register.php">
                                        <div class="header-icon-style">
                                            <i class="icon-user icons header_icon"></i>
                                        </div>
                                        <div class="login-text-content header_icon">
                                            
                                                <p>Register <br> or <span>Sign in</span></p>
                                                
                                        </div>
                                    </a>
                                    <?php
                                            }
                                            ?>
                        </div>
                        <div class="header-wishlist">
                            &nbsp;
                        </div>
                        <div class="header-cart">
                            <a href="#">
                                <div class="header-icon-style">
                                    <i class="icon-handbag icons"></i>
                                    <span class="count-style" id="totalCartDish"><?php echo $totalCartDish?></span>
                                </div>
                                <div class="cart-text">
                                    <span class="digit">My Cart</span>
                                    <span class="cart-digit-bold" id="totalPrice">
                                    <?php
                                    if($totalPrice!=0){
                                        echo $totalPrice.' BDT';
                                    }
                                    ?></span>
                                </div>
                            </a>
                            <?php if($totalPrice!=0){?>
                                <div class="shopping-cart-content">
                                    <ul id="cart_ul">
                                        <?php foreach($cartArr as $key=>$list){ ?>
                                            <li class="single-shopping-cart" id="attr_<?php echo $key?>">
                                                <div class="shopping-cart-img">
                                                    <a href="javascript:void(0)"><img alt="" src="<?php echo SITE_DISH_IMAGE.$list['image']?>"></a>
                                                </div>
                                                <div class="shopping-cart-title">
                                                    <h4><a href="javascript:void(0)">
                                                            <?php echo $list['dish']?>
                                                        </a></h4>
                                                    <h6>Qty: <?php echo $list['qty']?></h6>
                                                    <span><?php echo
                                                            $list['qty']*$list['price'];?> BDT</span>
                                                </div>
                                                <div class="shopping-cart-delete">
                                                    <a href="javascript:void(0)" onclick="delete_cart('<?php echo $key?>')"><i class="ion ion-close"></i></a>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                    <div class="shopping-cart-total">
                                        <h4>Total : <span class="shop-total" id="shopTotal">
											<?php echo $totalPrice?> BDT
											</span></h4>
                                    </div>
                                    <!--
                                    <div class="shopping-cart-btn">
                                        <a href="<?php echo FRONT_SITE_PATH?>cart">view cart</a>
                                        <a href="checkout.php">checkout</a>
                                    </div>
                                    -->
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-bottom transparent-bar black-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="main-menu">
                        <nav>
                            <ul>
                                <li><a href="shop.php">Shop</a></li>
                                <li><a href="about_us.php">About Us</a></li>
                                <li><a href="contact_us.php">Contact Us</a></li>
                                <li><a href="cart.php">View Cart</a></li>
                                <li><a href="checkout.php">Checkout</a></li>

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- mobile-menu-area-start -->
    <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mobile-menu">
                        <nav id="mobile-menu-active">
                            <ul class="menu-overflow" id="nav">
                                <li><a href="shop.php">Shop</a></li>
                                <li><a href="about_us.php">About Us</a></li>
                                <li><a href="contact_us.php">Contact US</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- mobile-menu-area-end -->
</header>