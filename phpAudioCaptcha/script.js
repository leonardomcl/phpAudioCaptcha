$(document).ready(function () {

    $("#playCaptcha").click(function () {
        var audio = document.getElementById("som");
        audio.play();
    });


    $.get("controle.php")
            .done(function (data) {
                var data = jQuery.parseJSON(data);
                var imagem = data.imagem;
                var audio = data.audio;
                var canvas = document.getElementById('canvas');
                var ctx = canvas.getContext('2d');
                var image = new Image();
                image.onload = function () {
                    ctx.drawImage(image, 0, 0);
                };
                image.src = "data:image/png;base64," + imagem;
                if (audio === undefined) {
                    $("#playCaptcha").hide();
                } else {
                    $("#playCaptcha").show();
                    $("#audio").html('<audio id="som" autobuffer="autobuffer" ><source src="' + audio + '" style="display:none;" /></audio>');
                }
            })
            .fail(function () {
                alert("Error ao carregar , f5");
            });


    $("#refreshCaptcha").click(function () {
        $("#refreshCaptcha").prop("disabled", true);
        $.get("controle.php")
                .done(function (data) {
                    var data = jQuery.parseJSON(data);
                    var imagem = data.imagem;
                    var audio = data.audio;
                    var canvas = document.getElementById('canvas');
                    var ctx = canvas.getContext('2d');
                    var image = new Image();
                    image.onload = function () {
                        ctx.drawImage(image, 0, 0);
                    };
                    image.src = "data:image/png;base64," + imagem;

                    if (audio === undefined) {
                        $("#playCaptcha").hide();
                    } else {
                        $("#playCaptcha").show();
                        $("#audio").html('<audio id="som" autobuffer="autobuffer" ><source src="' + audio + '" style="display:none;" /></audio>');
                    }

                })
                .fail(function () {
                    $("#resultado").html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Atenção!</strong> error ao obter captcha!. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                });
        $("#refreshCaptcha").prop("disabled", false);
    });


    $("#validarCaptcha").click(function () {
        $("#validarCaptcha").prop("disabled", true);
        var captcha = $("#captcha").val().trim();

        $.post("controle.php", {captcha: captcha}).done(function (data) {

            var data = data.trim();

            if (data === 'ok') {
                $("#resultado").html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sucesso!</strong> Captcha válidado. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                $("#formulario").prop("disabled", false);
                $("#enviar").prop("disabled", false);
            } else {
                var captcha = $("#captcha").val('');
                $("#canvas").focus();
                $("#resultado").html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Error!</strong> Captcha inválido, tente novamente!. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                var data = jQuery.parseJSON(data);
                var imagem = data.imagem;
                var audio = data.audio;
                var canvas = document.getElementById('canvas');
                var ctx = canvas.getContext('2d');
                var image = new Image();
                image.onload = function () {
                    ctx.drawImage(image, 0, 0);
                };
                image.src = "data:image/png;base64," + imagem;
                $("#audio").html('<audio id="som" autobuffer="autobuffer" ><source src="' + audio + '" style="display:none;" /></audio>');

            }

        }).fail(function () {
            $("#resultado").html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Atenção!</strong> error ao consultar captcha!. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        });

        $("#validarCaptcha").prop("disabled", false);

    });


});