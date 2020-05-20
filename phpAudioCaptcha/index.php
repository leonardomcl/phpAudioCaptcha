<?php
session_start();
unset($_SESSION['captchaKey']);
unset($_SESSION['auth_captcha']);
?>
<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">        <title>Captcha 1.0 Exemplo</title>

        <style>
            body{
                background-color:ghostwhite;
            }
        </style>
    </head>
    <body>
        <div class="container" style="margin-top:4em;">
            <center><h3>Exemplo simples de controle e gerador captcha php/jquery</h3></center>
            <hr />
            <br />
            <form method="POST" action="formulario/formulario.php" style="padding: 10px;">
                <textarea class="form-control" rows="10" id="formulario"  name="formulario" placeholder="texto que será postado no <formulario.php> após confirmar captcha e validar via sessão" required disabled></textarea>
                <br />

                <div class="input-group mb-3">
                    <button class="btn btn-outline-dark" type="button" id="refreshCaptcha" style="width: 50px;"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                    <div class="input-group-prepend">
                        <canvas class="rounded" id="canvas" width="160" height="45" style="margin-left:0.4em;"></canvas>
                    </div>
                    <button type="button" class="btn btn-outline-danger" id="playCaptcha" style="margin-left:0.4em;width: 50px;"><i class="fa fa-play" aria-hidden="true"></i></button>
                    <div id="audio">
                    </div>
                </div>
                <br />
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <input type="text" maxlength="6" class="form-control" id="captcha" placeholder="Código captcha" style="max-width: 176px;">
                    </div>
                    <button class="btn btn-primary" id="validarCaptcha" style="width: 100px;" type="button"><i class="fa fa-check-circle" aria-hidden="true"></i> Validar</button>
                </div>
                <div id="resultado"></div>
                <br />
                <center><button class="btn btn-lg btn-secondary" id="enviar" type="submit" disabled><i class="fa fa-paper-plane" aria-hidden="true"></i> Enviar formulário</button></center>
            </form>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <!-- controle javascript -->
        <script src="script.js" type="text/javascript"></script>

    </body>
</html>