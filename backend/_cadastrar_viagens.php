<?php

// Include da conexão com o banco de dados 
include'conexao.php';

try{
    // Exibe as váriaveis globais recebidas via POST
    echo"<pre>";
    //FILES ve si recebe a imagem
    // var_dump($_FILES);
    // echo"<pre>";
    // exit;
    // variaveis que recebem os dados enviados via POST
    $titulo = $_POST['titulo'];
    $local = $_POST['local'];
    $valor = $_POST['valor'];
    $desc = $_POST['desc'];

    //=====================
    //upload da imagem
    //caminho onde a imagem sera armazenada
    $pasta =   '../img/upload/';

    $imagem = 'foto.jpg';

    //funçaõ que faz o upload da imagem
    move_uploaded_file($_FILES['imagem']['tmp_name'],$pasta.$image);

    exit;

    // variavel que recebe a query SQL que será executada na BD
    $sql = "INSERT INTO 
    tb_viagens 
    (
    Titulo,
    `Local`,
    Valor,
    `Desc`
    ) 
    VALUES 
    (
    '$titulo','$local','$valor','$desc'
    )
    ";

 // Prepara a execucão da query SQL acima, 
$comando = $con->prepare($sql);

// executa o comando com o query no banco de dados 
$comando->execute();

// executa o comando com a query no banco de dados 


// exibe msg de sucesso ao inserir
//echo "cadastrado com sucesso!";

header('Location:../admin/gerenciar_viagens.php');

//fechar a conexao 
$con = null;


//exibe mensagem de erro que o pdo encontrou 
}catch(PDOException $erro){
    echo $erro->getMessage();
    //die deu erro para o arquivo, morre a pagina
    die();
}


?>

