<?php

include_once("conexaobd.php");
class ProdutoDAO {

    private $id;
    private $nome;
    private $categoria;
    private $valor;
    private $info_adicional;
    private $id_usuario;

    private $banco_dados;

    function __construct()
    {
        $this->banco_dados = new Conexao();
    }

        function pegar_valores_post($valores) {
            if( ! isset($_SESSION["id"]) ) session_start();
            $this->id = isset($valores["id"]) ? $valores["id"] : 0;
            $this->nome = $valores["nome"];
            $this->categoria = $valores["categoria"];
            $this->valor = $valores["valor"];
            $this->info_adicional = $valores["info_adicional"];
            $this->id_usuario = $_SESSION["id"];

        }


        function selecionar($id = null){
            $where_cod = "";
            if(isset($id) && $id > 0) {

                $where_cod = " WHERE id = ".$id;
        
            }

            try{
                
                $conn = $this->banco_dados->conectar();
            
                $consulta = $conn->prepare("SELECT * FROM produto" . $where_cod);
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

        function inserir($produto) {
            $this->pegar_valores_post($produto);

            try {
                
                $conn = $this->banco_dados->conectar();
                $sql = "INSERT INTO produto (nome, categoria, valor, info_adicional, id_usuario) VALUES (?,?,?,?,?)";
                    $stmt= $conn->prepare($sql);
                    $stmt->execute([$this->nome, $this->categoria, $this->valor, $this->info_adicional, $this->id_usuario]);
        
                    $resultado["msg"] = "Produto inserido.";
                    $resultado["cod"] = 1;
                    $resultado["style"] = "alert-success";
        
                } catch(PDOException $e) {
                   
                $resultado["msg"] = "Erro ao inserir no Banco de Dados: " . $e->getMessage();;
                $resultado["cod"] = 0;
                $resultado["style"] = "alert-danger";
                }
                $conn = null;  
                

            return $resultado;
            

        }

        function atualizar($produto) {
            $this->pegar_valores_post($produto);

            try {
                
                $conn = $this->banco_dados->conectar();
                $sql = "UPDATE produto SET nome = ?, categoria = ?, valor = ?, info_adicional = ?, data_produto = now()
                        WHERE id = ?";
                    $stmt= $conn->prepare($sql);
                    // log
                    $stmt->execute([$this->nome, $this->categoria, $this->valor, $this->info_adicional, $this->id]);
        
                    $resultado["msg"] = "Produto alterado com sucesso.";
                    $resultado["cod"] = 1;
                    $resultado["style"] = "alert-success";
        
                } catch(PDOException $e) {
                   
                $resultado["msg"] = "Erro ao alterar no Banco de Dados: " . $e->getMessage();;
                $resultado["cod"] = 0;
                $resultado["style"] = "alert-danger";
                }
                $conn = null;
                return $resultado;

        }

        function remover ($codigo) {
            $id = $codigo;

            try {
                $conn = $this->banco_dados->conectar();
                $sql = "DELETE FROM produto WHERE id=:id";
                    $stmt= $conn->prepare($sql);
                    // log
                    $stmt->execute([':id' => $id]);
        
                    $resultado["msg"] = "Produto excluido.";
                    $resultado["cod"] = 1;
                    $resultado["style"] = "alert-danger";
        
                } catch(PDOException $e) {
                   
                $resultado["msg"] = "Erro ao inserir no Banco de Dados: " . $e->getMessage();;
                $resultado["cod"] = 0;
                $resultado["style"] = "alert-danger";
                }
                $conn = null; 
                return $resultado;

        }
    
}


?>