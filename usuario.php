<?php session_start(); ?>

<?php require_once('Controller/UsuarioController.php'); 
      $usuario_control = new UsuarioController();

      if(count($_POST) > 0) {

        $resultado = $usuario_control->cadastrar($_POST);

      }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<?php if ( isset ($_SESSION["nome"]) ):  ?>
<body>
    <?=include "cabecalho.php";?>
    <div class="container">
            <form action="usuario.php" method="POST">

                <h2>Cadastrar Usuário</h2>
                <br>
                <div class="form-group">
                    <label for="nome">Nome do usuario: </label>
                    <input type="text" required class="form-control" id="nome" name="nome" placeholder="Digite o nome do usuario...">
                </div>    
                <div class="form-group">
                    <label for="email">Email do usuario: </label>
                    <input type="text" required class="form-control" id="email" name="email" placeholder="Digite o email do usuario...">
                </div>   
                <div class="form-group">
                    <label for="senha">Senha do usuario: </label>
                    <input type="password" required class="form-control" id="senha" name="senha" placeholder="Digite o senha do usuario...">
                </div>           
                <button type="submit" class="btn btn-primary">Adicionar usuário</button>

                <?php if( isset($resultado) ): ?>
                        <div class="alert <?= $resultado["style"]?>">
                            <?php echo $resultado["msg"]; ?>
                        </div>               
                <?php endif; ?>
            </form>
            <br><br><br>
            <?php $usuarios = $usuario_control->selecionar(); ?>

            <?php if(count($usuarios) > 0): ?>

            <h4>Usuarios Cadastrados</h4>
            <br>
            <table class="table" id="tab_produto">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Data de Registro</th>

                </tr>
                <?php foreach($usuarios as $u): ?>
                <tr id="usuario<?=$u['id']?>">
                    <td><?= $u["id"]; ?></td>
                    <td><?= $u["nome"]; ?></td>
                    <td><?= $u["email"]; ?></td>
                    <td><?= $u["data_registro"]; ?></td>
                    <td>
                        
                    </td>
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