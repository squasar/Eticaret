<?php
//Oturum acilip acilmadigina gore sepete ekle butonunu duzenle
//Kitap detaylarini goster.
session_start();

$in_x;
$in_y;

for ($i=0; $i < count($_SESSION['kitaplar']); $i++) {
  for ($j=0; $j < count($_SESSION['kitaplar'][$i]); $j++) {
    $kitaplar[$i][$j]=$_SESSION['kitaplar'][$i][$j]['isbn'];
    if(isset($_POST['extra_par_'.$kitaplar[$i][$j]])){
        $in_x=$i;
        $in_y=$j;
        unset($_POST['extra_par_'.$kitaplar[$i][$j]]);
    }
  }
}

$secilen_isbn=$_SESSION['kitaplar'][$in_x][$in_y]['isbn'];
$secilen_kitap_adi=$_SESSION['kitaplar'][$in_x][$in_y]['baslik'];
$secilen_kitap_yazar=$_SESSION['kitaplar'][$in_x][$in_y]['yazar'];
$secilen_kitap_fiyat=$_SESSION['kitaplar'][$in_x][$in_y]['fiyat'];
$secilen_kitap_aciklama=$_SESSION['kitaplar'][$in_x][$in_y]['aciklama'];

$id;
if(isset($_SESSION['musteri_id'])){
  $id=$_SESSION['musteri_id'];
}else{
  $id="";
}
$isim;
if(isset($_SESSION['isim'])){
  $isim=$_SESSION['isim'];
}else{
  $isim="";
}

$ch=curl_init();
$veri=array('isbn'=>"$secilen_isbn", 'baslik'=>"$secilen_kitap_adi",
              'yazar'=>"$secilen_kitap_yazar", 'fiyat'=>"$secilen_kitap_fiyat",
                'aciklama'=>"$secilen_kitap_aciklama", 'id'=>"$id", 'isim'=>"$isim");
$url='http://localhost/eticaret/views/kitap_detay_goster.php';
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $veri);
curl_exec($ch);
curl_close($ch);

?>
