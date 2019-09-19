<?php
require_once('init.php');

// create short variable names
$isimqty = $_POST['isimqty'];
$emailqty = $_POST['emailqty'];
$sifreqty = $_POST['sifreqty'];
$sifretekrarqty = $_POST['sifretekrarqty'];
$telefonqty = $_POST['telefonqty'];
$adresqty = $_POST['adresqty'];
$sehirqty = $_POST['sehirqty'];
$postakoduqty = $_POST['postakoduqty'];
$ulkeqty = $_POST['ulkeqty'];


//some comparings and preprocesses...
if(!get_magic_quotes_gpc()){
  $isimqty = addslashes($isimqty);
  $emailqty = addslashes($emailqty);
  $sifreqty = addslashes($sifreqty);
  $sifretekrarqty = addslashes($sifretekrarqty);
  $telefonqty = addslashes($telefonqty);
  $adresqty = addslashes($adresqty);
  $sehirqty = addslashes($sehirqty);
  $postakoduqty = addslashes($postakoduqty);
  $ulkeqty = addslashes($ulkeqty);
}

$sifreqty=sha1($sifreqty);

//create musteri
$res=create_musteri($emailqty, $sifreqty, $telefonqty, $isimqty,
                      $adresqty, $sehirqty, $postakoduqty, $ulkeqty);

if($res){
  echo "Kayit basariyla tamamlandi.";
}else{
  echo "Kayit tamamlanamadi. Lutfen daha sonra tekrar deneyin.";
}

//header("location:../views/index.php");

?>
