<?php

//sepete ekle butonuna tiklanmissa kitap bilgilerini alarak sepete ekleme islemi yap
//kullanicinin sepetindekileri getirip goster.
include 'autoload.php';
session_start();

/*
sepete ekle butonu uzerinden gelmezse yeni sepet olusturacak sekilde calismamali
*/

//SADECE KAYIT GOSTERME ISLEMI AYARLANMALI...
//kullanilabilecek fonksiyonlar...

/*function check_and_prepare_record(){
  if(!empty($_SESSION['sepet_obj']) || isset($_SESSION['sepet_obj'])){
    unset($_SESSION['sepet_obj']);
    return true;
  }else{
    return false;
  }
}

if(empty($_POST)){
  $tmp="STRINGEX3";
}else{
  $tmp = array_keys($_POST);
}

check_and_prepare_record();

$musteri_id=$_SESSION['musteri_id'];
$helper = new SepetIslemleriHelper($tmp,$musteri_id);

$_obj=new SepetIslemleri($helper);
$objm=$_obj->get_obj();
$obj = $objm[1]->__get_siparisler();

$_SESSION['sepet_obj']=$obj;//eski siparisler
unset($helper);
unset($_obj);

@header("location:../views/in_eski_siparislerim.php");
*/
?>
