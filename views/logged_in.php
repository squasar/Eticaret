<?php
  require("../page.inc");

  class LoggedInPage extends Page{
    private $new_buttons = array(
              "Anasayfa" => "in_anasayfa.php",
              "Kategoriler" => "in_kategoriler.php",
              "Profil" => "in_profil.php",
              "Siparişlerim" => "in_siparislerim.php",
              "Sepetim" => "in_sepetim.php",
              "Çıkış" => "../controllers/logout.php"
              );
    public function Display(){
      echo "<meta charset=\"utf-8\"";
      echo "<html>\n<head>\n";
      $this -> DisplayTitle();
      $this -> DisplayKeywords();
      $this -> DisplayStyles();
      echo "</head>\n<body>\n";
      $this -> DisplayHeader();
      $this -> DisplayMenu($this->new_buttons);
      echo $this->content;
      $this->DisplayFooter();
      echo "</body>\n</html>\n";
    }

  }

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
