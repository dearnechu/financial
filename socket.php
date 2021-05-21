<?php
$fp = fsockopen("s2a.axisbank.co.in", 443, $errno, $errstr, 30);
print_r($fp);
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

    $output = '';
    while (!feof($fp)) {
        $output .= fgets($fp, 128);
    }

    fclose($fp);
    file_put_contents('logs/output.txt', $output);
}
?>