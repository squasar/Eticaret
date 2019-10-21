<?php
define('ORDER_STATUS_ONE',"BEKLEMEDE");
define('ORDER_STATUS_TWO',"ODENDI");
define('ORDER_STATUS_THREE',"YOLDA");
define('ORDER_STATUS_FOUR',"ULASTI");

class Siparisler{
  private $siparis_id;
  private $_siparisler = array(array());//Add Siparis objects
  private $musteri_id;//the customer who these orders ($_siparisler) belong
  private $toplam_fiyat=array();
  private $tarih;
  private $siparis_durumu;
  private $teslimat_yontemi;
  private $teslimat_adresi;
  private $teslimat_sehir;
  private $teslimat_pk;
  private $teslimat_ulkesi;

  private $connector;

  public function __construct($musteri_id, $is_odendi){
    $this->connector=new MySQLQueries();
    //set musteri_id
    $this->musteri_id=$musteri_id;
    $sonuc = $this->siparisleri_getir($is_odendi);//false ise odenmemis siparisler varsa onu getirir yoksa yeni olusturur.
    if($sonuc == -1){
      //veritabaninda ilk siparisler kaydini olustur ve gelen ilk siparisi ekle
      $m_query="insert into siparisler values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $param_strs="iidsssssss";
      $params=array(&$this->siparis_id, &$this->musteri_id, &$this->toplam_fiyat[0], &$this->tarih,
                    &$this->siparis_durumu, &$this->teslimat_yontemi, &$this->teslimat_adresi,
                    &$this->teslimat_sehir, &$this->teslimat_pk, &$this->teslimat_ulkesi);
      $this->connector->insert_execQ($m_query, $param_strs, $params);
      $this->siparis_id=$this->get_siparisler_id_from_db($this->musteri_id, true);
    }else if($sonuc == 1){
      //on hold bir siparislerim kaydi varsa veritabaninda...
      $this->siparis_id=$this->get_siparisler_id_from_db($this->musteri_id, true);
    }else if($sonuc == 0){
      //on hold olmayan siparislerin veritabaninda kaydi varsa...
      $this->siparis_id=$this->get_siparisler_id_from_db($this->musteri_id, false);
    }
  }

  public function siparis_ekle_ayarla($isbn, $adet){
    //$isbn uzerinden siparis bilgisi ara ve gerekli alanlari set et.
    $siparis_obj;
    //eger _siparisler dizisinde ayni eleman yoksa...
    $is_varmi = false;
    $on_hold_siparis_adedi = count($this->_siparisler[0]);
    for($i=0 ; $i < $on_hold_siparis_adedi ; $i++){
      if($this->_siparisler[0][$i]->get_isbn() == $isbn){
        $is_varmi=true;
        $siparis_obj=$this->_siparisler[0][$i];
        break;
      }
    }

    //diziye ekle ve/veya veritabanini guncelle
    if(!$is_varmi){
      $siparis_obj = new Siparis($isbn, $this->siparis_id);
      $this->_siparisler[0][$on_hold_siparis_adedi]=$siparis_obj;
      $siparis_obj->veritabanina_ekle();
    }else{
      $t_adet = $siparis_obj->get_siparis_adedi() + 1;
      if($adet === "STRINGEX"){
        $siparis_obj->set_siparis_adedi($t_adet);
      }else{
        if($adet<=0){
          $this->siparis_sil($siparis_obj->get_isbn());
        }else{
          $siparis_obj->set_siparis_adedi($adet);
        }
      }
    }
    //tum siparislerin toplam fiyatini hesapla
    $this->toplam_fiyat_hesapla();
  }

  public function siparis_sil($isbn){
    //$isbn uzerinden ilgili elemani bul ve ayarla
    $siparis_obj = new Siparis($isbn, $this->siparis_id);
    $siparis_obj = $siparis_obj->veritabanindan_getir($siparis_obj);
    if($key = array_search($siparis_obj, $this->_siparisler[0])){
      $boundary=count($this->_siparisler[0]);
      for ($i=$key; $i+1 <= $boundary; $i++) {
        $temp=@$this->_siparisler[0][$i+1];
        $this->_siparisler[0][$i]=$temp;
      }
      unset($this->_siparisler[0][$boundary-1]);
    }
    $siparis_obj->veritabanindan_sil();
    $this->toplam_fiyat_hesapla();
  }

  private function siparisleri_getir($is_odendi){
    //is_odendi false ise
    //Status ON_HOLD olan siparis_id degerini getir
    //is_odendi true ise status ON_HOLD olmayan diger tum siparis id leri getir
    if(!$is_odendi){
        $m_query="select siparis_id, toplam_fiyat from siparisler where muster_id=? and siparis_durumu=?";
        $param_strs="is";
        $par=ORDER_STATUS_ONE;
        $params=array(&$this->musteri_id, &$par);
        @$res=$this->connector->_execQ($m_query, $param_strs, $params);
        $sonuc_sayisi=count($res);
        //echo "</br> sonuc_sayisi = ".$sonuc_sayisi."</br>";
        if($sonuc_sayisi>0){//sonuc sayisi 0 dan fazlaysa
          //ON_HOLD siparis id var. siparis tablosunda varolan siparis kayitlarini getirerek diziye ekle
          $m_query2="select isbn from siparis where siparis_id=?";
          $param_strs2="i";
          $params2=array(&$res[0]['siparis_id']);
          @$res2=$this->connector->_execQ($m_query2, $param_strs2, $params2);
          $sonuc_sayisi2=count($res2);
          for ($i=0; $i < $sonuc_sayisi2; $i++) {
            $_obj=new Siparis($res2[$i]['isbn'], $res[0]['siparis_id']);
            $this->siparis_id=$res[0]['siparis_id'];
            $_obj=$_obj->veritabanindan_getir($_obj);
            $this->_siparisler[0][$i]=$_obj;
          }
          $this->toplam_fiyat[0]=$res[0]['toplam_fiyat'];
          return 1;
        }else{
          $this->ilk_siparisleri_olustur();
          return -1;
        }
    }else{
      $m_query="select siparis_id, toplam_fiyat from siparisler where muster_id=? and siparis_durumu!=?";
      $param_strs="is";
      $par=ORDER_STATUS_ONE;
      $params=array(&$this->musteri_id, &$par);
      @$res=$this->connector->_execQ($m_query, $param_strs, $params);
      //tum sonuclari alarak siparisleri dizilere ekle
      $sonuc_sayisi=count($res);
      for ($i=0; $i < $sonuc_sayisi; $i++) {
        $m_query2="select isbn from siparis where siparis_id=?";
        $param_strs2="i";
        $params2=array(&$res[$i]['siparis_id']);
        @$res2=$this->connector->_execQ($m_query2, $param_strs2, $params2);
        $sonuc_sayisi2=count($res2);
        for ($j=0; $j < $sonuc_sayisi2; $j++) {
          $_obj=new Siparis($res2[$j]['isbn'], $res[$i]['siparis_id']);
          $_obj=$_obj->veritabanindan_getir($_obj);
          $this->_siparisler[$i][$j] = $_obj;
        }
        $this->toplam_fiyat[$i]=$res[$i]['toplam_fiyat'];
      }
      //$this->toplam_fiyat_hesapla();
      return 0;
    }
    //olusturulan _siparisler dizisinde;
    //musteri id ile ilgili hic siparis_id yoksa:
    //default degerlerle (status ON HOLD) yeni kayit olusturup siparisler tablosuna ekleyerek -1 donder
    //herhangi bir kayit var ise diziyi ayarlayip +1 donder

    //diziyi ayarlama isleminde:
    //belirlenen status a gore siparis tablosunda id lere gore arama yaparak, diziye gerekli elemanlar eklenir.
    //ON HOLD disindaki siparisler sadece gosterim amaclidir.
  }

  public function ilk_siparisleri_olustur(){
    //ilk siparisler nesnesi olusturan fonksiyon
    $_obj=new Musteri();
    $params=$_obj->get_customer_infos($this->musteri_id);
    $this->set_teslimat_adresi_default($params);
    $this->teslimat_yontemi="KARGO";
    $this->siparis_durumu=ORDER_STATUS_ONE;
    $this->toplam_fiyat[0]=0.00;
    $this->tarih=date("Y-m-d");
  }

  public function checkout_et(){
    $this->set_siparis_durumu(ORDER_STATUS_TWO);
  }

  public function siparisi_adrese_yolla(){
    $this->set_siparis_durumu(ORDER_STATUS_THREE);
  }

  public function siparisi_ulastir(){
    $this->set_siparis_durumu(ORDER_STATUS_FOUR);
  }

  private function teslimat_masrafi_hesapla(){
    //su an icin teslimat masraflari fix
    return 10.00;
  }

  private function toplam_fiyat_hesapla(){
    //dizideki siparislerin toplam fiyatini hesapla
    //toplam fiyat degerini siparislerim tablosundan guncelle
    //if(count($_siparisler[0])>0){
    //echo "</br>COUNT OF ARR = ".count($this->_siparisler[0])."</br>";
    if(isset($this->_siparisler[0])){
      $toplam=0.00;
      for ($i=0; $i < count($this->_siparisler[0]) ; $i++) {
        $toplam=$toplam+$this->_siparisler[0][$i]->get_siparis_tutari();
      }
      $toplam = $toplam + $this->teslimat_masrafi_hesapla();
      echo "</br> Toplam Fiyat : ".$toplam."</br>";
      $this->toplam_fiyat[0]=$toplam;

      $prm=ORDER_STATUS_ONE;
      $m_query="update siparisler set toplam_fiyat=? where siparis_id=? and siparis_durumu=?";
      $param_strs="dis";
      $params=array(&$toplam, &$this->siparis_id, &$prm);
      $this->connector->insert_execQ($m_query, $param_strs, $params);
    }
  }

  private function set_siparis_durumu($status){
    $this->siparis_durumu=$status;
    $this->tarih=date("Y-m-d");
    //siparisler tablosunda ve dizide ilgili alanlari guncelle
    $m_query="update siparisler set tarih=? , siparis_durumu=? where siparis_id=?";
    $param_strs="ssi";
    $params=array(&$this->tarih, &$this->siparis_durumu, &$this->siparis_id);
    $this->connector->insert_execQ($m_query, $param_strs, $params);
  }

  public function set_teslimat_yontemi($yontem){
    $this->teslimat_yontemi = $yontem;
    //siparisler tablosunu guncelle
    $m_query="update siparisler set teslimat_yontemi=? where siparis_id=?";
    $param_strs="si";
    $params=array(&$this->teslimat_yontemi, &$this->siparis_id);
    $this->connector->insert_execQ($m_query, $param_strs, $params);
  }

  public function adresi_guncelle(){
    //siparisler tablosunda musteri_id si verilen HOLD ON siparisin adresini guncelle
    //siparisler tablosunda adres bilgilerini ayarla
    $m_query="update siparisler set teslimat_adresi=? , teslimat_sehir=? , teslimat_pk=? , teslimat_ulkesi=?
              where siparis_id=? and siparis_durumu=?";
    $durum=ORDER_STATUS_ONE;
    $param_strs="ssssis";
    $params=array(&$this->teslimat_adresi, &$this->teslimat_sehir, &$this->teslimat_pk,
                  &$this->teslimat_ulkesi, &$this->siparis_id, &$durum);
    $this->connector->insert_execQ($m_query, $param_strs, $params);
  }

  public function set_teslimat_adresi($adres, $sehir, $pk, $ulke){
    $this->teslimat_adresi=$adres;
    $this->teslimat_sehir=$sehir;
    $this->teslimat_pk=$pk;
    $this->teslimat_ulkesi=$ulke;
  }

  public function set_teslimat_adresi_default($params){
    //$params degerleri split edilerek musteriyle ile ilgili bilgiler burada set edilecek
    $result=preg_split("/[~]/",$params);
    $this->musteri_id=$result[0];
    $this->teslimat_adresi=$result[4];
    $this->teslimat_sehir=$result[5];
    $this->teslimat_pk=$result[6];
    $this->teslimat_ulkesi=$result[7];
  }

  private function get_siparisler_id_from_db($musteri_id, $is_active){
    if($is_active){
      $m_query="select siparis_id from siparisler where muster_id=? and siparis_durumu=?";
      $status=ORDER_STATUS_ONE;
      $param_strs="is";
      $params=array(&$musteri_id, &$status);
      @$res=$this->connector->_execQ($m_query, $param_strs, $params);
      $_id=$res[0]['siparis_id'];
      return $_id;
    }else{
      $m_query="select siparis_id from siparisler where muster_id=? and siparis_durumu!=?";
      $status=ORDER_STATUS_ONE;
      $param_strs="is";
      $params=array(&$musteri_id, &$status);
      @$res=$this->connector->_execQ($m_query, $param_strs, $params);
      return $res;
    }
  }


  //getters
  /*public function __get_siparis_id(){
    return $this->siparis_id;
  }*/

  /*public function __get_musteri_id(){
    return $this->musteri_id;
  }*/

  public function __get_tarih(){
    return $this->tarih;
  }

  public function __get_siparis_durumu(){
    return $this->siparis_durumu;
  }

  public function __get_teslimat_yontemi(){
    return $this->teslimat_yontemi;
  }

  public function __get_teslimat_adresi(){
    return $this->teslimat_adresi;
  }

  public function __get_teslimat_sehir(){
    return $this->teslimat_sehir;
  }

  public function __get_teslimat_pk(){
    return $this->teslimat_pk;
  }

  public function __get_teslimat_ulkesi(){
    return $this->teslimat_ulkesi;
  }

  public function __get_toplam_fiyat(){
    return $this->toplam_fiyat;
  }

  public function __get_siparisler(){
    return $this->_siparisler;
  }
/*
  //setters
  public function __set_tarih($tarih){
    $this->tarih=$tarih;
  }

  public function __set_siparis_durumu($durum){
    $this->siparis_durumu=$durum;
  }

  public function __set_teslimat_yontemi($yontem){
    $this->teslimat_yontemi=$yontem;
  }

  public function __set_teslimat_adresi($adres){
    $this->teslimat_adresi=$adres;
  }

  public function __set_teslimat_sehir($sehir){
    $this->teslimat_sehir=$sehir;
  }

  public function __set_teslimat_pk($pk){
    $this->teslimat_pk=$pk;
  }

  public function __set_teslimat_ulkesi($ulke){
    $this->teslimat_ulkesi=$ulke;
  }

  public function __set_toplam_fiyat($toplam_fiyat){
    $this->toplam_fiyat=$toplam_fiyat;
  }
*/
}

?>
