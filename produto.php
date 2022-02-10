<?php session_start(); ?>

<?php require_once('Controller/ProdutoController.php'); 
      $produto_control = new ProdutoController();

      if(count($_POST) > 0) {

        $resultado = $produto_control->cadastrar($_POST);

      }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<?php if ( isset ($_SESSION["nome"]) ):  ?>
<body>
    <?=include "cabecalho.php";?>
    <div class="container">
            <form action="produto.php" method="POST">

                <h2>Cadastro de Produtos</h2>
                <div class="form-group">
                    <label for="nome">Nome do produto: </label>
                    <input type="text" required class="form-control" id="nome" name="nome" placeholder="Digite o nome do produto...">
                </div>
                <div class="form-group">
                    <label for="categoria">Categoria: </label>
                    <input type="text" required class="form-control" id="categoria" name="categoria" placeholder="Digite a categoria...">
                </div>
                <div class="form-group">
                    <label for="valor">Valor (R$): </label>
                    <input type="number" required step=".01" class="form-control" id="valor" name="valor">
                </div>
                <div class="form-group">
                    <label for="info_adicional">Informações adicionais: </label>
                    <textarea id="info_adicional" class="form-control" name="info_adicional" rows="4" cols="50"> </textarea>
                </div>
                <button type="submit" class="btn btn-primary">Confirmar</button>

                <?php if( isset($resultado) ): ?>
                        <div class="alert <?= $resultado["style"]?>">
                            <?php echo $resultado["msg"]; ?>
                        </div>               
                <?php endif; ?>
            </form>
            <br><br><br>
            <?php $produtos = $produto_control->selecionar(); ?>

            <?php if(count($produtos) > 0): ?>

            <h4>Produtos Cadastrados</h4>
            <br>
            <table class="table" id="tab_produto">
                <tr>
                    <th>ID</th>
                    <th>Nome do Produto</th>
                    <th>Categoria</th>
                    <th>Valor</th>
                    <th>Info. Adicional</th>
                    <th>Data</th>
                    <th>Opções</th>
                </tr>
                <?php foreach($produtos as $p): ?>
                <tr id="produto<?=$p['id']?>">
                    <td><?= $p["id"]; ?></td>
                    <td><?= $p["nome"]; ?></td>
                    <td><?= $p["categoria"]; ?></td>
                    <td><?= $p["valor"]; ?></td>
                    <td><?= $p["info_adicional"]; ?></td>
                    <td><?= $p["data_produto"]; ?></td>
                    <td>
                        <a class="btn btn-outline-success btn-sm" href="venda.php?id=<?=$p['id']?>">Vender</a>
                        <a class="btn btn-outline-warning btn-sm" href="produto_alterar.php?id=<?=$p['id']?>">Alterar</a>
                        <a class="btn btn-outline-danger btn-sm" onclick="removerProduto('<?=$p['nome']?>', <?=$p['id']?>)">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>

    </div>
</body>


<script>
            // USO DO AJAX PARA POPUP DE EXCLUSÃO
            function removerProduto(nomeProduto, idProduto) {

                if( confirm('Remover ' + nomeProduto + '?') ){

                    var ajax = new XMLHttpRequest();
                    ajax.responseType = "json";
                    ajax.open("GET", "Controller/remover_produto.php?id="+idProduto, true);
                    ajax.send();
                    ajax.addEventListener("readystatechange", function(){

                        if(ajax.status === 200 && ajax.readyState === 4){
                            resposta = ajax.response.msg;
                            alert(resposta);
                            var row = document.getElementById("produto"+idProduto);
                            row.parentNode.removeChild(row);
                        }

                    })

                }

            }

</script>

</html>

<?php else: ?>

<div class="container">
    <div class="alert alert-danger">
        <h4>Você não está logado no sistema.</h4>
    </div>  
    <a class="btn btn-outline-primary btn-sm" href="index.php">Voltar para Login.</a>
</div>


<?php  endif; ?>