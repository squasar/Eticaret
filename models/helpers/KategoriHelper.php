<?php

class KategoriHelper{
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


}

?>
