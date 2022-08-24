<?php

include "conexao.php";

try {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $local = $_POST['local'];
    $valor = $_POST['valor'];
    $desc = $_POST['desc'];
    //captura o nome original da imagem a ser alterada
    $nome_original_imagem = $_FILES['imagem']['name'];

    var_dump($nome_original_imagem);

    if ($nome_original_imagem != null) {
        $extensao =  pathinfo($nome_original_imagem, PATHINFO_EXTENSION);

        //verificaçao de formato da imagem, se for diferente dos formatos validos, ira retornar erro ao ususario
        if ($extensao == 'jpg' && $extensao == 'jpeg' && $extensao != 'png') {
            echo 'Formato de imagem invalido';
            exit;
        }

        //gera um nome aleatorio para imagem(hash)
        //a função uniqui fera um hash aleatorio baseado no tempo em microsegundos, mas ela nao e confiavel
        //utilizamos o nome temporario da imagem gerado pelo php mais o uniqid para incrementar o codigo gerado
        //utilizamos o md5 para gerar outro hash baseado no uniqui(nome, login, uniquid)
        $hash = md5(uniqid($_FILES['imagem']['tmp_name'], true));
        //juntamos o hash mais e extensao para ter o nome final da imagem
        $nome_final_imagem = $hash . '.' . $extensao;

        //caminho onde a imagem sera armazenada
        $pasta =  '../img/upload/';


        //funçaõ que faz o upload da imagem
        move_uploaded_file($_FILES['imagem']['tmp_name'], $pasta . $nome_final_imagem);



        exit;
    

    exit;

    $sql = "UPDATE 
    tb_viagens 
    SET 
    `titulo` = '$titulo',
    `local`= '$local',
     `valor` = '$valor',  
    `desc` = '$desc',
    `imagem` = '$nome_final_imagem'
    WHERE
        id = $id;
    ";

}else{
    $sql = "UPDATE 
            tb_viagens
            SET
            `titulo` = '$titulo',
            `local`= '$local',
            `valor` = '$valor',  
            `desc` = '$desc',
            WHERE
            id = $id;
            ";
}

    $comando = $con->prepare($sql);

    $comando->execute();

    header('Location:../admin/alterar_viagens.php?id=' . $id);
}catch (PDOException $erro) {
    echo $erro->getMessage();
}
