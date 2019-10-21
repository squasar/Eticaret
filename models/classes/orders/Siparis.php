<?php
class Siparis{
  private $siparis_id;
  private $isbn; //from the book
  private $siparis_tutari;//book price
  private $siparis_adedi;

  private $siparis_fiyati;

  private $connector;

  public function __construct($isbn, $siparis_id){
    //isbn i verilen kitabin fiyatini getir
    $this->isbn=$isbn;
    $this->connector=new MySQLQueries();
    $this->siparis_id=$siparis_id;
    $_kitap = new Kitap();
    $_kitap->set_isbn($this->isbn);
    $k_obj=$_kitap->isbn_kitap_getir();

    $this->siparis_tutari = $k_obj[0]['fiyat'];
    $this->siparis_adedi = 1;

    $this->siparis_fiyati = $this->siparis_tutari * $this->siparis_adedi;
  }

  //siparis tablosu icin...
  public function veritabanina_ekle(){
    $m_query="insert into siparis values(?, ?, ?, ?)";
    $param_strs="isdi";
    $p_siparis_id=$this->get_siparis_id();
    $p_isbn=$this->get_isbn();
    $p_siparis_tutari=$this->get_siparis_tutari();
    $p_siparis_adedi=$this->get_siparis_adedi();
    echo "</br>siparis id: ".$p_siparis_id."</br>";
    echo "</br>".$p_siparis_id.$p_isbn.$p_siparis_tutari.$p_siparis_adedi."</br>";
    $params=array(&$p_siparis_id, &$p_isbn, &$p_siparis_tutari, &$p_siparis_adedi);
    $this->connector->insert_execQ($m_query, $param_strs, $params);
    echo "BURASI CALISTI222";
  }

  public function veritabanindan_sil(){
    $m_query="delete from siparis where siparis_id=? and isbn=?";
    $param_strs="is";
    $p_siparis_id=$this->get_siparis_id();
    $p_isbn=$this->get_isbn();
    $params=array(&$p_siparis_id, &$p_isbn);
    $this->connector->insert_execQ($m_query, $param_strs, $params);
  }

  public function veritabanindan_getir($siparis_obj){
    //siparis tablosuna gore objeyi ayarla
    $m_query="select * from siparis where siparis_id=? and isbn=?";
    $param_strs="is";
    $p_id=$siparis_obj->get_siparis_id();
    $p_isbn=$siparis_obj->get_isbn();
    $params=array(&$p_id, &$p_isbn);
    @$res=$this->connector->_execQ($m_query, $param_strs, $params);
    $siparis_obj->__set_siparis_adedi($res[0]['siparis_adedi']);
    $siparis_obj->__set_siparis_tutari($res[0]['siparis_tutari']);
    //objeyi geri donder
    return $siparis_obj;
  }

  public function set_siparis_adedi($adet){
    $this->siparis_adedi=$adet;
    $this->siparis_fiyati = $this->siparis_adedi * $this->siparis_tutari;
    //siparis tablosunu guncelle
    $m_query="update siparis set siparis_adedi=? , siparis_tutari=? where siparis_id=? and isbn=?";
    $param_strs="idis";
    //$p_id=$this->get_siparis_id();
    //$p_isbn=$this->get_isbn();
    $params=array(&$this->siparis_adedi, &$this->siparis_fiyati, &$this->siparis_id, &$this->isbn);
    $this->connector->insert_execQ($m_query, $param_strs, $params);
  }

  public function __set_siparis_adedi($m_adet){
    $this->siparis_adedi=$m_adet;
  }

  public function __set_siparis_tutari($m_tutar){
    $this->siparis_fiyati=$m_tutar;
  }

  public function get_siparis_adedi(){
    return $this->siparis_adedi;
  }

  public function get_siparis_tutari(){
    return $this->siparis_fiyati;
  }

  public function get_isbn(){
    return $this->isbn;
  }

  public function get_kitap(){
    $ktp = new Kitap();
    $ktp->set_isbn($this->isbn);
    $temp=$ktp->isbn_kitap_getir();
    $result=array();
    $result[0]=$temp[0]['baslik'];
    $result[1]=$temp[0]['yazar'];
    return $result;
  }

  public function get_siparis_id(){
    return $this->siparis_id;
  }
}

?>
