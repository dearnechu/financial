<?php
$fp = fsockopen("s2a.axisbank.co.in", 443, $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    echo "Coming..";
    $out = "GET / HTTP/1.1\r\n";
    $out .= "Host: s2a.axisbank.co.in\r\n";
    $out .= "Connection: Close\r\n\r\n";
    fwrite($fp, $out);
    while (!feof($fp)) {
        echo fgets($fp, 128);
    }
    fclose($fp);
}
?>