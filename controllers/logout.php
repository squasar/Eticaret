<?php
session_start();

unset($_SESSION['musteri_id']);
unset($_SESSION['isim']);

session_destroy();

header("location:../views/index.php");

?>
