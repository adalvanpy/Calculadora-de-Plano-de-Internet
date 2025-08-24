<?php
include __DIR__ . '/../database/conexao.php';
class CriarVendas
{
    private $conexao;
    public function __construct($conexao){
      $this->conexao = $conexao;
    }

    public function criarVenda($nome,$email,$telefone,$plano,$data,$game,$dispositivo){
        $sql = "INSERT INTO vendas(cliente,email,telefone,plano,data,game,dispositivo) VALUES(?,?,?,?,?,?,?)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("sssssis",$nome,$email,$telefone,$plano,$data,$game,$dispositivo);
        $stmt->execute();
        return $this->conexao->insert_id;
    }
    public function criarDispositivo($nome,$quantidade,$venda_id){
        $sql = "INSERT INTO dispositivo(nome,quantidade,venda_id) VALUES(?,?,?)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("ssi",$nome,$quantidade,$venda_id);
        $stmt->execute();
        return $this->conexao->insert_id;
    }

}
?>