<?php
  echo "**";
  $res = gnupg_init();
  echo "000";
  gnupg_addencryptkey($res,"8660281B6051D071D94B5B230549F9DC851566DC");
  $enc = gnupg_encrypt($res, "just a test");
  echo "--";
  print_r($enc);
?>