<?php
require_once("init.php");
session_start();

if(isset($_POST['emailqty']) && isset($_POST['sifreqty'])){
  //if the user has just tried to log in
  $email=$_POST['emailqty'];
  $sifre=$_POST['sifreqty'];

  //some comparings and preprocesses...
  if(!get_magic_quotes_gpc()){
    $email = addslashes($email);
    $sifre = addslashes($sifre);
  }

  $sifre=sha1($sifre);

  //login
  $res=login($email, $sifre);

  if(count($res)>0){
    $_SESSION['musteri_id'] = $res[0]['musteri_id'];
    $_SESSION['isim'] = $res[0]['isim'];
    header("location:../views/logged_in.php");
  }else{
    echo "Girilen kriterlere uygun kayitli kullanici bulunamadi. Lutfen tekrar deneyin.";
  }
}
?>
