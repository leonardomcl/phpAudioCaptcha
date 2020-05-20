# phpAudioCaptcha

  Um projeto simples em php com o uso de jquery que gera códigos captcha e faz o controle através de sessão. Possui opção de tocar o captcha através de audio usando a API http://www.voicerss.org/ para isso é necessário uma key, podendo ser utilizada uma gratuita. A key deve ser configurada no arquivo gerarAudio.php.

[COMO FUNCIONA]

  Quando a imagem captcha é gerada, é gerado também um token aleátorio criptografado com a função crypt do php, esse token é salvo através de uma sessão e utilizado para comparação posteriormente.
  Uma vez que o captcha enviado bata com o captcha gerado é liberada a $_SESSION['auth_captcha'] = true com seu parâmetro TRUE devendo a mesma ser usada para controle de permissão.
  
<br /><br />

<img src="https://raw.githubusercontent.com/leonardomcl/phpAudioCaptcha/master/captcha.png" height="600" with="800" alt="preview"/>
