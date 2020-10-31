<?php
$GnuPG = new gnupg();

$PublicData = file_get_contents('key/prod.pkr');
$PrivateData = file_get_contents('key/prod.pkr');

$PublicKey = $GnuPG->import($PublicData);
$PrivateKey = $GnuPG->import($PrivateData);

echo 'Public Key : ',$PublicKey['fingerprint'],' & Private Key : ',$PrivateKey['fingerprint'];
?>