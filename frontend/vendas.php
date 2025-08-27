<?php
session_start();
$url = 'http://api/crud/Buscas.php';
$json = file_get_contents($url);
$dados = json_decode($json, true);

$vendas = $dados['vendas'] ?? [];
$dispositivos = $dados['dispositivos'] ?? 0;
$vendasHoje = $dados['vendasHoje'] ?? [];
$exibirDispositivos = $dados['exibirDispositivos'] ?? [];

$totalV = count($vendas);
$totalVendasHoje = count($vendasHoje);

$busca = $_POST['busca'] ?? $_GET['busca'] ?? $_GET['tipo'] ?? "";
$mostrarD = $_GET['id'] ?? "";

if (!empty($busca) && $busca !== 'todas') {
    $vendas = array_filter($vendas, function($venda) use ($busca) {
        return str_starts_with($venda['cliente'] ?? '', $busca)
            || ($venda['data'] ?? '') === $busca;
    });
}

$user = $_SESSION['usuario'] ?? $_COOKIE['usuario'] ?? "";
$id   = $_SESSION['id'] ?? $_COOKIE['id'] ?? "";

if(!$user || !$id){
    header('Location: http://localhost:3001/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-start justify-center w-full min-h-screen bg-gray-100">

<aside class="flex fixed left-0 flex-col items-start justify-between w-[18%] h-screen bg-[#1E64B7] text-white p-6 shadow-xl">
    <div class="flex w-full flex-col items-start mt-4 gap-6">
        <div class="flex items-center justify-between w-full">
            <div class="flex h-20 w-full items-center">
                <span class="flex items-center justify-center text-2xl font-bold bg-white text-[#1E64B7] w-12 h-12 rounded-full">
                    <?= substr($user, 0,1) ?>
                </span>
            </div>
            <a href="http://localhost:3000/sair.php" class="hover:text-red-400 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 16 16" fill="white">
                    <path d="M8 6V7h3V9l3-2V6L11 4V5 6H8
                       M5 9c0 1 1 2 2 2H9V10H7S6 10 6 9V4
                       S6 3 7 3H9V2H7C6 2 5 3 5 4V9"/>
                </svg>
            </a>
        </div>
        <a href="calculadora_plano.php" class="hover:underline text-xl">Calculadora</a>
        <a href="http://localhost:3001/vendas.php" class="hover:underline text-xl">Vendas</a>
    </div>
</aside>


<main class="flex flex-col items-center ml-[18%] w-[82%] p-8">

    <div class="flex gap-12 w-full justify-center mt-10">
        <div class="flex flex-col items-center justify-center bg-white p-6 rounded-xl shadow-lg w-1/5">
            <span class="text-gray-600">Total vendas</span>
            <span class="text-4xl font-bold text-green-600"><?= $totalV ?></span>
        </div>
        <div class="flex flex-col items-center justify-center bg-white p-6 rounded-xl shadow-lg w-1/5">
            <span class="text-gray-600">Vendas hoje</span>
            <span class="text-4xl font-bold <?= $totalVendasHoje > 0 ? 'text-green-600':'text-red-500' ?>">
                <?= $totalVendasHoje ?>
            </span>
        </div>
        <div class="flex flex-col items-center justify-center bg-white p-6 rounded-xl shadow-lg w-1/5">
            <span class="text-gray-600">Dispositivos</span>
            <span class="text-4xl font-bold text-green-600"><?= $dispositivos ?></span>
        </div>
    </div>

    <div class="flex flex-col items-center justify-center w-full mt-10">
        <div class="flex items-center justify-between rounded-t-md w-[90%] p-4 bg-[#d8e3e9]">
            <div>
                <p class="font-bold text-lg">Vendas</p>
                <a href="http://localhost:3001/vendas.php?tipo=todas" class="text-green-600 hover:underline">Ver todas</a>
            </div>
            <form action="http://localhost:3001/vendas.php" method="post" class="flex bg-white rounded-md shadow">
                <input class="rounded-md w-60 px-4 py-2 focus:outline-none" type="search" name="busca" placeholder="Buscar por...">
                <button class="px-4" type="submit">
                    <svg class="w-6 h-6 text-[#0F3A6D]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="m21 21-4.3-4.3"/>
                    </svg>
                </button>
            </form>
        </div>
        <table class="w-[90%] bg-white text-gray-800 shadow-lg rounded-b-md overflow-hidden">
            <thead class="bg-[#d8e3e9]">
            <tr>
                <th class="px-4 py-2">Nome</th>
                <th class="px-4 py-2">E-mail</th>
                <th class="px-4 py-2">Telefone</th>
                <th class="px-4 py-2">Plano</th>
                <th class="px-4 py-2">Data</th>
                <th class="px-4 py-2">Game</th>
                <th class="px-4 py-2">Dispositivos</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($vendas as $venda): ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 border-t text-center"><?= $venda['cliente'] ?></td>
                    <td class="px-4 py-3 border-t text-center"><?= $venda['email'] ?></td>
                    <td class="px-4 py-3 border-t text-center"><?= $venda['telefone'] ?></td>
                    <td class="px-4 py-3 border-t text-center">
                        <span class="px-2 py-1 rounded-md <?=
                        $venda['plano']=='Plano Ouro' ? 'bg-yellow-300' :
                            ($venda['plano']=='Plano Prata' ? 'bg-gray-300' :
                                ($venda['plano']=='Plano Bronze' ? 'bg-amber-700 text-white':'bg-cyan-200')) ?>">
                            <?= $venda['plano'] ?>
                        </span>
                    </td>
                    <td class="px-4 py-3 border-t text-center"><?= $venda['data'] ?></td>
                    <td class="px-4 py-3 border-t text-center">
                        <svg class="w-8 h-8 mx-auto" viewBox="0 0 40 40">
                            <path d="M11 8C8 8 4 10 4 16 4 22 8 24 12 25L15 25C18 24 22 22 22 16 22 10 18 8 15 8L15 10C18 10 20 12 20 16 20 20 18 22 15 23L12 23C8 22 6 20 6 16 6 12 8 10 11 10M12 4 12 16C12 18 14 18 14 16L14 4C14 2 12 2 12 4"
                                  fill="<?= $venda['game']=='0' ? 'red' : '#22c55e' ?>"/>
                        </svg>
                    </td>
                    <td class="px-4 py-3 border-t text-center">
                        <form action="http://localhost:3000/filtrosVendas.php?busca=<?= $busca ?>" method="post">
                            <input type="hidden" name="id" value="<?= $venda['id'] ?>">
                            <button type="submit" class="hover:scale-110 transition">
                                <svg class="w-6 h-6" viewBox="0 0 12 12">
                                    <path d="M8 5 2 5 2 1 8 1 8 2 3 2 3 4 7 4 7 2 8 2 M5 5 3 7 7 7 5 5" fill="#22c55e"/>
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php if($mostrarD): ?>
        <div id="contDis" class="fixed top-20 right-10 bg-white shadow-xl rounded-lg p-6 w-[50%]">
            <div class="flex justify-between items-center mb-4">
                <h2 class="font-bold text-lg">Detalhes da venda</h2>
                <button onclick="document.getElementById('contDis').classList.add('hidden')"
                        class="bg-red-500 text-white px-3 py-1 rounded-md">X</button>
            </div>
            <table class="w-full shadow-md mb-4">
                <thead class="bg-[#d8e3e9]">
                <tr>
                    <th class="px-4 py-2">Dispositivo</th>
                    <th class="px-4 py-2">Quantidade</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($exibirDispositivos as $d): ?>
                    <?php if($mostrarD == $d['venda_id']): ?>
                        <tr class="odd:bg-gray-50">
                            <td class="border-t text-center px-4 py-2"><?= $d['nome'] ?></td>
                            <td class="border-t text-center px-4 py-2"><?= $d['quantidade'] ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php foreach ($vendas as $venda): ?>
                <?php if($venda['id'] == $mostrarD): ?>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-2 rounded-md shadow">
                            <p class="font-bold">Nome</p>
                            <p><?= $venda['cliente'] ?></p>
                        </div>
                        <div class="bg-gray-50 p-2 rounded-md shadow">
                            <p class="font-bold">Plano</p>
                            <p><?= $venda['plano'] ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>
</body>
</html>

