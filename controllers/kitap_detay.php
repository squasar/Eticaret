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


//asagidaki kodlar view de ayarlanacak
if((isset($_SESSION['musteri_id']) && isset($_SESSION['isim']))){
  $secilen_isbn=$_SESSION['kitaplar'][$in_x][$in_y]['isbn'];
  $secilen_kitap_adi=$_SESSION['kitaplar'][$in_x][$in_y]['baslik'];
  echo "Kitap ISBN : ".$secilen_isbn."<br />";
  echo "Kitap Adi : ".$secilen_kitap_adi."<br />";
  //arayuzdeki sepete ekle butonunu aktif et
}else{
  $secilen_isbn=$_SESSION['kitaplar'][$in_x][$in_y]['isbn'];
  $secilen_kitap_adi=$_SESSION['kitaplar'][$in_x][$in_y]['baslik'];
  echo "Kitap ISBN : ".$secilen_isbn."<br />";
  echo "Kitap Adi : ".$secilen_kitap_adi."<br />";
  //sepete ekle butonunu deaktif hale getir
}
?>
