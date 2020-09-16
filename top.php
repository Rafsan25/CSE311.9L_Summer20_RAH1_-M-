<?php
session_start();
include ('config.php');
include ('function.inc.php');

if (isset($_SESSION['IS_LOGIN'])){
    redirect('Login.php');
}
?>