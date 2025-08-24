<?php
header('Content-Type: application/json');

include __DIR__ . '/../classes/Sql.php';
include __DIR__ . '/../database/conexao.php';

$venda = new Buscas($conexao);
$data = new DateTime();
$data = $data->format('Y-m-d');

$response = [
    'vendas' => $venda->buscarVendas(),
    'dispositivos' => $venda->buscarDispositivos(),
    'vendasHoje' => $venda->buscarVendasHoje($data),
    'exibirDispositivos' => $venda->exibirDispositivos(),
];
echo json_encode($response);

?>