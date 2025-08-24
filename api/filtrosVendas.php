<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $idDis = $_POST['id'] ?? "";

    header("Location: http://localhost:3001/vendas.php?id=" .$idDis);
    exit();
}
?>
