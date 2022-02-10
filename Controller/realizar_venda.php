<?php

if(count($_POST) > 0) {
    
    require_once('../Model/VendaDAO.php');
    
    $venda = new VendaDAO();

    $resultado = $venda -> inserir($_POST);

    header("Location: ../produto.php");


}


?>