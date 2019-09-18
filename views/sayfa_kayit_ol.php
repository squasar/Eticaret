<?php
  require("../page.inc");
  $homepage = new Page();
  $homepage->content = "<table border=\"0\" class=\"center\" style=\"margin-top:40px;\">
    <tr>
      <td align=\"center\" class=\"form\">
        <form action=\"../controllers/register.php\" method=\"post\" align=\"center\" >
          <table border=\"0\">
            <tr>
              <td class=\"form\">İsim :</td>
              <td class=\"form\"><input type=\"text\" name=\"isimqty\" size=\"30\" maxlength=\"20\"></td>
            </tr>

            <tr>
              <td class=\"form\">Email :</td>
              <td class=\"form\"><input type=\"text\" name=\"emailqty\" size=\"30\" maxlength=\"30\"></td>
            </tr>

            <tr>
              <td class=\"form\">Şifre :</td>
              <td class=\"form\"><input type=\"password\" name=\"sifreqty\" size=\"30\" maxlength=\"20\"></td>
            </tr>

            <tr>
              <td class=\"form\">Şifre (Tekrar) :</td>
              <td class=\"form\"><input type=\"password\" name=\"sifretekrarqty\" size=\"30\" maxlength=\"20\"></td>
            </tr>

            <tr>
              <td class=\"form\">Telefon :</td>
              <td class=\"form\"><input type=\"text\" name=\"telefonqty\" size=\"30\" maxlength=\"15\"></td>
            </tr>

            <tr>
              <td class=\"form\">Adres :</td>
              <td class=\"form\"><input type=\"text\" name=\"adresqty\" size=\"30\" maxlength=\"80\"></td>
            </tr>

            <tr>
              <td class=\"form\">Şehir :</td>
              <td class=\"form\"><input type=\"text\" name=\"sehirqty\" size=\"30\" maxlength=\"20\"></td>
            </tr>

            <tr>
              <td class=\"form\">Posta Kodu :</td>
              <td class=\"form\"><input type=\"text\" name=\"postakoduqty\" size=\"30\" maxlength=\"10\"></td>
            </tr>

            <tr>
              <td class=\"form\">Ülke :</td>
              <td class=\"form\"><input type=\"text\" name=\"ulkeqty\" size=\"30\" maxlength=\"20\"></td>
            </tr>

            <tr>
              <td class=\"form\" colspan=\"4\"><input class=\"full\"  type=\"submit\" value=\"Kayıt Ol\"></td>
            </tr>
            </table>
        </form>
      </td>
    </tr>
    </table>";
  $homepage -> Display();
?>
