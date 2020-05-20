<?php
function randomString($bytes) {
    return bin2hex(random_bytes($bytes));
}

function gerarToken($char) {
    $token = '';
    do {
        $bytes = random_bytes($char);
        $token .= str_replace(
                ['.', '/', '='],
                '',
                base64_encode($bytes)
        );
    } while (strlen($token) < $char);
    return sha1($token);
}

function gerarImg() {
    $captchakey = randomString(3);
    $im = imagecreate(170, 50);
    imagecolorallocate($im, 210, 180, 15);
    $textcolor = imagecolorallocate($im, 0, 0, 0);
    $font = imageloadfont("font.gdf");
    imagestring($im, $font, 34, 13, $captchakey, $textcolor);
    imagefilter($im, IMG_FILTER_SCATTER, 0, 2);
    $gaussian = array(array(1.0, 2.0, 1.0), array(2.0, 4.0, 2.0), array(1.0, 2.0, 1.0));
    imageconvolution($im, $gaussian, 14, 0);
    $token = crypt(sha1(urlencode($captchakey)), gerarToken(10));
    $_SESSION['captchaKey'] = $token;
    ob_start();
    imagepng($im);
    $image_data = ob_get_contents();
    ob_end_clean();
    $data = array("imagem" => base64_encode($image_data), "token" => $token, "captchakey" => $captchakey);
    return json_encode($data, true);
}

?>