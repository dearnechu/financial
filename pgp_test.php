<?php
$gpg = new gnupg();
$info = $gpg -> import($keydata);
print_r($info);

echo "=====================================================";

$res = gnupg_init();
gnupg_addencryptkey($res,"8660281B6051D071D94B5B230549F9DC851566DC");
$enc = gnupg_encrypt($res, "just a test");
echo "Encryption is: ";
echo $enc;
?>