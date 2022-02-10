<?php
session_start();

if(isset($_SESSION['id']) && $_SESSION['id'] > 0) {
    if(count($_GET) > 0) {
        $id = $_GET["id"];

        require_once('../Model/ProdutoDAO.php');
        
        $produto = new ProdutoDAO();

        $resultado = $produto -> remover($id);
    
        echo json_encode($resultado);

    }
}

else {

    echo "Operação não permitida.";

}
?>