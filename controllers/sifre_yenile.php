<?php
//change password of user - email posted if there is any
$email=$_POST['emailforgotqty'];
//create a random password that consists of user identical infos and current time
//send email that has new password
//redirect to index.php
header("location:../views/index.php");
?>
