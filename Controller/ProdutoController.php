<?php

require_once('Model/ProdutoDAO.php'); 
Class ProdutoController {   

    private $produto;

    function __construct()
    {
        $this->produto = new ProdutoDAO();
    }

    function selecionar($codigo = null) {

        return $this -> produto -> selecionar($codigo);
        
    }

    function cadastrar($valores) {
                  
        $resultado = $this -> produto -> inserir($valores);    
              
            
    }


}
?>