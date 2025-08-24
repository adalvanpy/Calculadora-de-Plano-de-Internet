<?php
session_start();
include(__DIR__ . '/database/conexao.php');
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user = $_POST['usuario'];
    $pass = hash('sha256', $_POST['senha']);

    $sql = "SELECT * FROM usuario WHERE nome = ? AND senha = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if($row = $resultado->fetch_assoc()){
        $_SESSION['usuario'] = $user;
        $_SESSION['id'] = $row['id'];

        setcookie("usuario", $user, time() + 3600, "/","localhost");
        setcookie("id", $row["id"], time() + 3600, "/","localhost");
        header('Location: http://localhost:3001/vendas.php');
        exit();
    } else {
        echo "Usuário ou senha incorretos!";
    }

}
?>
