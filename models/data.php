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


  function __construct($email, $sifre, $telefon, $isim,
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

  /* SAMPLE USAGE _execQ
  $m_query = "insert into kitaplar values(?, ?, ?, ?, ...)";
  $param_strs="sssd...";
  $param1='1234569658741';
  ...
  $params=array(&$param1,&$param2,...);
  _execQ($m_query, $param_strs, $params);
  */
  function register_musteri(){
    //add it to database
    $m_query="insert into musteriler values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $param_strs="sssssssss";
    $params=array(&$this->musteri_id, &$this->email, &$this->sifre, &$this->telefon, &$this->isim,
              &$this->adres, &$this->sehir, &$this->posta_kodu, &$this->ulke);
    $res=_execQ($m_query, $param_strs, $params);
    return $res;
  }

  function login_musteri(){
    //check creditentals on db
    //initialize values including $musteri_id if all passed
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

class Kategoriler{
  protected $kategori_adi;
  protected $kategori_id;
}

class Kitap extends Kategoriler{
  private $isbn;
  private $yazar;
  private $baslik;
  private $fiyat;
  private $aciklama;

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
