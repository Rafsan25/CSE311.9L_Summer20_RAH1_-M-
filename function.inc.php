<?php
function pr($arr){
    echo '<pre>';
    print_r($arr);
}
function prx($arr){
    echo '<pre>';
    print_r($arr);
    die();
}

function get_safe_value($str){
    global  $con;
    $str=mysqli_real_escape_string($con,$str);
    return $str;
}

function redirect($link){
    ?>
    <script>
        window.location.href='<?php echo $link ?>';
        </script>
    <?php
    die();
}

function send_email($email,$html,$subject){
    $mail=new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host="smtp.gmail.com";
    $mail->Port=587;
    $mail->SMTPSecure="tls";
    $mail->SMTPAuth=true;
    $mail->Username="foodordering311@gmail.com";
    $mail->Password="cse311foodordering";
    $mail->SetFrom("foodordering311@gmail.com");
    $mail->addAddress($email);
    $mail->IsHTML(true);
    $mail->Subject=$subject;
    $mail->Body=$html;
    $mail->SMTPOptions=array('ssl'=>array(
        'verify_peer'=>false,
        'verify_peer_name'=>false,
        'allow_self_signed'=>false
    ));
    if($mail->send()){
        //echo "done";
    }else{
        //echo "Error occur";
    }
}
function rand_str(){
    $str=str_shuffle("abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz");
    return $str=substr($str,0,15);
    
}
/*function getUserDetailsByid($uid=''){
    global $con;
    $data['name']='';
    $data['email']='';
    $data['phone']='';
    $data['referral_code']='';


    if(isset($_SESSION['FOOD_USER_ID'])){
        $uid=$_SESSION['FOOD_USER_ID'];
    }

    $row=mysqli_fetch_assoc(mysqli_query($con,"select * from user where id='$uid'"));
    $data['name']=$row['name'];
    $data['email']=$row['email'];
    $data['phone']=$row['phone'];
    $data['referral_code']=$row['referral_code'];
    return $data;
}*/
function getUserDetailsByid(){
    global $con;
    $data['name']='';
    $data['email']='';
    $data['phone']='';
    //$data['referral_code']='';

    if(isset($_SESSION['FOOD_USER_ID'])){
        // When the Session is started The query will select all from user table. Where the user_id is equals to session FOOD_USER_ID. Which means the user logged in right now the session will get his user id and get all the information is needed
        $row=mysqli_fetch_assoc(mysqli_query($con,"select * from user where user_id=".$_SESSION['FOOD_USER_ID']));
        $data['name']=$row['name'];
        $data['email']=$row['email'];
        $data['phone']=$row['phone'];
        //$data['referral_code']=$row['referral_code'];
    }
    return $data;
}


function getUserCart(){
    global $con;
    $arr=array();
    $id=$_SESSION['FOOD_USER_ID'];
    // For the logged in user the session will get the current user id and check where user_id=$id from dish_cart and select all the data from dish_cart table.
    $res=mysqli_query($con,"select * from dish_cart where user_id='$id'");
    while($row=mysqli_fetch_assoc($res)){
        $arr[]=$row;
    }
    return $arr;
}

function manageUserCart($uid,$qty,$attr){
    global $con;
    // Check the user_id and dish_detail_id to select specific row id.
    $res=mysqli_query($con,"select * from dish_cart where user_id='$uid' and dish_detail_id='$attr'");
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        $cid=$row['id'];
        // After selecting the row id will update the qty of dish.
        mysqli_query($con,"update dish_cart set qty='$qty' where id='$cid'");
    }
    else{
        $added_on=date('Y-m-d h:i:s');
        // When user add new dish in the cart section the user_id, dish_detail_id, qty, time will be store in dish_cart.
        mysqli_query($con,"insert into dish_cart(user_id,dish_detail_id,qty,added_on) values('$uid','$attr','$qty','$added_on') ");
    }

}
function getcartTotalPrice(){
    $cartArr=getUserFullCart();
    $totalPrice=0;
    foreach($cartArr as $list){
        $totalPrice=$totalPrice+($list['qty']*$list['price']);
    }
    return $totalPrice;
}

function getUserFullCart($attr_id=''){
    $cartArr=array();
    if(isset($_SESSION['FOOD_USER_ID'])){
        $getUserCart=getUserCart();
        $cartArr=array();
        foreach($getUserCart as $list){
            $cartArr[$list['dish_detail_id']]['qty']=$list['qty'];
            $getDishDetail=getDishDetailById($list['dish_detail_id']);

            $cartArr[$list['dish_detail_id']]['price']=$getDishDetail['price'];
            $cartArr[$list['dish_detail_id']]['dish']=$getDishDetail['dish'];
            $cartArr[$list['dish_detail_id']]['image']=$getDishDetail['image'];
        }
    }else{
        if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0){
            foreach($_SESSION['cart'] as $key=>$val){
                $cartArr[$key]['qty']=$val['qty'];
                $getDishDetail=getDishDetailById($key);
                $cartArr[$key]['price']=$getDishDetail['price'];
                $cartArr[$key]['dish']=$getDishDetail['dish'];
                $cartArr[$key]['image']=$getDishDetail['image'];
            }

        }
    }
    if($attr_id!=''){
        return $cartArr[$attr_id]['qty'];
    }else{
        return $cartArr;
    }
}
function getDishDetailById($id){
    global $con;
    $res=mysqli_query($con,"select dish.dish,dish.image,dish_details.price from dish_details,dish where dish_details.id='$id' and dish.id=dish_details.dish_id");
    $row=mysqli_fetch_assoc($res);
    return $row;
}
function removeDishFromCartByid($id){
    if(isset($_SESSION['FOOD_USER_ID'])){
        global $con;
        $res=mysqli_query($con,"delete from dish_cart where dish_detail_id='$id' and user_id=".$_SESSION['FOOD_USER_ID']);
    }else{
        unset($_SESSION['cart'][$id]);
    }
}
function emptyCart(){
    if(isset($_SESSION['FOOD_USER_ID'])){
        global $con;
        // After placing the order current users cart data will not be needed. That's why deleted all from dish_cart.
        $res=mysqli_query($con,"delete from dish_cart where user_id=".$_SESSION['FOOD_USER_ID']);
    }else{
        unset($_SESSION['cart']);
    }
}
function getOrderDetails($oid){
    global $con;
    // Natural Join Table
    $sql="select order_detail.price,order_detail.qty,dish_details.attribute,dish.dish
	from order_detail,dish_details,dish
	WHERE
	order_detail.order_id=$oid AND
	order_detail.dish_details_id=dish_details.id AND
	dish_details.dish_id=dish.id";
    $data=array();
    $res=mysqli_query($con,$sql);
    while($row=mysqli_fetch_assoc($res)){
        $data[]=$row;
    }
    return $data;

}
function getSale($start,$end){
    global $con;
    $sql="select sum(final_price) as final_price from order_master where added_on between '$start' and '$end' and order_status=4";
    $res=mysqli_query($con,$sql);

    while($row=mysqli_fetch_assoc($res)){
        return $row['final_price'].' Rs';
    }
}
function dateFormat($date){
    $str=strtotime($date);
    return date('d-m-Y',$str);
}
function getDeliveryBoyNameById($id){
    global $con;
    $sql="select name,mobile from delivery_boy where id='$id'";
    $data=array();
    $res=mysqli_query($con,$sql);
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        return $row['name'].'('.$row['mobile'].')';
    }else{
        return 'Not Assigned';
    }
}


?>
