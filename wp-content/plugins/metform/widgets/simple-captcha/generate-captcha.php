<?php
// As this file generates publicly available image , we can not check abs path constant here
// The alternatives are not space efficient
// ARa - 20200401

// session start for tracking
session_start();

// current server time take
$time = $_SERVER['REQUEST_TIME'];

// captcha validity timeout 60s*30m = 1800 sec
$timeout_duration = 1800;

// check previous session and do necessary action
if (isset($_SESSION['LAST_ACTIVITY']) && 
   ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    session_start();
}

// set current activity as last activity
$_SESSION['LAST_ACTIVITY'] = $time;
 
// permitted charecters for generating captcha
$permitted_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  
// generate random string from permitted chars
function generate_string($input, $strength = 10) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
  
    return $random_string;
}

// background image create start
$image = imagecreatetruecolor(200, 50);
 
imageantialias($image, true);
 
$colors = [];
 
$red = rand(125, 175);
$green = rand(125, 175);
$blue = rand(125, 175);
 
for($i = 0; $i < 5; $i++) {
  $colors[] = imagecolorallocate($image, $red - 20*$i, $green - 20*$i, $blue - 20*$i);
}
 
imagefill($image, 0, 0, $colors[0]);
 
for($i = 0; $i < 10; $i++) {
  imagesetthickness($image, rand(2, 10));
  $rect_color = $colors[rand(1, 4)];
  imagerectangle($image, rand(-10, 190), rand(-10, 10), rand(-10, 190), rand(40, 60), $rect_color);
}
 
$black = imagecolorallocate($image, 0, 0, 0);
$white = imagecolorallocate($image, 255, 255, 255);
$textcolors = [$black, $white];

// background image create end 

// include font for using in captcha
$fonts = [
  //dirname( __FILE__ ).'/fonts/PermanentMarker.ttf',
  dirname( __FILE__ ).'/fonts/SourceCodePro.ttf',
];
 
// limit captcha length
$string_length = 6;
// captcha generate
$captcha_string = generate_string($permitted_chars, $string_length);
// store captcha on session
$_SESSION['mf_captcha_text'] = $captcha_string;
 
// create image with generated captcha start
for($i = 0; $i < $string_length; $i++) {
  $letter_space = 170/$string_length;
  $initial = 15;
   
  imagettftext($image, 20, rand(-15, 15), $initial + $i*$letter_space, rand(20, 40), $textcolors[rand(0, 1)], $fonts[array_rand($fonts)], $captcha_string[$i]);
}
 
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
