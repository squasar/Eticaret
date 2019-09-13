<?php
//data class models that lies on the database
interface Gonder{
  function d_select();
  function d_insert();
  function d_update();
  function d_delete();
}


class Musteri implements Gonder{
  protected $musteri_id;
  protected $email;
  protected $sifre;
  protected $telefon;
  protected $isim;
  protected $adres;
  protected $sehir;
  protected $posta_kodu;
  protected $ulke;

  function d_select(){
    //bring the all customer info and initialize
  }
  function d_insert(){
    //register a new customer
  }
  function d_update(){
    //update any info about customer given
  }
  function d_delete(){
    //delete an account
  }


}

class Admin extends Musteri{
  private $kullanici_adi;
}

class Kategoriler implements Gonder{
  protected $kategori_adi;
  protected $kategori_id;

  function d_select(){
    //bring the all categories and initialize
  }
  function d_insert(){
    //add a new category
  }
  function d_update(){
    //update any category attribute which is the name in that case
  }
  function d_delete(){
    //delete a category
  }
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


class Siparisler implements Gonder{
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

  function d_select(){
    //bring the all siparisler info user did
  }
  function d_insert(){
    //insert a new siparis
  }
  function d_update(){
    //update any info about siparisler if necessary
  }
  function d_delete(){
    //delete a siparis or all
  }
}


class Mesaj implements Gonder{
  private $msg_id;
  private $alici_id;
  private $gonderici_id;
  private $tarih;
  private $mesaj;

  function d_select(){
    //bring the all messages for user
  }
  function d_insert(){
    //send a message
  }
  function d_update(){
    //SHOULD NOT BE IMPLEMENTED
  }
  function d_delete(){
    //SHOULD NOT BE IMPLEMENTED
  }

}

class Yorum implements Gonder{
  private $yorum_id;
  private $isbn;//from book
  private $tarih;
  private $musteri_id;
  private $yorum;


  function d_select(){
    //bring the all messages for user
  }
  function d_insert(){
    //send a message
  }
  function d_update(){
    //SHOULD NOT BE IMPLEMENTED
  }
  function d_delete(){
    //SHOULD NOT BE IMPLEMENTED
  }

}


?>
