<?php
class SepetIslemleriHelper{
  private $islem_adi;
  private $secilen_isbn;
  private $_obj_eski;
  private $guncellenecekler;
  private $_obj_yeni;
  function __construct($params, $musteri_id, $adet, $isbn, $islem_adi, $guncellenecekler){

    if($islem_adi === "guncelle"){
      $this->guncellenecekler=$guncellenecekler;
      $this->islem_adi=$islem_adi;
    }else if($islem_adi === "sepetekle"){
      $this->islem_adi=$islem_adi;
      $this->secilen_isbn=$isbn;
      $this->guncellenecekler="STRINGEX3";
    }else if($islem_adi === "goster"){
      $this->islem_adi=$islem_adi;
      $this->secilen_isbn="STRINGEX3";
      $this->guncellenecekler="STRINGEX3";
    }else{
      $this->islem_adi="DEFAULT_ISLEM";
      $this->secilen_isbn="DEFAULT_ISBN";
    }
    $this->_obj_eski=SiparislerHelperC::get_obj_eski_instance($musteri_id);
    $this->_obj_yeni=SiparislerHelperC::get_obj_yeni_instance($musteri_id);
  }

  function __get_islem_adi(){
    return $this->islem_adi;
  }
  function __get_secilen_isbn(){
    return $this->secilen_isbn;
  }

  function __get_guncellenecekler(){
    return $this->guncellenecekler;
  }

  function __get_obj_eski(){
    return $this->_obj_eski;
  }
  function __get_obj_yeni(){
    return $this->_obj_yeni;
  }
  function _reset_objects(){
    $is_eski_silindi=SiparislerHelperC::unset_obj_eski();
    $is_yeni_silindi=SiparislerHelperC::unset_obj_yeni();
    if($is_eski_silindi && $is_yeni_silindi){
      return true;
    }else{
      return false;
    }
  }
}
?>
