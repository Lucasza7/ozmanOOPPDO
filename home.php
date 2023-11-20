<?php
include 'db.php';
$pdo = new Database();

try {
    $pdo->insertUser("lucas", "lucas");
    echo "succes";
} catch (PDOException $e) {
    echo "error instert .".$e->getMessage();
}
?>