<?php
class SiparisHelper{
  function siparis_sayisini_guncelle($_obj, $isbn, $guncel_sayi){
    $_obj->siparis_ekle_ayarla($isbn, $guncel_sayi);
    return $_obj;
  }

  function siparis_fiyatini_getir($_obj, $isbn){
    $siparisler = $_obj->__get_siparisler();
    $fiyat;
    for ($i=0; $i < count($siparisler[0]); $i++) {
      if($siparisler[0][$i]->get_isbn() == $isbn){
        $fiyat=$siparisler[0][$i]->get_siparis_tutari();
      }
    }
    return $fiyat;
  }

}
?>
