<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_SESSION['auth_captcha']) && $_SESSION['auth_captcha'] === true) {
        echo "postagem autorizada<br />";
        var_dump($_SESSION);
        echo "<br />";
        var_dump($_POST);
        
        
    } else {
        die('acesso negado, Pilantra!');
    }
}
?>