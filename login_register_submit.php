<?php
session_start();
include('config.php');
include('function.inc.php');
include('constant.inc.php');
include('smtp/PHPMailerAutoload.php');

$type=get_safe_value($_POST['type']);
if($type=='register'){
	$name=get_safe_value($_POST['name']);
    $user_name=get_safe_value($_POST['user_name']);
	$email=get_safe_value($_POST['email']);
	$phone=get_safe_value($_POST['phone']);
	$password=get_safe_value($_POST['password']);
    $address=get_safe_value($_POST['address']);
	$check=mysqli_num_rows(mysqli_query($con,"select * from user where email='$email'"));
	if($check>0){
		$arr=array('status'=>'error','msg'=>'Email id already registered','field'=>'email_error');
	}else{
		$new_password=password_hash($password,PASSWORD_BCRYPT);
		$rand_str=rand_str();
		mysqli_query($con,"insert into user(name,user_name,email,phone,address,password,status,email_verify,rand_str) values('$name','$user_name','$email','$phone','$address','$new_password','1','0','$rand_str')");
		$id=mysqli_insert_id($con);
		$html=FRONT_SITE_PATH."verify.php?id=".$rand_str;
		send_email($email,$html,'Verify your email id');
		
		
		$arr=array('status'=>'success','msg'=>'Thank you for register. Please check your email id, to verify your account','field'=>'form_msg');
	}
	echo json_encode($arr);
}

if($type=='login'){
	$email=get_safe_value($_POST['user_email']);
	$password=get_safe_value($_POST['user_password']);
	
	$res=mysqli_query($con,"select * from user where email='$email'");
	$check=mysqli_num_rows($res);
	if($check>0){	
		$row=mysqli_fetch_assoc($res);
		$status=$row['status'];
		$email_verify=$row['email_verify'];
		$dbpassword=$row['password'];
		if($email_verify==1){
			if($status==1){
				if(password_verify($password,$dbpassword)){
					$_SESSION['FOOD_USER_ID']=$row['user_id'];
					$_SESSION['FOOD_USER_NAME']=$row['name'];
					$arr=array('status'=>'success','msg'=>'');

					if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0){
					    foreach($_SESSION['cart'] as $key=>$val){
                            manageUserCart($_SESSION['FOOD_USER_ID'],$val['qty'],$key);
                        }
                    }

				}else{
					$arr=array('status'=>'error','msg'=>'Please enter correct password');
				}
			}else{
				$arr=array('status'=>'error','msg'=>'Your account has been deactivated.');
			}
		}else{
			$arr=array('status'=>'error','msg'=>'Please verify your email id');
		}
	}else{
		$arr=array('status'=>'error','msg'=>'Please enter valid email id');	
	}
	echo json_encode($arr);
}

if($type=='forgot'){
	$email=get_safe_value($_POST['user_email']);
	
	$res=mysqli_query($con,"select * from user where email='$email'");
	$check=mysqli_num_rows($res);
	if($check>0){	
		$row=mysqli_fetch_assoc($res);
		$status=$row['status'];
		$email_verify=$row['email_verify'];
		$id=$row['user_id'];
		if($email_verify==1){
			if($status==1){
				$rand_password=rand(11111,99999);
				$new_password=password_hash($rand_password,PASSWORD_BCRYPT);
				mysqli_query($con,"update user set password='$new_password' where user_id='$id'");
				$html=$rand_password;
				send_email($email,$html,'New Password');
				$arr=array('status'=>'success','msg'=>'Password has been reset and send it to your email id');
				
			}else{
				$arr=array('status'=>'error','msg'=>'Your account has been deactivated.');
			}
		}else{
			$arr=array('status'=>'error','msg'=>'Please varify your email id');
		}
	}else{
		$arr=array('status'=>'error','msg'=>'Please enter valid email id');	
	}
	echo json_encode($arr);
}
?>