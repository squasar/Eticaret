<?php
  require("../page.inc");
  $homepage = new Page();
  $homepage->content = "<p>IRC (Internet Relay Chat), yüksek lisans öğrencilerinin,
  kendi projelerini rahatlıkla kendi odalarından tartışabilmelerini sağlmak amacıyla,
  avrupadaki bir üniversitede geliştirilmiştir.</p>
  <p>Ray Charles inanılmaz derecede yetenkli bir müzisyendir.</p>";

  $homepage -> Display();
?>
