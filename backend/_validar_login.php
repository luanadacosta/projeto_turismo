<?php
//include inclui a conexao
include "conexao.php";

try{

    $usuario =$_POST['usuario'];
    $senha =$_POST['senha'];

$sql = "SELECT * FROM tb_login WHERE email = '$usuario' AND BINARY senha = '$senha' AND ativo = 1";

$comando = $con->prepare($sql);

$comando->execute();

$dados = $comando->fetchAll(PDO::FETCH_ASSOC);

//var_dump($dados);

//verifica se existem registros dentro da variavel dados
//if se email senha e ativo 1 da certo, si não ja vai em else
if($dados != null){
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
