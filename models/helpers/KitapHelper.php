<?php
class KitapHelper{
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

}
?>
