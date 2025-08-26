<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $idDis = $_POST['id'] ?? "";
    $busca = $_GET['busca'] ?? "";

    header("Location: http://localhost:3001/vendas.php?id=$idDis&busca=$busca");
    exit();
}
?>
