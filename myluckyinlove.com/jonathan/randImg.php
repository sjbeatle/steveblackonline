<?php
require_once("cryptor.php");
    if($_GET['r']) { $crypted = $_GET['r']; }
    else die('Unauthorized');

    randGenerate(decrypt($crypted));

    function randGenerate($rnum) {
        Header ("Content-type: image/gif");
        $im = @imagecreate(125, 30) or die("Cannot Initialize new GD image stream");
        $background_color = imagecolorallocate($im, 240, 240, 240);
        $text_color = imagecolorallocate($im, 0, 0, 0);
        $font = 'arial.ttf';
        imagettftext($im, 15, rand(-10,10), 5,   25, $text_color, $font, substr($rnum, 0, 1));
        imagettftext($im, 15, rand(-10,10), 25,  25, $text_color, $font, substr($rnum, 1, 1));
        imagettftext($im, 15, rand(-10,10), 45,  25, $text_color, $font, substr($rnum, 2, 1));
        imagettftext($im, 15, rand(-10,10), 65,  25, $text_color, $font, substr($rnum, 3, 1));
        imagettftext($im, 15, rand(-10,10), 85,  25, $text_color, $font, substr($rnum, 4, 1));
        imagettftext($im, 15, rand(-10,10), 105, 25, $text_color, $font, substr($rnum, 5, 1));
        imagegif($im);
        imagedestroy($im);
        return(1);
    }
?>