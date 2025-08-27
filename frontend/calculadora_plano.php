<?php
$pesototal = $_GET["peso"] ?? null;
$qtd = json_decode($_GET["qtd"] ?? "[]") ?: [];
$disp_list = json_decode($_GET["disList"] ?? "[]") ?: [];
$pesos = json_decode($_GET["pesos"] ?? "[]") ?: [];
$game = $_GET["game"] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Calculadora de Planos</title>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
<header class="bg-[#cbdae2] shadow-md">
    <div class="max-w-7xl mx-auto py-6 px-4 text-center">
        <h1 class="text-3xl font-bold text-blue-600">Calculadora de Planos</h1>
    </div>
</header>

<main class="flex-grow flex flex-col items-center justify-start mt-8 px-4">
    <svg viewBox="0 0 15 15" fill="#22c55e" class="w-20 h-20 animate-bounce mb-6">
        <path d="M10 10C9 10 9 11 9 11 9 12 10 12 10 12 11 12 11 11 11 11 11 11 11 10 10 10M7 10C9 7 11 7 13 10 13 10 13 11 12 11 11 9 9 9 8 11 8 11 7 11 7 10M5 8C9 4 11 4 15 8 15 9 15 9 14 9 11 6 9 6 6 9 5 9 5 9 5 8"/>
    </svg>

    <form class="bg-white rounded-xl shadow-lg p-8 max-w-md w-full flex flex-col gap-6" action="http://localhost:3000/calculo.php" method="post">
        <?php
        $devices = ["celular" => "Celular", "computador" => "Computador", "smarttv" => "Smart TV", "tvbox" => "TV Box", "outros" => "Outros"];
        foreach($devices as $id => $label): ?>
            <div class="flex items-center justify-between gap-2">
                <label for="<?= $id ?>" class="text-gray-700 font-medium w-24"><?= $label ?></label>
                <div class="flex items-center gap-1">
                    <button type="button" class="bg-green-500 hover:bg-green-600 text-white rounded w-10 h-10" onclick="document.getElementById('<?= $id ?>').stepUp()">+</button>
                    <input type="number" id="<?= $id ?>" name="<?= $id ?>" value="0" class="w-20 text-center border rounded py-1 text-gray-800">
                    <button type="button" class="bg-red-500 hover:bg-red-600 text-white rounded w-10 h-10" onclick="document.getElementById('<?= $id ?>').stepDown()">-</button>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="flex items-center justify-between">
            <span class="text-gray-700 font-medium">Uso para games</span>
            <div id="pai" class="relative bg-gray-300 w-16 h-8 rounded-full cursor-pointer transition-colors">
                <input type="checkbox" name="game" id="game" class="hidden">
                <span id="filho" class="absolute top-1 left-1 w-6 h-6 bg-gray-500 rounded-full transition-all"></span>
            </div>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-lg transition-colors">Calcular Plano</button>
    </form>
</main>

<?php if(isset($pesototal) && $pesototal > 0): ?>
    <div id="planopai" class="fixed inset-0 w-full h-full bg-black/20 flex items-center justify-center p-4">
        <div id="corPlano" class="rounded-xl shadow-xl p-6 w-full max-w-sm flex flex-col items-center gap-4">
            <a href="http://localhost:3001/calculadora_plano.php" onclick="document.getElementById('planopai').classList.add('hidden')" class="self-start text-gray-600 hover:text-gray-800">
                &larr; Voltar
            </a>
            <form class="flex flex-col items-center gap-4 w-full" action="http://localhost:3001/suas_informacoes.php" method="post">
                <?php foreach ($disp_list as $i => $dispositivo): ?>
                    <input type="hidden" name="qtd[]" value="<?= $qtd[$i] ?>">
                    <input type="hidden" name="pesos[]" value="<?= $pesos[$i] ?>">
                    <input type="hidden" name="disList[]" value="<?= $dispositivo ?>">
                <?php endforeach; ?>
                <input type="hidden" name="game" value="<?= $game ?>">
                <input type="hidden" name="pesototal" value="<?= $pesototal ?>">

                <?php
                if($pesototal < 1.0){ $bg = "bg-gray-200 text-gray-800"; $plano="Plano Prata"; $vel="100Mb"; $valor="59,99";}
                elseif($pesototal <= 2.0){ $bg="bg-orange-700 text-white"; $plano="Plano Bronze"; $vel="300Mb"; $valor="99,99";}
                elseif($pesototal <= 3.0){ $bg="bg-yellow-500 text-white"; $plano="Plano Ouro"; $vel="500Mb"; $valor="109,99";}
                else{ $bg="bg-cyan-200 text-gray-800"; $plano="Plano Diamante"; $vel="800Mb"; $valor="129,99";}
                ?>
                <div class="w-full p-4 rounded-lg <?= $bg ?> flex flex-col items-center gap-2">
                    <input type="text" class="text-center <?= $bg ?> text-2xl font-semibold w-full" value="<?= $plano ?>" readonly>
                    <p class="text-4xl font-bold"><?= $vel ?></p>
                    <p class="text-xl"><strong>R$</strong> <?= $valor ?></p>
                    <p class="text-sm">mensal</p>
                </div>
                <input type="hidden" name="detalhe" value="Plano de internet <?= $plano ?> <?= $vel ?>, R$ <?= $valor ?> mensal">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded-lg">Contratar</button>
            </form>
        </div>
    </div>
<?php endif; ?>

<script>
    const pai = document.getElementById('pai');
    const filho = document.getElementById('filho');
    const checkbox = document.getElementById('game');

    pai.addEventListener('click', () => {
        checkbox.checked = !checkbox.checked;
        if(checkbox.checked){
            filho.classList.remove('left-1', 'bg-gray-500');
            filho.classList.add('right-1', 'bg-green-500');
            pai.classList.add('bg-green-200');
        } else {
            filho.classList.remove('right-1', 'bg-green-500');
            filho.classList.add('left-1', 'bg-gray-500');
            pai.classList.remove('bg-green-200');
        }
    });
</script>
</body>
</html>
