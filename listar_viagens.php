<?php
//incluindo arquivo de conexao
    include 'backend/conexao.php';
    try{
        //lista as informações
        //monta a query sql
        $sql = "SELECT * FROM tb_viagens"; 
        //prepara a execução da query sql a cima
        $comando = $con->prepare($sql);
        //executa o comando com a query no banco de dados
        $comando->execute();
        //criando a var que ira armazenar os dados, e setando o fetch emmodo associativo(chave/valor)
        $dados = $comando->fetchAll(PDO::FETCH_ASSOC);
        
        //pre = prepara os dados, mostra no navegador as chaves e id
        //echo "<pre>";
        //var_dump($dados);
       // echo "</pre>";
    }catch(PDOException $erro){
        echo $erro->getMessage();
        
    }
    
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Viagens</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div id="container">
    <h3>Lista de Viagens</h3>
    <div id="grid-viagens">
        <!--repetição foreach,  $dados as= dando apelido $d dados resume o nome de dados-->
        <?php
            foreach($dados as $d):
        ?>
        <figure class="figure-viagens"><!--html-->
            <img class="img-viagens" src="img/gramado.jpg" alt="imagem da viagem">
            <!--bloco php figcaption repete ele varias vezes-->
            <figcaption class="figcaption-viagens">
                <h4><?php echo $d['titulo'];?>Pacote de Inverno</h4>
                <h5><?php echo $d['local'];?>Gramado</h5>
                <h5><?php echo $d['valor'];?>R$ 1.700</h5>
                <!--small deixa texto pequeno-->
                <small><?php echo $d['desc'];?>5 dias de Hotel com café da manhã</small>
                <button class="btn-comprar">Comprar</button>
            </figcaption>
        </figure>

        <?php endforeach;?>
    </div>
  </div>  
</body>
</html>