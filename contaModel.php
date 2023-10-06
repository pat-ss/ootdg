<?php

require_once "contaController.php";

if(isset($_POST['op']) && $_POST['op'] == 1){
    $register = new Conta();
    $result = $register -> register($_POST['nome'], $_POST['apelido'], $_POST['email'], $_POST['password']);
    echo($result);
} else if (isset($_POST['op']) && $_POST['op'] == 2){
    $sendConfirmationEmail = new Conta();
    $result = $sendConfirmationEmail -> sendConfirmationEmail($_POST['nome'], $_POST['apelido'], $_POST['email']);
    echo($result);
} else if (isset($_POST['op']) && $_POST['op'] == 3){
    $login = new Conta();
    $result = $login -> login($_POST['email'], $_POST['password'], $_POST['rememberMe']);
    echo($result);
}

?>