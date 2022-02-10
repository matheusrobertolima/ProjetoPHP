<?php

include_once("conexaobd.php");
class UsuarioDAO {

    private $id;
    private $nome;
    private $email;
    private $senha;
    private $data_registro;

    private $banco_dados;

    function __construct()
    {
        $this->banco_dados = new Conexao();
    }

        function pegar_valores_post($valores) {
            if( ! isset($_SESSION["id"]) ) session_start();
            $this->id = isset($valores["id"]) ? $valores["id"] : 0;
            $this->nome = $valores["nome"];
            $this->email = $valores["email"];
            $this->senha = $valores["senha"];
            $this->data_registro = isset($valores["data_registro"]) ? $valores["data_registro"] : date('Y-m-d H:i:s');

        }


        function selecionar($filtro = array()){
            $where_cod = " 1 = 1 ";
            if( isset($filtro['id']) ) 
                $where_cod .= " AND id = :id";
            if( isset($filtro['email']) ) 
                $where_cod .= " AND email = :email"; 
            if( isset($filtro['senha']) ) 
                $where_cod .= " AND senha = :senha";
            

            try{
                
                $conn = $this->banco_dados->conectar();

                $consulta = $conn->prepare("SELECT * FROM usuario WHERE " . $where_cod);
                if( isset($filtro['id']) ) 
                    $consulta->bindParam(':id', $filtro['id'], PDO::PARAM_INT);
                if( isset($filtro['email']) ) 
                    $consulta->bindParam(':email', $filtro['email'], PDO::PARAM_STR);
                if( isset($filtro['senha']) ) 
                    $consulta->bindParam(':senha', $filtro['senha'], PDO::PARAM_STR);
            
                $consulta->execute();
                $resultado = $consulta->fetchAll();
            } catch(PDOException $e) {
            
                $resultado["msg"] = "Erro ao mostrar produto: " . $e->getMessage();;
                $resultado["cod"] = 0;
                $resultado["style"] = "alert-danger";
            }
            $conn = null;
            return $resultado;

        }

        function inserir($usuario) {
            $this->pegar_valores_post($usuario);

            try {
                
                $conn = $this->banco_dados->conectar();
                $sql = "INSERT INTO usuario (nome, email, senha, data_registro) VALUES (?,?,?,?)";
                    $stmt= $conn->prepare($sql);
                    $stmt->execute([$this->nome, $this->email, $this->senha, $this->data_registro]);
        
                    $resultado["msg"] = "Usuario inserido.";
                    $resultado["cod"] = 1;
                    $resultado["style"] = "alert-success";
        
                } catch(PDOException $e) {
                   
                $resultado["msg"] = "Erro ao inserir Usuario no Banco de Dados: " . $e->getMessage();;
                $resultado["cod"] = 0;
                $resultado["style"] = "alert-danger";
                }
                $conn = null;  
                

            return $resultado;
            

        }

    
}


?>