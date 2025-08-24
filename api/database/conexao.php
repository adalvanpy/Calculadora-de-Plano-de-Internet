<?php
$conexao = mysqli_connect("mysql-db", "user", "user123", "appdb");
if(!$conexao){
  die('Falha na conexao: ' . mysqli_connect_error());
}
?>
