<?php

//inicia a sessao
session_start();

if(isset($_SESSION['usuario'])){
    header('Location: gerenciar_viagens.php');
}

?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin/css/style.css">
    <title>Cadastro</title>
</head>

<body>
    <div id="container">
        <form action="../backend/_validar_login.php" id="login" method="post">
            <label for="usuario">Usuario</label><br>
            <input class="input-login" type="email" name="usuario" id="usuario" placeholder="usuario" required>
            <br>

            <label for="senha">Senha</label><br>
            <input class="input-login" type="password" name="senha" id="senha" placeholder="senha">
            <br>

            <input class="btn-login" type="submit" value="Login">
        </form>
    </div>
</body>

</html>