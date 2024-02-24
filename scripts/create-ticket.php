<?php
// Set the content-type
try {
  $text1 = 'Hello, this is your ticket for ' . $event['naam'] . '.';
  $key = getRandKey(10);
  $text2 = 'Your ticket key is: ' . $key . '. Thank you for visiting Casus Cafe!';

  // Create the image
  $im = imagecreatetruecolor(400, 100); // Increased height to accommodate two lines of text

  // Create some colors
  $white = imagecolorallocate($im, 255, 255, 255);
  $black = imagecolorallocate($im, 0, 0, 0);
  imagefilledrectangle($im, 0, 0, 399, 99, $white);

  // The font to use
  $font = './fonts/Arial.ttf'; // Replace with the path to your font file

  // Add the first line of text
  imagettftext($im, 20, 0, 10, 30, $black, $font, $text1);

  // Add the second line of text, adjusting the y-coordinate to simulate a newline
  imagettftext($im, 20, 0, 10, 60, $black, $font, $text2);

  // Start output buffering
  ob_start();
  imagepng($im);
  $imageData = ob_get_contents();
  ob_end_clean();

  // Cleanup
  imagedestroy($im);

  // Encode the image data
  $base64EncodedString = base64_encode($imageData);
} catch (Exception $e) {
}


function getRandKey($length)
{
  $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  $randStr = str_shuffle($str);
  return substr($randStr, 0, $length);
}
