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
public function insertUser($email, $password) {
    $stmt = $this->pdo->prepare("insert into user1 (email, password) values (?, ?)");
    $stmt->execute([$email, $password]);
    }
    
    public function selectUser($id = null){
        if (!$id){
        $stmt = $this->pdo->prepare("SELECT * FROM user1 WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        
        } 
        $stmt = $this->pdo->query("SELECT * FROM user1");
        $result = $stmt->fetchAll();
        return $result;
    }
    public function editUser($email, $password, $id){
        $stmt = $this->pdo->prepare("UPDATE user1 SET email = ?, password = ? WHERE id = ?");
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->execute([$email, $password, $id]);
    }
    public function deleteUSer($id){
        $stmt = $this->pdo->prepare("DELETE from user1 where id=?");
        $stmt->execute([$id]);
    }
}
?>