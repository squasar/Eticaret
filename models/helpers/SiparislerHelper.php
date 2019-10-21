<?php
class SiparislerHelper{
  //siparisler nesnesini olustur ve geri donder
  function create_bring_siparisler($musteri_id, $is_odendi){
    $_obj=new Siparisler($musteri_id, $is_odendi);
    return $_obj;
  }

  //siparisler nesnesine siparis ekle
  function m_siparis_ekle($_obj, $isbn){
    $p_adet="STRINGEX";
    $_obj->siparis_ekle_ayarla($isbn, $p_adet);
    return $_obj;
  }

  function m_siparis_guncelle($_obj, $isbn, $adet){
    $_obj->siparis_ekle_ayarla($isbn, $adet);
    return $_obj;
  }

  //siparisler nesnesinden siparis sil
  function m_siparis_sil($_obj, $isbn){
    $_obj->siparis_sil($isbn);
    return $_obj;
  }

  //siparis durumunu guncelle - odendi
  function m_siparisleri_ode($_obj){
    $_obj->checkout_et();
    return $_obj;
  }

  //siparis durumunu guncelle - kargoda
  function m_siparisleri_yola_cikar($_obj){
    $_obj->siparisi_adrese_yolla();
    return $_obj;
  }

  //siparis durumunu guncelle - ulasti
  function m_siparisleri_ulastir($_obj){
    $_obj->siparisi_ulastir();
    return $_obj;
  }

  //tum siparislerin toplam fiyatini getir
  function m_siparislerin_toplam_fiyatini_getir($_obj){
    $fiyat=$_obj->__get_toplam_fiyat();
    return $fiyat;
  }

}
?>
