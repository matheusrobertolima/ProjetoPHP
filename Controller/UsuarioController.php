<?php

require_once('Model/UsuarioDAO.php'); 
Class UsuarioController {   

    private $usuario;

    function __construct()
    {
        $this->usuario = new UsuarioDAO();
    }

    function selecionar($codigo = null) {

        return $this -> usuario -> selecionar($codigo);
        
    }

    function cadastrar($valores) {
                  
        return $this -> usuario -> inserir($valores);    
              
            
    }

    function login($valores) {

            $filtro = array();
            $filtro['email'] = $valores['email'];
            $filtro['senha'] = $valores['senha'];
            $usuario = $this -> usuario -> selecionar($filtro);
    
                
                if( count($usuario) == 1 ){
                    session_start();
                    $_SESSION["email"] = $valores['email'];
                    $_SESSION["nome"] = $usuario[0]["nome"];
                    $_SESSION["id"] = $usuario[0]["id"];
        
                    header("location:areaprivada.php");
        
        
                } else if ( count($usuario) == 0 ){
                    $resultado["msg"] = "Erro. Email ou senha incorretos.";
                    $resultado["cod"] = 0;

                    return $resultado;
                
                }
           
            }

}
?>