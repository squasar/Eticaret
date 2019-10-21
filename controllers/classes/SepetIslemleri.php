<?php
class SepetIslemleri{
  private $siparisler_hlpr;
  private $obj = array();

  function __construct($helper){
    $this->siparisler_hlpr=new SiparislerHelper();
    switch ($helper->__get_islem_adi()) {
      case "goster":
        $_obj_yeni=$this->sepeti_goster($helper);
        $_obj_eski=$this->eski_siparisleri_getir($helper);
        $this->obj[0]=$_obj_yeni;
        $this->obj[1]=$_obj_eski;
        break;
      case "guncelle":
        $_obj_yeni=$this->siparis_sayisi_guncelle($helper);
        $this->obj[0]=$_obj_yeni;
        break;
      case "sepetekle":
        $_obj_yeni=$this->sepete_ekle($helper);
        $this->obj[0]=$_obj_yeni;
        break;
  }
  }

  public function get_obj(){
    return $this->obj;
  }

  private function sepete_ekle($helper){
    $_obj_yeni = $helper->__get_obj_yeni();
    $_obj_yeni=$this->siparisler_hlpr->m_siparis_ekle($_obj_yeni, $helper->__get_secilen_isbn());
    return $_obj_yeni;
  }
  private function sepetten_sil($helper){
    $_obj_yeni = $helper->__get_obj_yeni();
    $_obj_yeni= $this->siparisler_hlpr->m_siparis_sil($_obj_yeni, $helper->__get_secilen_isbn());
    return $_obj_yeni;
  }


  private function siparis_sayisi_guncelle($helper){
    $_obj_yeni = $helper->__get_obj_yeni();
    $guncellenecekler = $helper->__get_guncellenecekler();
    for ($i=1; $i < count($guncellenecekler) ; $i++) {
      if(empty($guncellenecekler[$i])){
        //do nothing...
      }else{
        $isbn=$guncellenecekler[$i][0];
        $adet=$guncellenecekler[$i][1];
        if($adet>0){
          $_obj_yeni=$this->siparisler_hlpr->m_siparis_guncelle($_obj_yeni, $isbn, $adet);
        }else{
          $_obj_yeni=$this->siparisler_hlpr->m_siparis_sil($_obj_yeni, $isbn);
        }
      }

    }
    return $_obj_yeni;
  }


  private function sepeti_goster($helper){
    $_obj_yeni = $helper->__get_obj_yeni();
    return $_obj_yeni;
  }
  private function eski_siparisleri_getir($helper){
    $_obj_eski = $helper->__get_obj_eski();
    return $_obj_eski;
  }
}

?>
