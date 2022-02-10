<?php session_start(); ?>

<?php 
      require_once('Controller/ProdutoController.php');
      $produto_control = new ProdutoController();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto PHP</title>
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
    
            <form action="Controller/alterar_produto.php" method="POST">

                <h2>Produtos</h2>
                <div class="form-group">
                    <label for="id">ID do produto: </label>
                    <input type="text" required value="<?= $produtos[0]['id']; ?>" class="form-control" id="id" name="id" readonly>
                </div>
                <div class="form-group">
                    <label for="nome">Nome do produto: </label>
                    <input type="text" required value="<?= $produtos[0]['nome']; ?>" class="form-control" id="nome" name="nome" placeholder="Digite o nome do produto...">
                </div>
                <div class="form-group">
                    <label for="categoria">Categoria: </label>
                    <input type="text" required value="<?= $produtos[0]['categoria']; ?>" class="form-control" id="categoria" name="categoria" placeholder="Digite a categoria...">
                </div>
                <div class="form-group">
                    <label for="valor">Valor (R$): </label>
                    <input type="number" required value="<?= $produtos[0]['valor']; ?>" step=".01" class="form-control" id="valor" name="valor">
                </div>
                <div class="form-group">
                    <label for="info_adicional">Informações adicionais: </label>
                    <textarea id="info_adicional" class="form-control" name="info_adicional" rows="4" cols="50"><?= $produtos[0]['info_adicional']; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Alterar Produto</button>

            </form>
            
            <?php if( isset($resultado) ): ?>
                        <div class="alert <?= $resultado["style"]?>">
                            <?php echo $resultado["msg"]; ?>
                        </div>               
                <?php endif; ?>

            <br><br><br>

        

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