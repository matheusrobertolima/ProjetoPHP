<?php

if(count($_POST) > 0) {
    
    require_once('../Model/ProdutoDAO.php');
    
    $produto = new ProdutoDAO();

    $resultado = $produto -> atualizar($_POST);


    header("Location: ../produto.php");

}


?>