<?php
class Buscas{
    private $conexao;

    public function __construct($conexao){
        $this->conexao = $conexao;
    }
    public function buscarVendas(){
        $sql = "SELECT * FROM vendas";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    }
    public function buscarDispositivos(){
        $sql = "SELECT SUM(quantidade) as total FROM dispositivo";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $total = $stmt->get_result()->fetch_assoc();
        return $total['total'] ?? 0;
    }

    public function buscarVendasHoje($data){
        $sql = "SELECT * FROM vendas where data = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([$data]);
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    }
    public function exibirDispositivos(){
        $sql = "SELECT * FROM dispositivo";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
?>
