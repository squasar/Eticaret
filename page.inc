<?php
  class Page{
    //class Page's attributes
    public $content;
    public $title = "Oxfırat Kitap Magazasi";
    public $keywords = "Oxfırat Kitapçılık, Kitap Mağazası,
                        Kitap Arama Motoru";
    public $buttons = array(
                    "Anasayfa" => "index.php",
                    "Kategoriler" => "index.php",
                    "Hakkımızda" => "index.php",
                    "Kayıt Ol" => "sayfa_kayit_ol.php",
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
        </style>
      <?php
    }


    public function DisplayHeaderWithLogin(){
     ?>
      <!-- page header -->
      <table width="100%" cellpadding="6" cellspacing="0" border="0">
          <tr bgcolor="black">
            <td align="left"><img src="logo.gif" alt="TLA logo" height="70" width="70"></td>
            <td align="center"  style="padding-left: 10em;"><h1>Oxfırat Kitap Mağazası</h1></td>
            <td align="right"></td>
          </tr>
          <tr  bgcolor="black">
            <td align="left"></td>
            <td align="center"></td>
            <td align="right">
              <div style="color: white; font-size: 12pt;">
                  Email: <input type="text" name="kitapyazarqty" size="15" maxlength="40">
              </div>
            </td>
          </tr>
          <tr  bgcolor="black" height="5">
            <td align="left"></td>
            <td align="center"></td>
            <td align="right">
              <div style="color: white; font-size: 12pt;">
                Şifre: <input type="password" name="kitapyazarqty" size="15" maxlength="15">
              </div>
            </td>
          </tr>
          <tr bgcolor="black">
            <td align="left"></td>
            <td style="color: white; font-size: 12pt; padding-left: 10em;"
              align="center";>Kitap/Yazar: <input type="text" name="kitapyazarqty" size="20" maxlength="20">
                <input type="submit" value="Ara" colspan="2"></td>
            <td align="right">
              <div style="color: white; font-size: 12pt;">
                <input type="submit" value="Giriş" colspan="12" width="24">
              </div>

            </td>
          </tr>

        </table>

        <?php
      }


    public function DisplayHeader(){
      ?>

        <!-- page header -->
        <table  class="neo" width="100%" cellpadding="6" cellspacing="0" border="0">
          <tr bgcolor="black">
            <td align="left"><img src="logo.gif" alt="TLA logo" height="70" width="70"></td>
            <td align="center" style="padding-right: 10em;"><h1>Oxfırat Kitap Mağazası</h1></td>
            <td align="right"></td>
          </tr>



          <tr bgcolor="black" >
            <td align="left"></td>
            <td style="color: white; font-size: 12pt; padding-right: 10em;"
              align="center";>Kitap/Yazar: <input type="text" name="kitapyazarqty" size="20" maxlength="20">
                <input type="submit" value="Ara" colspan="2"></td>
            <td align="right">
            </td>
          </tr>

        </table>
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
            <p class="foot"><a href="hakkimizda.php">Biz kim miyiz?</a></p>
          </td>
        </tr>
      </table>
      <?php
    }
  }
?>
