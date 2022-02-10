
<?php   

    Class Conexao {

        private $servername = "localhost";
        private $username = "root";
        private $password = "";

        public function conectar() {

            $conn = new PDO("mysql:host=$this->servername;dbname=projeto_php", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;

        }

    }
    

// $servername = "localhost";
// $username = "root";
// $password = "";

// $conn = new PDO("mysql:host=$servername;dbname=projeto_php", $username, $password);
// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>