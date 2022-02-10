<?php require_once('Controller/UsuarioController.php'); 
      $usuario_control = new UsuarioController();

      if(count($_POST) > 0) {

        $resultado = $usuario_control->login($_POST);

      }

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
<body>
    <div class="container">
    <h2>Efetue o login</h2>
        <form id="form_login" action="index.php" method="POST">
            <input id="email" type="email" name="email" placeholder="Digite seu email..." />
            <br><br>
            <input id="senha" type="password" name="senha" placeholder="Digite sua senha..." />
            <br><br>
            <?php if(isset($resultado) && $resultado["cod"] == 0): ?>
                <div class="alert alert-danger">
                    <?php echo $resultado["msg"]; ?>
                </div>
            <?php endif; ?>
            <input id="enviar" type="submit" value="Efetuar Login" class="btn btn-primary" />
        </form>
    </div>
</body>
</html>

