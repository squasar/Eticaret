<?php
class SiparislerHelperC{
  private static $_obj_eski;
  private static $_obj_yeni;
  private static $sprslr_helper;
  private function __construct(){}
  public static function get_obj_eski_instance($musteri_id){
    if(empty(self::$_obj_eski)){
      @self::$sprslr_helper = new SiparislerHelper();
      @self::$_obj_eski=@self::$sprslr_helper->create_bring_siparisler($musteri_id, true);
    }
    return self::$_obj_eski;
  }
  public static function get_obj_yeni_instance($musteri_id){
    if(empty(self::$_obj_yeni)){
      @self::$sprslr_helper = new SiparislerHelper();
      @self::$_obj_yeni=@self::$sprslr_helper->create_bring_siparisler($musteri_id, false);
    }
    return self::$_obj_yeni;
  }
  public static function unset_obj_eski(){
    unset(self::$_obj_eski);
    if(isset(self::$_obj_eski)){
      return false;
    }else{
      return true;
    }
  }
  public static function unset_obj_yeni(){
    unset(self::$_obj_yeni);
    if(isset(self::$_obj_yeni)){
      return false;
    }else{
      return true;
    }
  }
}

?>
