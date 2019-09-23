<?php
  require("../page.inc");
  session_start();

  $kategoriler=array();
  $kitaplar=array(array());

  for ($i=0; $i < count($_SESSION['kategoriler'][0]); $i++) {
    $kategoriler[$i]=$_SESSION['kategoriler'][0][$i];
  }

  for ($i=0; $i < count($_SESSION['kitaplar']); $i++) {
    for ($j=0; $j < count($_SESSION['kitaplar'][$i]); $j++) {
      $kitaplar[$i][$j]=$_SESSION['kitaplar'][$i][$j]['baslik'];
    }
  }

if((isset($_SESSION['musteri_id']) && isset($_SESSION['isim']))){
  $homepage = new InPageCategoryIcerik($kategoriler, $kitaplar);
  $homepage->m_Display();
}else{
  $homepage = new OutPageCategoryIcerik($kategoriler, $kitaplar);
  $homepage->m_Display();
}

?>
