<?php
//sepete ekle butonuna tiklanmissa kitap bilgilerini alarak sepete ekleme islemi yap
//kullanicinin sepetindekileri getirip goster.
include 'autoload.php';
session_start();

if(empty($_POST)){
  $tmp="STRINGEX3";
}else{
  $tmp = array_keys($_POST);
}

//ya sepete ekleme yapilacak ya da sepet guncellenecek,
//ya da hic bir islem yapilmayip sadece degerler gosterilecek
$prefix="adetqty";
$prefix_two="payqty";
$s_isbn="STRINGEX3";

$is_guncelle=false;
$is_sepete_ekle=false;
$is_goster=false;

$_guncellenecekler=array(array());
$_temp=false;
$is_pay_pressed=false;

for ($i=0; $i < count($tmp); $i++) {
  $val=$tmp[$i];
  $result=preg_split("/[~]/",$val);
  if($result[0] == $prefix){
    $s_isbn=$result[1];
    $s_id=$result[2];
    $key = $prefix."~".$s_isbn."~".$s_id;
    if(isset($_POST[''.$key.''])){
      $adet = $_POST[''.$key.''];
      //gercek adetleri tutup getir. degerler ayniysa guncelleme, degilse guncelle
      $sip=new Siparis($s_isbn, $s_id);
      $sip=$sip->veritabanindan_getir($sip);
      $real_adet=$sip->get_siparis_adedi();
      if($adet<$real_adet){
        $is_guncelle=true;
        $isbn=$s_isbn;
        $item=array($isbn,$adet);
        $inx=count($_guncellenecekler);
        $_guncellenecekler[$inx]=$item;

      }else if($adet>$real_adet){
        $is_guncelle=true;
        $isbn=$s_isbn;
        $item=array($isbn,$adet);
        $inx=count($_guncellenecekler);
        $_guncellenecekler[$inx]=$item;

      }else{
        $is_guncelle=false;
      }
    }
    if($is_guncelle){
      $_temp=true;
      $suffix="guncelle";
    }
  }else if($result[0] == $prefix_two){
      $is_pay_pressed=true;
  }
}

$is_guncelle=$_temp;

if(!$is_guncelle){
  $adet="STRINGEX3";
  $suffix="sepetekle";
  for ($j=0; $j < count($tmp); $j++) {
    $val_two=$tmp[$j];
    $res=preg_split("/[~]/",$val_two);
    if($res[1] == $suffix){
      $isbn=$res[0];
      $is_sepete_ekle=true;
    }
  }
  if(!$is_sepete_ekle){
    $isbn="STRINGEX3";//herhangi bir sekilde bir isbn secilmedi -- gosterme islemi
    $suffix="goster";
  }
}

//veriyi ayarla
$musteri_id=$_SESSION['musteri_id'];
$helper = new SepetIslemleriHelper($tmp,$musteri_id, $adet, $isbn, $suffix, $_guncellenecekler);

$_obj=new SepetIslemleri($helper);

$objm=$_obj->get_obj();
$obj = $objm[0]->__get_siparisler();
$_SESSION['sepet_obj']=$obj;
$_SESSION['sepet_islem']=$helper->__get_islem_adi();

//yapilan islem kaydini al
$yapilan_islem = $helper->__get_islem_adi();
//ilgili kayitlari temizle
unset($helper);
unset($_obj);

//yonlendirmeyi sagla
if($is_pay_pressed){
  @header("location:checkout.php");
}else{
  @header("location:../views/in_sepetim.php");
}
?>
