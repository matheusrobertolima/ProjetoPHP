<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Menu</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <?php if (isset($_SESSION["nome"])) :  ?>
    <body>
        <nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                    <span class="navbar-toggler-icon"></span> <!-- menu -->
                </button>

                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <!-- MENU -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Menu de navegação para a direita -->                       
                        

                        <li class="nav-item">

                            <a class="nav-link" href="areaprivada.php">Área privada</a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link" href="Controller/logout.php">Sair</a>

                        </li>


                    </ul>
                </div>

            </div>
        </nav>
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