<?php
require("../page.inc");
include '../controllers/autoload.php';

$homepage = new LoggedInPage();
session_start();

$obj=$_SESSION['sepet_obj'][0];

$standart_string =  "<p> Musteri ID : ".$_SESSION['musteri_id']."</p>"
."<p> Isim : ".$_SESSION['isim']."</p>"."<p>"."</p>";

$tablo_baslik = "
         <form action=\"../controllers/sepet_islemleri.php\" method=\"post\">
         <table border=\"0\" width=\"100%\" cellspacing=\"0\">
         <tr><th colspan=\"1\" bgcolor=\"#cccccc\">ISBN</th>
         <th bgcolor=\"#cccccc\">Ürün Adı</th>
         <th bgcolor=\"#cccccc\">Adet</th>
         <th bgcolor=\"#cccccc\">Toplam</th>
         </tr>";

//each item as a table row
$items="";
$tablo_bas="<tr>";
$tablo_son="</tr>";
$sayac=-1;
$total=0;
$isbn_array=array();
foreach($obj as $siparis){
  if(empty($siparis)){
    $siparis=next($obj);
    continue;
  }
  $isbn = $siparis->get_isbn();
  $sayac=$sayac+1;
  $tmp_total=0;
  $is_var=false;
  for ($i=0; $i < count($isbn_array); $i++) {
    if($isbn_array[$i]==$isbn){
      $is_var=true;
      break;
    }
  }
  if(!$is_var){
    $isbn_array[$sayac]=$isbn;
    $siparis_fiyati = $siparis->get_siparis_tutari();
    $siparis_adedi = $siparis->get_siparis_adedi();
    $_obj=$siparis->get_kitap();
    $_id=$siparis->get_siparis_id();
    $kitap_adi=$_obj[0];
    $kitap_yazari=$_obj[1];
    $tmp_total=$tmp_total + $siparis_fiyati;
    $total=$tmp_total + $total;
    $tablo_govde = $tablo_bas.
            "<th bgcolor=\"#ffffff\">".$isbn."</th>".
            "<th bgcolor=\"#ffffff\">".$kitap_adi." by ".$kitap_yazari."</th>".
            "<th bgcolor=\"#ffffff\"><input type=\"text\" name=\"adetqty~$isbn~$_id\" value=\"$siparis_adedi\" size=\"3\"></th>".
            "<th bgcolor=\"#ffffff\">\$".number_format($siparis_fiyati, 2)."</th>".
            $tablo_son;
    $items=$tablo_govde.$items;
  }
}
// display total row
$total_row=$tablo_bas.
          "<th colspan=\"2\" bgcolor=\"#cccccc\">&nbsp;</td>".
          "<th align=\"center\" bgcolor=\"#cccccc\"></th>".
          "<th align=\"center\" bgcolor=\"#cccccc\">\$".$total."</th>".
          $tablo_son;

//buttons
$buttons = $tablo_bas.
          "<th bgcolor=\"#ffffff\" colspan=\"0\">&nbsp;</th>".
          "<th bgcolor=\"#ffffff\" align=\"center\"><input type=\"submit\" name=\"saveqty~save\" value=\"KAYDET\"/>".
          "<input type=\"submit\" name=\"payqty~pay\" value=\"DEVAM\"/></th>".
          "<th bgcolor=\"#ffffff\">&nbsp;</th>".
          $tablo_son;

$tablo_ayak="</table></form>";

$bosluk="<p></p>";

$homepage->content = $bosluk . /*$standart_string .*/ $tablo_baslik . $items . $total_row . $buttons . $tablo_ayak;
$homepage -> Display();

?>
