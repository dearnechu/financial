<?PHP
  // Adapted for The Art of Web: www.the-art-of-web.com
  // Please acknowledge use of this code by including this header.

  // initialise image with dimensions of 120 x 30 pixels
  $image = @imagecreatetruecolor(120, 30) or die("Cannot Initialize new GD image stream");

  // set background to white and allocate drawing colours
  $background = imagecolorallocate($image, 0xEE, 0xEE, 0xEE);
  imagefill($image, 0, 0, $background);
  $linecolor = imagecolorallocate($image, 0xCC, 0xCC, 0xCC);
  $textcolor = imagecolorallocate($image, 0x3C, 0x8D, 0xBC);

  // draw random lines on canvas
  for($i=0; $i < 6; $i++) {
    imagesetthickness($image, rand(1,3));
    // imageline($image, 0, rand(0,30), 120, rand(0,30), $linecolor);
  }

  ini_set("session.cookie_httponly", 1);
  ini_set('session.cookie_secure', 1);
  session_start();

  // add random digits to canvas
  $digit = '';
  for($x = 15; $x <= 95; $x += 20) {
    $num = rand(0, 9);
    if ($num == 1) $num = chr(rand(65, 90));
    if ($num == 7) $num = chr(rand(65, 90));
    if ($num == 0) $num = chr(rand(65, 90));
    $digit .= $num;
    imagechar($image, rand(3, 5), $x, rand(2, 14), $num, $textcolor);
  }

  // record digits in session variable
  $_SESSION['digit'] = $digit;

  // display image and clean up
  header('Content-type: image/png');
  imagepng($image);
  imagedestroy($image);
?>