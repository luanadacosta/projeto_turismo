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
    //armazena o nome original da imagem
    $nome_original_imagem = $_FILES['imagem']['name'];


    //descobrir a extensao da imagem, formatos validos = jpg/jpeg/png/
  

    $extensao =  pathinfo($nome_original_imagem,PATHINFO_EXTENSION);

    //verificaçao de formato da imagem, se for diferente dos formatos validos, ira retornar erro ao ususario
    if($extensao == 'jpg' && $extensao == 'jpeg' && $extensao != 'png'){
        echo 'Formato de imagem invalido';
        exit;
    }

    //gera um nome aleatorio para imagem(hash)
    //a função uniqui fera um hash aleatorio baseado no tempo em microsegundos, mas ela nao e confiavel
    //utilizamos o nome temporario da imagem gerado pelo php mais o uniqid para incrementar o codigo gerado
    //utilizamos o md5 para gerar outro hash baseado no uniqui(nome, login, uniquid)
    $hash = md5(uniqid($_FILES['imagem']['tmp_name'],true));
    //juntamos o hash mais e extensao para ter o nome final da imagem
    $nome_final_imagem = $hash.'.'.$extensao;
    
    //caminho onde a imagem sera armazenada
    $pasta =  '../img/upload/';


    //funçaõ que faz o upload da imagem
    move_uploaded_file($_FILES['imagem']['tmp_name'],$pasta.$nome_final_imagem);

    

    // variavel que recebe a query SQL que será executada na BD
    $sql = "INSERT INTO 
    tb_viagens 
    (
    titulo,
    `local`,
    `valor`,
    `desc`,
    `imagem`
    ) 
    VALUES 
    (
    '$titulo','$local','$valor','$desc','$nome_final_imagem'
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

