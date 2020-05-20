<?php

define('KEY_AUDIO', '');

//plano free = 350 requests dia
//obter key em http://www.voicerss.org

function gerarAudio($nome, $audio) {
    if (empty(KEY_AUDIO)) {
        return false;
    }
    require_once('voicerss_tts.php');
    $tts = new VoiceRSS;
    $voice = $tts->speech([
        'key' => KEY_AUDIO,
        'hl' => 'pt-br',
        'src' => $audio,
        'r' => '0',
        'c' => 'mp3',
        'f' => '44khz_16bit_stereo',
        'ssml' => 'false',
        'b64' => 'false'
    ]);
    file_put_contents('audio/' . $nome . '.mp3', $voice);
    return 'audio/' . $nome . '.mp3';
}

?>