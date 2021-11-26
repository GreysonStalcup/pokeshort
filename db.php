<?php 
    class Database{
        private $host;
        private $port;
        private $user;
        private $pass;
        private $dbname;

        function __construct(string $host, string $port, string $user, string $pass, string $dbname){
            $this->host = $host;
            $this->port = $port;
            $this->user = $user;
            $this->pass = $pass;
            $this->dbname = $dbname;
        }
        public function connect(){
            $conn_str = "mysql:host=" . $this->host . ";dbname=".$this->dbname;

            try {
                $conn = new PDO($conn_str, $this->user, $this->pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);


                /* echo "Connected successfully!"; */
                return $conn;
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            } 
            /* $conn = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);
            if ($conn->connect_error){
                die("failed to connect" . $conn->connect_error);
            } else echo "connected"; */
        }
    }

?>