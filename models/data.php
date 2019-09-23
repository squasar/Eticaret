<?php
//data class models that lies on the database
require_once('db_proc.php');

class Musteri{
  protected $musteri_id;
  protected $email;
  protected $sifre;
  protected $telefon;
  protected $isim;
  protected $adres;
  protected $sehir;
  protected $posta_kodu;
  protected $ulke;

  function __construct(){
  }

  function __setAll($email, $sifre, $telefon, $isim,
                        $adres, $sehir, $posta_kodu, $ulke){
    $this->email=$email;
    $this->sifre=$sifre;
    $this->telefon=$telefon;
    $this->isim=$isim;
    $this->adres=$adres;
    $this->sehir=$sehir;
    $this->posta_kodu=$posta_kodu;
    $this->ulke=$ulke;
}

  function __setEmail($email){
    $this->email=$email;
  }

  function __setSifre($sifre){
    $this->sifre=$sifre;
  }

  function register_musteri(){
    //add it to database
    $m_query="insert into musteriler values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $param_strs="sssssssss";
    $params=array(&$this->musteri_id, &$this->email, &$this->sifre, &$this->telefon, &$this->isim,
              &$this->adres, &$this->sehir, &$this->posta_kodu, &$this->ulke);
    $res=insert_execQ($m_query, $param_strs, $params);
    return $res;
  }

  function login_musteri(){
    //check creditentals on db
    $m_query="select * from musteriler where email=? and sifre=?";
    $param_strs="ss";
    $params=array(&$this->email, &$this->sifre);
    @$res=_execQ($m_query, $param_strs, $params);
    //initialize values including $musteri_id if all passed
    //...
    return $res;
  }

  function update_musteri($old_val, $new_val){
    //update $_val about musteri in db
    //by comparing $_old_val param with all attributes
  }

  function delete_musteri($info){
    //delete an account
  }

  function get_customer_infos(){
    return "infos{
      \"id\":\"$this->musteri_id\",
      \"email\":\"$this->email\",
      \"telefon\":\"$this->telefon\",
      \"isim\":\"$this->isim\",
      \"adres\":\"$this->adres\",
      \"sehir\":\"$this->sehir\",
      \"posta_kodu\":\"$this->posta_kodu\",
      \"ulke\":\"$this->ulke\"}";
  }

  public function add_yorum($isbn){

  }

  public function send_message($alici_id){

  }
}




class Admin extends Musteri{
  private $kullanici_adi;
  public function set_kullanici_adi($kullanici_adi){

  }
  public function get_kullanici_adi(){
    return $kullanici_adi;
  }
  public function add_admin(){

  }
  public function add_kategori(){

  }
  public function add_kitap(){

  }

}

class Kategori{
  protected $kategori_adi;
  protected $kategori_id;

  function get_kategoriler() {
   $m_query = "select kategori_id, kategori_adi from kategoriler";
   @$result=c_exec($m_query);
   //initialize variables
   //...
   return $result;
 }

  function get_kategori_adi($catid) {
   // query database for the name for a category id
   $m_query = "select kategori_adi from kategoriler
             where kategori_id=?";
   $param_strs="i";
   $params=array(&$catid);
   @$res=_execQ($m_query, $param_strs, $params);
   //Some initializations if necessary
   //...
   return $res;
 }

 function add_kategori($catname){
   $m_query="insert into kategoriler values(?, ?)";
   $param_strs="ss";
   $params=array(&$this->kategori_id, &$catname);
   @$res=insert_execQ($m_query, $param_strs, $params);
   //Some preprocesses if necessary
   //...
   return $res;
 }

 function delete_kategori($catid){

 }
}


class Kitap extends Kategori{
  private $isbn;
  private $yazar;
  private $baslik;
  private $fiyat;
  private $aciklama;

  public function set_all($isbn, $yazar, $baslik, $fiyat, $aciklama, $kategori_id){
    set_isbn($isbn);
    set_yazar($yazar);
    set_baslik($baslik);
    $this->fiyat=$fiyat;
    $this->aciklama=$aciklama;
    set_kategori($kategori_id);
  }

  public function set_isbn($isbn){
    $this->isbn=$isbn;
  }

  public function set_yazar($yazar){
    $this->yazar=$yazar;
  }

  public function set_baslik($baslik){
    $this->baslik=$baslik;
  }

  public function set_kategori($catid){
    $this->kategori_id=$catid;
    $this->kategori_adi=$this->get_kategori_adi($this->kategori_id);
  }

  public function tum_kitaplar_getir(){
    $m_query = "select * from kitaplar";
    @$result=c_exec($m_query);
    //initialize variables
    //...
    return $result;
  }

  public function kategori_kitaplar_getir(){
    $m_query = "select * from kitaplar
              where kategori_id=?";
    $param_strs="i";
    $params=array(&$this->kategori_id);
    @$res=_execQ($m_query, $param_strs, $params);
    //Some initializations if necessary
    //...
    return $res;
  }

  public function isbn_kitap_getir(){
    $m_query = "select * from kitaplar
              where isbn=?";
    $param_strs="s";
    $params=array(&$this->isbn);
    @$res=_execQ($m_query, $param_strs, $params);
    //Some initializations if necessary
    //...
    return $res;
  }

  public function yazar_kitaplar_getir(){
    $m_query = "select * from kitaplar
              where yazar=?";
    $param_strs="s";
    $params=array(&$this->yazar);
    @$res=_execQ($m_query, $param_strs, $params);
    //Some initializations if necessary
    //...
    return $res;
  }

  public function baslik_kitap_getir(){
    $m_query = "select * from kitaplar
              where baslik=?";
    $param_strs="s";
    $params=array(&$this->baslik);
    @$res=_execQ($m_query, $param_strs, $params);
    //Some initializations if necessary
    //...
    return $res;
  }

  public function kitap_ekle(){
    //tanimli bilgilere gore kitabi ekle
    $m_query="insert into kitaplar values(?, ?, ?, ?, ?, ?)";
    $param_strs="sssifs";
    $params=array(&$this->isbn, &$this->yazar, &$this->baslik, &$this->kategori_id,
                    &$this->fiyat, &$this->aciklama);
    @$res=insert_execQ($m_query, $param_strs, $params);
    //Some preprocesses if necessary
    //...
    return $res;
  }

  public function kitap_sil(){

  }
}


class Siparis{
  private $isbn; //from the book
  private $siparis_tutari;//book price
  private $siparis_adedi;
}


class Siparisler{
  private $siparis_id;
  private $_siparisler = array();//Add Siparis objects
  private $musteri_id;//the customer who these orders ($_siparisler) belong
  private $toplam_fiyat;
  private $tarih;
  private $siparis_durumu;
  private $teslimat_yontemi;
  private $teslimat_adresi;
  private $teslimat_sehir;
  private $teslimat_pk;
  private $teslimat_ulkesi;

}


class Mesaj{
  private $msg_id;
  private $alici_id;
  private $gonderici_id;
  private $tarih;
  private $mesaj;

  }



class Yorum{
  private $yorum_id;
  private $isbn;//from book
  private $tarih;
  private $musteri_id;
  private $yorum;

}


?>
