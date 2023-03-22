<?php
    class Database {
        private $conn;
        
        private $username;
        private $password;
        private $host;
        private $port;
        private $dbname;

        public function __construct(){
            $this->username = getenv('USERNAME');
            $this->password = getenv('PASSWORD');
            $this->host = getenv('HOST');
            $this->port = getenv('PORT');
            $this->db_name = getenv('DB_NAME');
        }

        public function connect() {
            if($this->conn){
                return $this->conn;
            } else {
                $dsn = "pgsql:host=$this->host;port=$this->port;dbname=$this->db_name;user=$this->username;password=$this->password";

                try {
                    $this->conn = new PDO($dsn, $this->username, $this->password);
                    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    return $this->conn;
                } catch (PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                }
            }
        }
    }
?>