<?php
$new_password="qwert";
$str='$2y$10$JBnpiX1R5ExdwdQfg.arLu9qZfRQQsL/3WPSApmpYBnW303gLFUam';
if(password_verify($new_password,$str)){
	echo "Yes";
}else{
	echo "No";
}

session_start();
echo '<pre>';
unset($_SESSION['cart']);
?>