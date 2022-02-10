<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Privada</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<?php if ( isset ($_SESSION["nome"]) ):  ?>
<body>
    <?=include "cabecalho.php";?>
    <div class="container">
    <h5>Olá, <?= $_SESSION["nome"]; ?> !!! </h5>
    <br><br><br>

    <li class="nav-item">                        
        <a class="nav-link" href="produto.php">Lista de Produtos</a>  
    <li class="nav-item">                        
        <a class="nav-link" href="usuario.php">Cadastrar Usuário</a>  

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