<?php
class MusteriHelper{
  function create_musteri($email, $sifre, $telefon, $isim,
                        $adres, $sehir, $posta_kodu, $ulke){
    $obj=new Musteri();
    $obj->__setAll($email, $sifre, $telefon, $isim,
                          $adres, $sehir, $posta_kodu, $ulke);
    $res=$obj->register_musteri();
    return $res;
  }

  function login($email, $sifre){
    $obj = new Musteri();
    $obj->__setEmail($email);
    $obj->__setSifre($sifre);
    $res=$obj->login_musteri();
    return $res;
  }
}

?>
