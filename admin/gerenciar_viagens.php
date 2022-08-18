<?php
//include conexao
include     '../backend/conexao.php';

try {
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
    //echo "</pre>";
 
} catch (PDOException $erro) {
    //exibe a mensagem erro
    echo $erro->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Viagens</title>

    <hr>
    <a href="cadastrar_viagens.html">Cadastrar Viagens</a>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div id="container">
        <h3>Gerenciar Viagens</h3>

        <div id="tabela">
            <table border="1">
                <tr>
                    <th>Id</th>
                    <th>Título</th>
                    <th>Local</th>
                    <th>Valor</th>
                    <th>Descrição</th>
                    <th>Alterar</th>
                    <th>Deletar</th>
                </tr>
                <?php foreach ($dados as $viagem):?>

                    <tr>
                        <td><?php echo $viagem['id']; ?></td>
                        <td><?php echo $viagem['titulo']; ?></td>
                        <td><?php echo $viagem['local']; ?></td>
                        <td>R$<?php echo $viagem['valor']; ?></td>
                        <td><?php echo $viagem['desc']; ?></td>
                        <td>
                           <a href="alterar_viagens.php?id=<?php echo $viagem['id']; ?>">Alterar</a>
                        </td>

                        <td>
                           <a href="../backend/_deletar_viagens.php?id=<?php echo $viagem['id']; ?>">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <?php 
    $con = null;
    ?>

</body>

</html>