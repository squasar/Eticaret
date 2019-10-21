<?php
//g_functions uzerinden kategorileri getirip gerekli islemleri yapip session dizisine kaydet.
include_once 'autoload.php';
$ktgr_helper = new KategoriHelper();
session_start();

if(!(isset($_SESSION['kategoriler']) && isset($_SESSION['kitaplar']))){
  $res_kategorileri_getir = $ktgr_helper->kategorileri_getir();
  $sayac = count($res_kategorileri_getir);
  $kategori_adlari=array();
  $kategori_idleri=array();
  $kategorideki_kitaplar=array(array(),array());
  for($i=0; $i<$sayac; $i++){
    $kategori_adlari[$i]=$res_kategorileri_getir[$i]['kategori_adi'];
    $kategori_idleri[$i]=$res_kategorileri_getir[$i]['kategori_id'];
    $res_kategorideki_kitaplar = $ktgr_helper->kategorideki_kitaplar($kategori_idleri[$i]);
    $sayac2 = count($res_kategorideki_kitaplar);
    for($j=0; $j<$sayac2; $j++){
      $kategorideki_kitaplar[$i][$j]=$res_kategorideki_kitaplar[$j];
    }
  }
  $kategoriler=array($kategori_adlari, $kategori_idleri);
  $_SESSION['kategoriler']=$kategoriler;
  $_SESSION['kitaplar']=$kategorideki_kitaplar;
}
header("location:../views/in_kategoriler.php");
?>
