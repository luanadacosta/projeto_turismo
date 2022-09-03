<?php
//include inclui a conexao
include "conexao.php";

try{
    $email =$_POST['usuario'];
    $senha =$_POST['senha'];

$sql = "SELECT * FROM tb_login WHERE email = '$email' AND BINARY senha = '$senha' AND ativo = 1";

$comando = $con->prepare($sql);

$comando->execute();

$dados = $comando->fetchAll(PDO::FETCH_ASSOC);

//var_dump($dados);

//verifica se existem registros dentro da variavel dados
//if se email senha e ativo 1 da certo, si não ja vai em else
if($dados != null){
    //inicia a sessão
    session_start();
    //criar uma variavel de sessao e adiciona o email digitado
    $_SESSION['email'] = $email;

    var_dump($_SESSION['email']);

    //se o ususario e senha sao validos ira entrar nesse bloco
    header('Location:../admin/gerenciar_viagens.php');
}else{
    //se o usuario e senha nao sao validos, ira entrar nesse bloco de codigo
    echo "Usuario ou senha invalidos";
//header('Location:../admin/index.html');
}

}catch(PDOException $erro){
//se o ususario e senha sao validos, ira entrar nesse bloco de codigo
    echo $erro->getMessage();

}
