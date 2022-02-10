<?php

include_once("conexaobd.php");
class VendaDAO {

    private $nome_produto;
    private $quantidade;
    private $preco;
    private $observacao;
    private $id_usuario;
    private $id_produto;

    private $banco_dados;

    function __construct()
    {
        $this->banco_dados = new Conexao();
    }

        function pegar_valores_post($valores) {
            if( ! isset($_SESSION["id"]) ) session_start();
            $this->nome_produto = $valores["nome"];
            $this->quantidade = $valores["quantidade"];
            $this->preco = $valores["valor"];
            $this->observacao = $valores["info_adicional"];
            $this->id_usuario = $_SESSION["id"];
            $this->id_produto = $valores["id_produto"];

        }


        function selecionar($id = null){
            $where_cod = "";
            if(isset($id) && $id > 0) {

                $where_cod = " WHERE id = ".$id;
        
            }

            try{
                
                $conn = $this->banco_dados->conectar();
            
                $consulta = $conn->prepare("SELECT * FROM venda" . $where_cod);
                $consulta->execute();
                $resultado = $consulta->fetchAll();
            } catch(PDOException $e) {
            
                $resultado["msg"] = "Erro ao mostrar venda: " . $e->getMessage();;
                $resultado["cod"] = 0;
                $resultado["style"] = "alert-danger";
            }
            $conn = null;
            return $resultado;

        }

        function inserir($venda) {
            $this->pegar_valores_post($venda);

            try {
                
                $conn = $this->banco_dados->conectar();
                $sql = "INSERT INTO venda (nome_produto, quantidade, preco, observacao, id_usuario, id_produto) VALUES (?,?,?,?,?,?)";
                    $stmt= $conn->prepare($sql);
                    $stmt->execute([$this->nome_produto, $this->quantidade, $this->preco, $this->observacao, $this->id_usuario, $this->id_produto]);
        
                    $resultado["msg"] = "Venda feita.";
                    $resultado["cod"] = 1;
                    $resultado["style"] = "alert-success";
        
                } catch(PDOException $e) {
                   
                $resultado["msg"] = "Erro ao inserir Venda no Banco de Dados: " . $e->getMessage();;
                $resultado["cod"] = 0;
                $resultado["style"] = "alert-danger";
                }
                $conn = null;  
                

            return $resultado;
            

        }

    
}


?>