<?php
session_start();
$url = 'http://api/crud/Buscas.php';
$json = file_get_contents($url);
$dados = json_decode($json, true);
$vendas = $dados['vendas'];
$dispositivos = $dados['dispositivos'];
$vendasHoje = $dados['vendasHoje'];
$exibirDispositivos = $dados['exibirDispositivos'];
$totalV = COUNT($vendas);
$totalVendasHoje = COUNT($vendasHoje);

$busca = $_POST['busca'] ?? "";
$mostrarD = $_GET['id'] ?? "";

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
<body class="flex items-start justify-center w-full h-auto border bg-[#E6F0FA]">
<sidebar class="flex fixed left-0 flex-col items-start justify-between w-[18%] h-screen bg-[#1E64B7] p-4 text-white">
    <div class="flex w-full flex-col items-start mt-4 gap-4">
        <div class="flex items-center justify-between  w-full">
            <div class="flex h-20 w-full">
                <span class=" text-center text-2xl text-[#3e5f8a] rounded-full bg-white w-10 h-10 mb-9"> <?= substr($user, 0,1)?>
                </span>
            </div>
            <div class="flex items-start justify-end h-20 w-full">
                <a href="http://localhost:3000/sair.php">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-8 h-8" viewBox="0 0 16 16"
                         fill="white">
                        <path d="M8 6V7h3V9l3-2V6L11 4V5 6H8
           M5 9c0 1 1 2 2 2H9V10H7S6 10 6 9V4
           S6 3 7 3H9V2H7C6 2 5 3 5 4V9
           S5 9 5 9 5 9 5 9"/>
                    </svg>
                </a>
            </div>
        </div>
        <a href="calculadora_plano.php" class="mt-8 underline text-2xl">Calculadora</a>
        <a href="http://localhost:3001/vendas.php" class="underline text-2xl">Vendas</a>
    </div>
</sidebar>
<main class="flex flex-col items-end justify-end p-4 border h-auto w-full">
    <div class="flex items-center gap-[15%] w-[85%] justify-center  mt-20 text-white">
        <div class="flex w-[20%] flex-col items-center justify-center p-4 bg-[#1E64B7] shadow-md rounded-md">
                <span>Total vendas</span>
                <span class="text-4xl"><?=$totalV?></span>
        </div>
        <div class="flex w-[20%] flex-col items-center justify-center p-4 bg-[#1E64B7] shadow-md rounded-md">
                <span>Total vendas hoje</span>
                <span class="text-4xl"><?=$totalVendasHoje?></span>
        </div>
        <div class="flex w-[20%] flex-col items-center justify-center p-4 bg-[#1E64B7] shadow-md rounded-md">
                <span>Total dispositivos</span>
                <span class="text-4xl"><?=$dispositivos?></span>
        </div>
    </div>
    <div class="flex flex-col items-center justify-center w-[85%] mt-10">
        <div class="flex items-center justify-center rounded-t-md w-[90%] h-full p-4 bg-[#0F3A6D]">
            <div class="w-full">
                <p class="font-bold text-lg text-white">Vendas</p>
                <span id="tipo" class="text-center text-[#00FF00]">Todas</span>
            </div>
            <div>
                <form action="http://localhost:3001/vendas.php" method="post" class="flex bg-white rounded-md">
                    <input class=" rounded-md w-60 px-4 py-2 focus:outline-none focus:ring-0" type="search" name="busca" placeholder="Buscar por...">
                    <button class=" rounded-md w-20 px-4 py-2" type="submit"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search w-8 h-8 text-[#0F3A6D]">
                            <circle cx="11" cy="11" r="8"/>
                            <path d="m21 21-4.3-4.3"/>
                        </svg></button>
                </form>
            </div>
        </div>
        <table class="w-[90%] bg-[#0F3A6D] text-white">
            <thead class="">
            <tr>
                <th class="px-4 py-2 w-60">Nome</th>
                <th class="px-4 py-2 w-60">E-mail</th>
                <th class="px-4 py-2 w-60">Telefone</th>
                <th class="px-4 py-2 w-60" >Plano</th>
                <th class="px-4 py-2 w-60">Data</th>
                <th class="px-4 py-2 w-60">Game</th>
                <th class="px-4 py-2 w-60">Dispositivos</th>
            </tr>
            </thead>
            <tbody class="border">
            <?php foreach ($vendas as $venda): ?>
                <?php
                if ($busca === ''
                    || str_contains(strtolower($venda['cliente']), strtolower($busca))
                    || str_contains(strtolower($venda['data']), strtolower($busca))):
                    ?>
                    <tr>
                        <td class="px-4 py-3 w-80 border text-center"><?= $venda['cliente'] ?></td>
                        <td class="px-4 py-3 w-60 border text-center"><?= $venda['email'] ?></td>
                        <td class="px-4 py-3 w-60 border text-center"><?= $venda['telefone'] ?></td>
                        <?php if($venda['plano'] == 'Plano Prata'):?>
                        <td class="px-4 py-3 w-60 text-[#e6e6e6] border text-center"><?= $venda['plano'] ?></td>
                        <?php elseif($venda['plano'] == 'Plano Bronze'):?>
                        <td class="px-4 py-3 w-60 text-[#cd7f32] border text-center"><?= $venda['plano'] ?></td>
                        <?php elseif ($venda['plano'] == 'Plano Ouro'):?>
                        <td class="px-4 py-3 w-60 text-[#ffd700] border text-center"><?= $venda['plano'] ?></td>
                        <?php else: ?>
                        <td class="px-4 py-3 w-60 text-[#b9f2ff] border text-center"><?= $venda['plano'] ?></td>
                        <?php endif; ?>
                        <td class="px-4 py-3 w-80 border text-center"><?= $venda['data'] ?></td>
                        <?php if($venda['game'] == '0'):?>
                        <td class="px-4 py-3 w-[10%] border">
                            <div class="flex items-center justify-center">
                                <svg class="w-20 h-10" viewBox="0 0 30 30">
                                    <path d="M11 8C8 8 4 10 4 16 4 22 8 24 12 25L15 25C18 24 22 22 22 16 22 10 18 8 15 8L15 10C18 10 20 12 20 16 20 20 18 22 15 23L12 23C8 22 6 20 6 16 6 12 8 10 11 10M12 4 12 16C12 18 14 18 14 16L14 4C14 2 12 2 12 4" fill="red"/>
                                </svg>
                            </div>
                        </td>
                        <?php else:?>
                        <td class="px-4 py-3 w-[10%] border">
                            <div class="flex items-center justify-center">
                                <svg class="w-20 h-10" viewBox="0 0 30 30">
                                    <path d="M11 8C8 8 4 10 4 16 4 22 8 24 12 25L15 25C18 24 22 22 22 16 22 10 18 8 15 8L15 10C18 10 20 12 20 16 20 20 18 22 15 23L12 23C8 22 6 20 6 16 6 12 8 10 11 10M12 4 12 16C12 18 14 18 14 16L14 4C14 2 12 2 12 4" fill="#00FF00"/>
                                </svg>
                            </div>
                        </td>
                        <?php endif; ?>
                        <td class="px-4 py-3 w-[10%] border text-center">
                            <form action="http://localhost:3000/filtrosVendas.php" method="post">
                                <input type="hidden" name="id" value="<?= $venda['id'] ?>">
                                <button type="submit" class="p-1">
                                    <svg class="w-10 h-10" viewBox="0 0 10 10">
                                        <path d="M8 5 2 5 2 1 8 1 8 2 3 2 3 4 7 4 7 2 8 2
                                                 M5 5 3 7 7 7 5 5"
                                              fill="#00FF00"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php if($busca !== "" && str_contains(strtolower($venda['cliente']), strtolower($busca))): ?>
                    <script> document.getElementById('tipo').innerHTML = 'Cliente'</script>
                <?php elseif ( $busca !== "" && str_contains(strtolower($venda['data']), strtolower($busca))): ?>
                    <script> document.getElementById('tipo').innerHTML = 'Data'</script>
                <?php elseif ($busca === ""): ?>
                    <script> document.getElementById('tipo').innerHTML = 'Todas'</script>
                <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php if($mostrarD): ?>
        <div id="contDis" class="flex fixed top-40 right-10 items-start justify-center h-auto w-[50%]">
            <table class="w-full text-white">
                <thead class="bg-[#AFCBEB]">
                 <tr>
                     <th class="px-4 py-2 w-60">Dispositivo</th>
                     <th class="px-4 py-2 w-60">Quantidade</th>
                 </tr>
                </thead>
                <tbody class="bg-[#0F3A6D]">
                <?php foreach ($exibirDispositivos as $d): ?>
                <?php if($mostrarD == $d['venda_id']): ?>
                <tr>
                    <td class="border-t text-center px-4 py-2"><?=$d['nome']?></td>
                    <td class="border-t text-center px-4 py-2"><?=$d['quantidade']?></td>
                </tr>
                <?php endif; ?>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php foreach ($vendas as $venda): ?>
                <?php if($venda['id'] == $mostrarD): ?>
                <div class="bg-[#0F3A6D] w-[50%] text-center text-white">
                    <p class="p-2 bg-[#AFCBEB] font-bold">Nome</p>
                    <p class="border-t border-b p-2"><?=$venda['cliente']?></p>
                </div>
                <div class="bg-[#0F3A6D] w-[40%] text-center text-white">
                    <p class="p-2 bg-[#AFCBEB] font-bold">Plano</p>
                    <p class="border-t border-b p-2"><?=$venda['plano']?></p>
                </div>
                <?php endif;?>
            <?php endforeach; ?>
            <span onclick="document.getElementById('contDis').classList.add('hidden')" class=" bg-[#AFCBEB] px-4 py-2 border text-white font-bold"><a href="http://localhost:3001/vendas.php">X</a></span>
        </div>
        <?php endif; ?>
    </div>
</main>
<script>
</script>
</body>
</html>
