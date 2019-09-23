<?php
require_once('data.php');
//determine and initialize each variable by executing data.php functions and objects
//apply apriori algorithm and keep results
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

function kategorileri_getir(){
  $ktg=new Kategori();
  $sonuclar=$ktg->get_kategoriler();
  return $sonuclar;
}

function kategorideki_kitaplar($catid){
  $ktp=new Kitap();
  $ktp->set_kategori($catid);
  $res=$ktp->kategori_kitaplar_getir();
  return $res;
}

function tum_kitaplar(){
  $ktp=new Kitap();
  $res=$ktp->tum_kitaplar_getir();
  return $res;
}

function baslik_kitap_ara($baslik){
  $ktp=new Kitap();
  $ktp->set_baslik($baslik);
  $res=$ktp->baslik_kitap_getir();
  return $res;
}

function yazar_kitap_ara($yazar){
  $ktp=new Kitap();
  $ktp->set_yazar($yazar);
  $res=$ktp->yazar_kitaplar_getir();
  return $res;
}

function isbn_kitap_ara($isbn){
  $ktp=new Kitap();
  $ktp->set_isbn($isbn);
  $res=$ktp->isbn_kitap_getir();
  return $res;
}

function create_admin($musteri_id, $kullanici_adi){
}
?>
