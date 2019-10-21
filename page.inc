<?php
  class Page{
    //class Page's attributes
    public $content;
    public $title = "Oxfırat Kitap Magazasi";
    public $keywords = "Oxfırat Kitapçılık, Kitap Mağazası,
                        Kitap Arama Motoru";
    public $buttons = array(
                    "Anasayfa" => "../views/index.php",
                    "Kategoriler" => "../controllers/kategori_kitap_islemleri.php",
                    "Hakkımızda" => "../views/hakkimizda.php",
                    "Kayıt Ol" => "../views/sayfa_kayit_ol.php",
                  );
    //class Page's operations
    public function __set($name, $value){
      $this->$name = $value;
    }

    public function DisplayWithLogin(){
      //<meta charset="utf-8">
      echo "<meta charset=\"utf-8\"";
      echo "<html>\n<head>\n";
      $this -> DisplayTitle();
      $this -> DisplayKeywords();
      $this -> DisplayStyles();
      echo "</head>\n<body>\n";
      $this -> DisplayHeaderWithLogin();
      $this -> DisplayMenu($this->buttons);
      echo $this->content;
      $this->DisplayFooter();
      echo "</body>\n</html>\n";
    }

    public function Display(){
      echo "<meta charset=\"utf-8\"";
      echo "<html>\n<head>\n";
      $this -> DisplayTitle();
      $this -> DisplayKeywords();
      $this -> DisplayStyles();
      echo "</head>\n<body>\n";
      $this -> DisplayHeader();
      $this -> DisplayMenu($this->buttons);
      echo $this->content;
      $this->DisplayFooter();
      echo "</body>\n</html>\n";
    }

    public function DisplayTitle(){
      echo "<title>".$this->title."</title>";
    }

    public function DisplayKeywords(){
      echo "<meta name=\"keywords\"
              content=\"".$this->keywords."\"/>";
    }

    public function DisplayStyles(){
      ?>
      <style>
        h1{
          color:white;
          font-size:24pt;
          text-align:center;
          font-family:arial,sans-serif
          }
        .menu{
          color:white;
          font-size:12pt;
          text-align:center;
          font-family:arial,sans-serif;
          font-weight:bold
        }
        td{background:black}
        td.form{background:black; color:white;}
        table.center{margin-left: auto; margin-right: auto; background: white;}
        input.full{border: 1px solid white; height: 100%; width: 100%; border-collapse: collapse; margin-top: 15px;}

        p{
          color:black;
          font-size:12pt;
          text-align:justify;
          font-family:arial,sans-serif
        }
        p.foot{
          color:white;
          font-size:9pt;
          text-align:center;
          font-family:arial,sans-serif;
          font-weight:bold
        }
        a:link,a:visited,a:active{
          color:white
        }
        table.foot{
          position: absolute;
          bottom: 0px;
        }
        table.m_navbar{
          margin-top: 24px;
        }
        table.m_content{
          margin-top: 24px;
        }

        .inline{
          display: inline;

        }
        .link-button {
          background: none;
          border: none;
          color: white;
          text-decoration: underline;
          cursor: pointer;
          font-size: 1em;
          font-family: serif;
        }
        .link-button:focus {
          outline: none;
        }
        .link-button:active {
          color:red;
        }
        </style>
      <?php
    }

    public function DisplayHeaderWithLogin(){
     ?>
      <!-- page header -->
      <form action="../controllers/auth.php" method="post" style="margin-bottom:0;">
        <table width="100%" cellpadding="6" cellspacing="0" border="0">
          <tr bgcolor="black">
            <td align="left"><img src="logo.gif" alt="Oxfirat logo" height="70" width="70"></td>
            <td align="center"  style="padding-left: 10em;"><h1>Oxfırat Kitap Mağazası</h1></td>
            <td align="right"></td>
          </tr>
          <tr  bgcolor="black">
            <td align="left"></td>
            <td align="center"></td>
            <td align="right">
              <div style="color: white; font-size: 12pt;">
                  Email: <input type="text" name="emailqty" size="15" maxlength="40">
              </div>
            </td>
          </tr>
          <tr  bgcolor="black" height="5">
            <td align="left"></td>
            <td align="center"></td>
            <td align="right">
              <div style="color: white; font-size: 12pt;">
                Şifre: <input type="password" name="sifreqty" size="15" maxlength="15">
              </div>
            </td>
          </tr>
          <tr bgcolor="black">
            <td align="left"></td>
            <td align="center"></td>
            <td align="right">
              <div style="color: white; font-size: 12pt;">
                <a href="../views/sifremi_unuttum.php" style="color: blue; font-size: 10pt; padding-right: 1em">Şifremi unuttum?</a>
                <input type="submit" value="Giriş" colspan="12" width="24">
              </div>
            </td>
          </tr>
        </table>
      </form>
      <form action="../controllers/arama.php" method="post" style="margin-bottom:1px;">
        <table width="100%" cellpadding="4" cellspacing="0" border="0">
          <tr bgcolor="black">
            <td align="left"></td>
            <td style="color: white; font-size: 12pt;" align="center";>Kitap/Yazar:
              <input type="text" name="kitapyazarqty" size="20" maxlength="20">
                <input type="submit" value="Ara" colspan="2">
            </td>
            <td align="right"></td>
          </tr>
        </table>
      </form>
        <?php
      }

    public function DisplayHeader(){
      ?>
        <!-- page header -->
        <form action="../controllers/arama.php" method="post" style="margin-bottom:1px;">
          <table  class="neo" width="100%" cellpadding="6" cellspacing="0" border="0">
            <tr bgcolor="black">
              <td align="left"><img src="logo.gif" alt="Oxfirat logo" height="70" width="70"></td>
              <td align="center" style="padding-right: 10em;"><h1>Oxfırat Kitap Mağazası</h1></td>
              <td align="right"></td>
            </tr>
            <tr bgcolor="black" >
              <td align="left"></td>
              <td style="color: white; font-size: 12pt; padding-right: 10em;"
                align="center";>Kitap/Yazar: <input type="text" name="kitapyazarqty" size="20" maxlength="20">
                  <input type="submit" value="Ara" colspan="2"></td>
              <td align="right"></td>
            </tr>
          </table>
        </form>
      <?php
    }

    public function DisplayMenu($buttons){
      echo "<table width=\"100%\" bgcolor=\"white\"
            cellpadding=\"4\" cellspacing=\"4\">\n";
      echo "<tr>\n";

      //calculate button size
      $width = 100/count($buttons);

      while(list($name, $url) = each($buttons)){
          $this -> DisplayButton($width, $name, $url);
      }
      echo "</tr>\n";
      echo "</table>\n";
    }

    public function DisplayButton($width, $name, $url){
        echo "<td width = \"".$width."%\" height=\"35\" align=\"center\">
          <a href=\"".$url."\">
          <a href=\"".$url."\"><span class=\"menu\">".$name."</span></a>
          </td>";
    }

    public function DisplayFooter(){
      ?>
      <!-- page footer -->
      <table class="foot" width="100%" bgcolor="black" cellpadding="12" border="0">
        <tr>
          <td>
            <p class="foot">&copy; Oxfırat Ltd. Şti.</p>
            <p class="foot"><a href="../views/hakkimizda.php">Biz kim miyiz?</a></p>
          </td>
        </tr>
      </table>
      <?php
    }
  }

  class LoggedInPage extends Page{
    protected $new_buttons = array(
              "Anasayfa" => "../views/in_anasayfa.php",
              "Kategoriler" => "../controllers/kategori_kitap_islemleri.php",
              "Profil" => "../views/in_profil.php",
              //"Siparişlerim" => "../views/in_siparislerim.php",
              "Siparişlerim" => "../controllers/eski_siparis_islemleri.php",
              //"Sepetim" => "../views/in_sepetim.php",
              "Sepetim" => "../controllers/sepet_islemleri.php",
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


  class OutPageCategoryIcerik extends Page{

    private $kategoriler=array();
    private $kitaplar=array(array());

    public function __construct($kategoriler, $kitaplar){
      $this->kategoriler=$kategoriler;
      $this->kitaplar=$kitaplar;
    }

    public function m_Display(){
      echo "<meta charset=\"utf-8\"";
      echo "<html>\n<head>\n";
      $this -> DisplayTitle();
      $this -> DisplayKeywords();
      $this -> DisplayStyles();
      echo "</head>\n<body>\n";
      $this -> DisplayHeaderWithLogin();
      $this -> DisplayMenu($this->buttons);
      //echo $this->content;
      $this->content = $this->set_content();
      $this->DisplayFooter();
      echo "</body>\n</html>\n";
    }

    private function set_content(){
      $this->display_navbar_in_kategoriler();
      $this->display_content_in_kategoriler();
    }

    private function display_navbar_in_kategoriler(){
      echo "
      <table width=\"20%\" align=\"left\" class=\"m_navbar\">";
      for ($i=0; $i < count($this->kategoriler); $i++){
        echo "
        <tr align=\"center\">
          <td align=\"center\">
            <form method=\"post\" action=\"../views/in_kategoriler.php\" class=\"inline\">
              <input type=\"hidden\" name=\"extra_par_".$this->kategoriler[$i]."\" value=\"extra_val_".$this->kategoriler[$i]."\">
              <button type=\"submit\" name=\"par_".$this->kategoriler[$i]."\" value=\"val_".$this->kategoriler[$i]."\"
                    class=\"link-button\">".
                $this->kategoriler[$i]."
              </button>
            </form>
          </td>
        </tr>";
      }
      echo "</table>";

  }
    private function display_content_in_kategoriler(){
      $secilen_kategori_indx;
      $_is_secildi=false;
      for ($i=0; $i < count($this->kategoriler); $i++) {
        if(isset($_POST['extra_par_'.$this->kategoriler[$i]])){
          $secilen_kategori_indx = $i;
          $_is_secildi=true;
        }else{
          unset($_POST['extra_par_'.$this->kategoriler[$i]]);
        }
      }
      if($_is_secildi){
        echo  "<table width=\"%80\" style=\"color:white\" align=\"center\" class=\"m_content\">";
        for ($i=0; $i < count($this->kitaplar[$secilen_kategori_indx]); $i++) {
            echo "<tr align=\"center\">
                    <td align=\"center\">
                      <form method=\"post\" action=\"../controllers/kitap_detay.php\" class=\"inline\">
                        <input type=\"hidden\" name=\"extra_par_"./*$this->kitaplar[$secilen_kategori_indx][$i]*/
                                    $_SESSION['kitaplar'][$secilen_kategori_indx][$i]['isbn']."\"
                              value=\"extra_val_".$this->kitaplar[$secilen_kategori_indx][$i]."\">
                            <button type=\"submit\" name=\"par_".$this->kitaplar[$secilen_kategori_indx][$i]."\"
                              value=\"val_".$this->kitaplar[$secilen_kategori_indx][$i]."\" class=\"link-button\">".
                                    $this->kitaplar[$secilen_kategori_indx][$i].
                            "</button>
                      </form>
                    </td>
                  </tr>";
            }
        echo "</table>";
      }else{
        echo  "<table width=\"%80\" style=\"color:white\" align=\"center\" class=\"m_content\">".
          "<tr align=\"center\">
              <td align=\"center\">"."Lutfen bir kategori secin..."."</td>
            </tr>
          </table>";
      }
    }
  }

class InPageCategoryIcerik extends LoggedInPage{

  private $kategoriler=array();
  private $kitaplar=array(array());

  public function __construct($kategoriler, $kitaplar){
    $this->kategoriler=$kategoriler;
    $this->kitaplar=$kitaplar;
  }

  public function m_Display(){
    echo "<meta charset=\"utf-8\"";
    echo "<html>\n<head>\n";
    $this -> DisplayTitle();
    $this -> DisplayKeywords();
    $this -> DisplayStyles();
    echo "</head>\n<body>\n";
    $this -> DisplayHeader();
    $this -> DisplayMenu($this->new_buttons);
    $this->content = $this->set_content();
    $this->DisplayFooter();
    echo "</body>\n</html>\n";
  }

  private function set_content(){
    $this->display_navbar_in_kategoriler();
    $this->display_content_in_kategoriler();
  }

  private function display_navbar_in_kategoriler(){
    echo "
    <table width=\"20%\" align=\"left\" class=\"m_navbar\">";
    for ($i=0; $i < count($this->kategoriler); $i++){
      echo "
      <tr align=\"center\">
        <td align=\"center\">
          <form method=\"post\" action=\"../views/in_kategoriler.php\" class=\"inline\">
            <input type=\"hidden\" name=\"extra_par_".$this->kategoriler[$i]."\" value=\"extra_val_".$this->kategoriler[$i]."\">
            <button type=\"submit\" name=\"par_".$this->kategoriler[$i]."\" value=\"val_".$this->kategoriler[$i]."\"
                class=\"link-button\">".
              $this->kategoriler[$i]."
            </button>
          </form>
        </td>
      </tr>";
    }
    echo "</table>";

}
  private function display_content_in_kategoriler(){
    $secilen_kategori_indx;
    $_is_secildi=false;
    for ($i=0; $i < count($this->kategoriler); $i++) {
      if(isset($_POST['extra_par_'.$this->kategoriler[$i]])){
        $secilen_kategori_indx = $i;
        $_is_secildi=true;
      }else{
        unset($_POST['extra_par_'.$this->kategoriler[$i]]);
      }
    }
    if($_is_secildi){
      echo  "<table width=\"%80\" style=\"color:white\" align=\"center\" class=\"m_content\">";
      for ($i=0; $i < count($this->kitaplar[$secilen_kategori_indx]); $i++) {
          echo "<tr align=\"center\">
                  <td align=\"center\">
                    <form method=\"post\" action=\"../controllers/kitap_detay.php\" class=\"inline\">
                      <input type=\"hidden\" name=\"extra_par_".$_SESSION['kitaplar'][$secilen_kategori_indx][$i]['isbn']."\"
                            value=\"extra_val_".$this->kitaplar[$secilen_kategori_indx][$i]."\">
                          <button type=\"submit\" name=\"par_".$this->kitaplar[$secilen_kategori_indx][$i]."\"
                            value=\"val_".$this->kitaplar[$secilen_kategori_indx][$i]."\" class=\"link-button\">".
                                  $this->kitaplar[$secilen_kategori_indx][$i].
                          "</button>
                    </form>
                  </td>
                </tr>";
          }
      echo "</table>";
    }else{
      echo  "<table width=\"%80\" style=\"color:white\" align=\"center\" class=\"m_content\">".
        "<tr align=\"center\">
            <td align=\"center\">"."Lutfen bir kategori secin..."."</td>
          </tr>
        </table>";
    }
  }
}

?>
