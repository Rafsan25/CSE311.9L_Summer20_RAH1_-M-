<?php
session_start();
require_once "../config.php";
include ('../function.inc.php');
$msg="";
if(isset($_POST['submit']))
{
    $username=get_safe_value($_POST['username']);
    $password=get_safe_value($_POST['password']);

    $sql="select * from admin where username='$username' and password='$password'";
    $res=mysqli_query($con,$sql);
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        $_SESSION['IS_LOGIN']='yes';
        $_SESSION['ADMIN_USER']=$row['name'];
        redirect('Welcome_Page.php');
    }
    else
        $msg="Please Enter Valid Login Details";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> LOGIN </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>


<body class="cyan">
<!-- Start Page Loading -->
<div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
<!-- End Page Loading -->
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" method="post">
					<span class="login100-form-title p-b-34">
						Account Login
					</span>

                <div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user name">
                    <input class="input100" type="textbox" id="exampleInputEmail1" name="username" placeholder="User name">
                    <span class="focus-input100"></span>
                </div>
                <div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
                    <input class="input100" type="password" id="exampleInputEmail1" name="password" placeholder="Password">
                    <span class="focus-input100"></span>
                </div>

                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn" value = "Sign in" name="submit">
                        Sign in
                    </button>
                </div>

                <div class="w-full text-center p-t-27 p-b-239">


                </div>

                <div class="w-full text-center">
                    <a href="register.php" class="txt3">
                        Register Now!
                    </a>
                </div>
            </form>
            <div class="login100-more" style="background-image: url('images/bg-01.jpg');"></div>
        </div>
        <div class="login_msg"><<?php echo $msg?> </div>
    </div>
</div>



<div id="dropDownSelect1"></div>

</form>
</div>
</div>
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="vendor/animsition/js/animsition.min.js"></script>
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/select2/select2.min.js"></script>
<script>
    $(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });
</script>
<script src="vendor/daterangepicker/moment.min.js"></script>
<script src="vendor/daterangepicker/daterangepicker.js"></script>
<script src="vendor/countdowntime/countdowntime.js"></script>
<script src="js/main.js"></script>

</body>
</html>