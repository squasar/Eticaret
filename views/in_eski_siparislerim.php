<?php
require("../page.inc");
include '../controllers/autoload.php';

$homepage = new LoggedInPage();
session_start();

$obj=$_SESSION['sepet_obj'];

print_r($obj);

$homepage->content = "<p> Musteri ID : ".$_SESSION['musteri_id']."</p>"
."<p> Isim : ".$_SESSION['isim']."</p>"
."<p> Count of objs : ".count($obj[0])."</p>";

$homepage -> Display();

?>
