<?php

require_once('Model/VendaDAO.php'); 
Class VendaController {   

    private $venda;

    function __construct()
    {
        $this->venda = new VendaDAO();
    }

    function selecionar($codigo = null) {

        return $this -> venda -> selecionar($codigo);
        
    }

    function cadastrar($valores) {
                  
        $resultado = $this -> venda -> inserir($valores);    
              
            
    }


}
?>