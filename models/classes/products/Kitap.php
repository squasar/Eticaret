<?php
class Kitap extends Kategori{
  private $isbn;
  private $yazar;
  private $baslik;
  private $fiyat;
  private $aciklama;
  
  public function __construct(){
    $this->connector=new MySQLQueries();
  }

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
    @$result=$this->connector->c_exec($m_query);
    //initialize variables
    //...
    return $result;
  }

  public function kategori_kitaplar_getir(){
    $m_query = "select * from kitaplar
              where kategori_id=?";
    $param_strs="i";
    $params=array(&$this->kategori_id);
    @$res=$this->connector->_execQ($m_query, $param_strs, $params);
    //Some initializations if necessary
    //...
    return $res;
  }

  public function isbn_kitap_getir(){
    $m_query = "select * from kitaplar
              where isbn=?";
    $param_strs="s";
    $params=array(&$this->isbn);
    @$res=$this->connector->_execQ($m_query, $param_strs, $params);
    //Some initializations if necessary
    //...
    return $res;
  }

  public function yazar_kitaplar_getir(){
    $m_query = "select * from kitaplar
              where yazar=?";
    $param_strs="s";
    $params=array(&$this->yazar);
    @$res=$this->connector->_execQ($m_query, $param_strs, $params);
    //Some initializations if necessary
    //...
    return $res;
  }

  public function baslik_kitap_getir(){
    $m_query = "select * from kitaplar
              where baslik=?";
    $param_strs="s";
    $params=array(&$this->baslik);
    @$res=$this->connector->_execQ($m_query, $param_strs, $params);
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
    @$res=$this->connector->insert_execQ($m_query, $param_strs, $params);
    //Some preprocesses if necessary
    //...
    return $res;
  }

  public function kitap_sil(){

  }
}

?>
