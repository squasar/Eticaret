<?php
require("../page.inc");
session_start();
$homepage = new Page();
$homepage->content ="<table border=\"0\" class=\"center\" style=\"margin-top:40px;\">
  <tr>
    <td align=\"center\" class=\"form\">
      <form action=\"../controllers/sifre_yenile.php\" method=\"post\" align=\"center\" >
        <table border=\"0\">

          <tr>
            <td class=\"form\">Email :</td>
            <td class=\"form\"><input type=\"text\" name=\"emailforgotqty\" size=\"30\" maxlength=\"30\"></td>
          </tr>

          <tr>
            <td class=\"form\" colspan=\"4\"><input class=\"full\"  type=\"submit\" value=\"Geçici Şifre Yolla\"></td>
          </tr>
        </table>
      </form>
    </td>
  </tr>
  </table>";
$homepage -> Display();


?>
