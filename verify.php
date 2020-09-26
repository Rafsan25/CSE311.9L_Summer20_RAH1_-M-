<?php
include ("header.php");

$msg="";
//Email id verify
if(isset($_GET['id']) && $_GET['id']!=''){
    $id=get_safe_value($_GET['id']);
    mysqli_query($con,"update user set email_verify=1 where rand_str='$id'");
    $msg="Your email is verified successfully...";
}else{
    redirect('index.php');
}
?>

<div class="breadcrumb-area gray-bg">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="shop.php">Home</a></li>
                        <li class="active"> Email Verify </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="contact-area pt-100 pb-100">
            <div class="container">
                
                <div class="row">
                    <div class="col-12">
                        <div class="contact-message-wrapper">
                            <h4 class="contact-title">
                                <?php
                                echo $msg;
                                ?>
                            </h4>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
include("footer.php");
?>