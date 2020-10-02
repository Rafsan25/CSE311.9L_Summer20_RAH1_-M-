<?php
session_start();
include('config.php');
include('function.inc.php');
include('constant.inc.php');
$attr=get_safe_value($_POST['attt']);
$qty=get_safe_value($_POST['qty']);
$type=get_safe_value($_POST['type']);

if($type=='add'){
    if(isset($_SESSION['FOOD_USER_ID'])){
        $uid=$_SESSION['FOOD_USER_ID'];
        manageUserCart($uid,$qty,$attr);
    }else{
        $_SESSION['cart'][$attr]['qty']=$qty;
    }
    $getUserFullCart=getUserFullCart();
    $totalPrice=0;
    foreach($getUserFullCart as $list){
        $totalPrice=$totalPrice+($list['qty']*$list['price']);
    }

    $getDishDetail=getDishDetailById($attr);
    $price=$getDishDetail['price'];
    $dish=$getDishDetail['dish'];
    $image=$getDishDetail['image'];

    $totaDish=count(getUserFullCart());
    $arr=array('totalCartDish'=>$totaDish,'totalPrice'=>$totalPrice,'price'=>$price,'dish'=>$dish,'image'=>$image);
    echo json_encode($arr);
}
?>
