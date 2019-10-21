<?php
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
  protected $connector;//= new MySQLQueries();

  function __construct(){
    $this->connector=new MySQLQueries();
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
    $res=$this->connector->insert_execQ($m_query, $param_strs, $params);
    return $res;
  }

  function login_musteri(){

    //check creditentals on db
    $m_query="select * from musteriler where email=? and sifre=?";
    $param_strs="ss";
    $params=array(&$this->email, &$this->sifre);
    $res=$this->connector->_execQ($m_query, $param_strs, $params);
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

  function get_customer_infos($musteri_id){
    $m_query="select email, telefon, isim, adres, sehir, posta_kodu, ulke from musteriler where musteri_id=?";
    $param_strs="i";
    $params=array(&$musteri_id);
    @$res=$this->connector->_execQ($m_query, $param_strs, $params);
    $this->musteri_id=$musteri_id;
    $this->email=$res[0]['email'];
    $this->telefon=$res[0]['telefon'];
    $this->isim=$res[0]['isim'];
    $this->adres=$res[0]['adres'];
    $this->sehir=$res[0]['sehir'];
    $this->posta_kodu=$res[0]['posta_kodu'];
    $this->ulke=$res[0]['ulke'];

    $result = $this->musteri_id."~".
    $this->email."~".
    $this->telefon."~".
    $this->isim."~".
    $this->adres."~".
    $this->sehir."~".
    $this->posta_kodu."~".
    $this->ulke;

    return $result;
  }

  public function add_yorum($isbn){

  }

  public function send_message($alici_id){

  }
}



?>
