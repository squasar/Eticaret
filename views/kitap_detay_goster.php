<?php
require("../page.inc");

$secilen_isbn=$_POST['isbn'];
$secilen_kitap_adi=$_POST['baslik'];
$secilen_kitap_yazar=$_POST['yazar'];
$secilen_kitap_fiyat=$_POST['fiyat'];
$secilen_kitap_aciklama=$_POST['aciklama'];

$id=$_POST['id'];
$isim=$_POST['isim'];

header("location:../views/logged_in.php");

if(($id !== "") && ($isim !== "")){
  $homepage = new LoggedInPage();
  session_start();
  $_SESSION['musteri_id']=$id;
  $homepage->content = "<p> Musteri ID : ".$id."</p>"
  ."<p> Isim : ".$isim."</p>"
  ."<p></p>"
  ."<p>Kitap ISBN :".$secilen_isbn."</p>"
  ."<p>Kitap Adi :".$secilen_kitap_adi."</p>"
  ."<p>Kitap Yazari :".$secilen_kitap_yazar."</p>"
  ."<p>Kitap Fiyati :".$secilen_kitap_fiyat."</p>"
  ."<p>Kitap Aciklamasi :".$secilen_kitap_aciklama."</p>"
  ."<p></p>"
  ."<form action=\"../controllers/sepet_islemleri.php\" method=\"post\" align=\"center\" >
    <input  type=\"submit\" name=\"$secilen_isbn~sepetekle\" value=\"Sepete Ekle\">
  </form>";
  $homepage -> Display();
}else{
  $homepage = new Page();
  session_start();
  $homepage->content = "<p>Kitap ISBN :".$secilen_isbn."</p>"
  ."<p>Kitap Adi :".$secilen_kitap_adi."</p>"
  ."<p>Kitap Yazari :".$secilen_kitap_yazar."</p>"
  ."<p>Kitap Fiyati :".$secilen_kitap_fiyat."</p>"
  ."<p>Kitap Aciklamasi :".$secilen_kitap_aciklama."</p>"
  ."<p></p>";
  $homepage -> DisplayWithLogin();
}

?>
