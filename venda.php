<?php session_start(); ?>

<?php require_once('Controller/VendaController.php'); 
      $venda_control = new VendaController();

      if(count($_POST) > 0) {

        $resultado = $venda_control->cadastrar($_POST);

      }

?>
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
    <title>Fazer Venda</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<?php if ( isset ($_SESSION["nome"]) ):  ?>
<body>
    <?=include "cabecalho.php";?>
    <div class="container">
        
            <?php 
            $id = $_GET["id"];
            $produtos = $produto_control->selecionar($id);
            ?>

            <form action="Controller/realizar_venda.php" method="POST">

                <h2>Realizar Venda</h2>
                <div class="form-group">
                    <label for="id_produto">ID do produto: </label>
                    <input type="text" required value="<?= $produtos[0]['id']; ?>" class="form-control" id="id_produto" name="id_produto" readonly>
                </div>
                <div class="form-group">
                    <label for="nome">Nome do produto: </label>
                    <input type="text" required value="<?= $produtos[0]['nome']; ?>" class="form-control" id="nome" name="nome" placeholder="Digite o nome do produto..." readonly>
                </div>
                <div class="form-group">
                    <label for="categoria">Categoria: </label>
                    <input type="text" required value="<?= $produtos[0]['categoria']; ?>" class="form-control" id="categoria" name="categoria" placeholder="Digite a categoria..." readonly>
                </div>
                <div class="form-group">
                    <label for="valor">Preço Unitário (R$): </label>
                    <input type="number" required value="<?= $produtos[0]['valor']; ?>" step=".01" class="form-control" id="valor" name="valor" readonly>
                </div>
                <div class="form-group">
                    <label for="info_adicional">Informações adicionais: </label>
                    <textarea id="info_adicional" class="form-control" name="info_adicional" rows="4" cols="50"><?= $produtos[0]['info_adicional']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="quantidade">Quantidade: </label>
                    <input type="number" required step=".01" class="form-control" id="quantidade" name="quantidade">
                </div>
                <button type="submit" class="btn btn-primary">Realizar Venda</button>

            </form>
            <br><br><br>
            <?php $vendas = $venda_control->selecionar(); ?>

            <?php if(count($vendas) > 0): ?>

            <h4>Vendas Realizadas</h4>
            <br>
            <table class="table" id="tab_venda">
                <tr>
                    <th>ID</th>
                    <th>Nome do Produto</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Observações</th>
                    <th>ID User</th>
                    <th>ID Produto</th>
                    <th>Data</th>
                </tr>
                <?php foreach($vendas as $v): ?>
                <tr id="venda<?=$v['id']?>">
                    <td><?= $v["id"]; ?></td>
                    <td><?= $v["nome_produto"]; ?></td>
                    <td><?= $v["quantidade"]; ?></td>
                    <td><?= $v["preco"]; ?></td>
                    <td><?= $v["observacao"]; ?></td>
                    <td><?= $v["id_usuario"]; ?></td>
                    <td><?= $v["id_produto"]; ?></td>
                    <td><?= $v["data_pedido"]; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>

    </div>
</body>

</html>

<?php else: ?>

<div class="container">
    <div class="alert alert-danger">
        <h4>Você não está logado no sistema.</h4>
    </div>  
    <a class="btn btn-outline-primary btn-sm" href="index.php">Voltar para Login.</a>
</div>


<?php  endif; ?>