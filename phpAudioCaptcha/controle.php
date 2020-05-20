<?php

session_start();
//0 desabilita bloqueio por erros - padrão 30 erros 
define("bloqueio_falhas", 0);

function botChecker($requisicoes) {
    if (bloqueio_falhas === 0)
        return false;
    $tentativas = bloqueio_falhas;
    $requisicoes >= $tentativas ? die('atividade considerada suspeita') : '';
}

function gerarCaptcha() {
    /* expira em 1 hora */
    require_once './gerarImagem.php';
    require_once './gerarAudio.php';
    $data = gerarImg();
    $data = json_decode($data, true);
    $imagem = $data['imagem'];
    $token = $data['token'];
    $captchakey = $data['captchakey'];
    $audio = gerarAudio($token, $captchakey);
    if ($audio !== false) {
        $saida = array("audio" => $audio, "imagem" => $imagem);
    } else {
        $saida = array("imagem" => $imagem);
    }
    $saida = json_encode($saida, true);
    return print $saida;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    !empty($_SESSION['tentativas']) ? $requisicoes = $_SESSION['tentativas'] : $requisicoes = 0;
    botChecker($requisicoes);
    gerarCaptcha();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    !empty($_SESSION['tentativas']) ? $requisicoes = $_SESSION['tentativas'] : $requisicoes = 0;
    botChecker($requisicoes);
    empty($_POST['captcha']) ? die('Captcha inválido') : $captcha = $_POST['captcha'];
    empty($_SESSION['captchaKey']) ? die('Sessão inválida') : $key = $_SESSION['captchaKey'];

    if (crypt(sha1(urlencode($captcha)), $key) == $key) {
//dados conferem com imagem do captcha [ok]
        unset($_SESSION['captchaKey']);
        $_SESSION['auth_captcha'] = true;
        print "ok";
    } else {
//dados NÃO conferem com imagem do captcha [fail]
        $_SESSION['tentativas']++;
        unset($_SESSION['captchaKey']);
        unset($_SESSION['auth_captcha']);
        gerarCaptcha();
    }
}
?>  