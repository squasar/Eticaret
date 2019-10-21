<?php
  require("../page.inc");


  if(!(isset($_SESSION['musteri_id']) && isset($_SESSION['isim']))){
    $homepage = new LoggedInPage();
    session_start();
    $homepage->content = "<p> Musteri ID : ".$_SESSION['musteri_id']."</p>"
    ."<p> Isim : ".$_SESSION['isim']."</p>";
    $homepage -> Display();
  }else{
    $homepage = new Page();
    session_start();
    $homepage->content="<p>Beklenmeyen bir sorun olustu. Lutfen tekrar giris yapin.</p>";
    $homepage -> DisplayWithLogin();
  }

?>
