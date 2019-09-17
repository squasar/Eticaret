<?php
require_once('data.php');
//determine and initialize each variable by executing data.php functions and objects
//apply apriori algorithm and keep results
function create_musteri($email, $sifre, $telefon, $isim,
                      $adres, $sehir, $posta_kodu, $ulke){
  $obj=new Musteri($email, $sifre, $telefon, $isim,
                        $adres, $sehir, $posta_kodu, $ulke);
  $res=$obj->register_musteri();
  return $res;
}

function create_admin($musteri_id, $kullanici_adi){
}
?>
