<?php
$new_password="vishal";
$str='$2y$10$556qj8A78gn6FPT7nT8eju0fgzjS8JX8HV4VsCVxfC8gRj.rtWIEG';
if(password_verify($new_password,$str)){
	echo "Yes";
}else{
	echo "No";
}
?>