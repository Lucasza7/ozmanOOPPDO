<?php

class Database {
    public $pdo;

    public function __construct($host = "localhost:3306", $user = "root", $pass = "", $db = "test") {

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "connected to $db";
        } catch (Exception $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function insertUser($a, $b) {
        $sql = "INSERT INTO user VALUES (null, :username, :password)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['username' => $a, 'password' => $b]);
    }
}



?>