<?php
class Database {

    private $conn;
    
    // получение соединения с базой данных 
    public function getConnection() {
        $this->conn = null;

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {  
            $this->conn = new PDO("mysql:host=localhost;dbname=kristall-voda","admins","123", $options);  
        }  
        catch(PDOException $e) {  
            echo $e->getMessage();
            die();
        }
    }

    // запрос к базе данных
    public function query($query) {
        try {
            return $stmt = $this->conn->query($query);
        }
        catch(PDOExeption $e) {
            echo $e->getMassege();
        }
    }
}
