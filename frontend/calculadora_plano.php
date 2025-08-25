<?php
$pesototal = $_GET["peso"] ?? null;
$qtd = json_decode($_GET["qtd"] ?? "[]") ?: [];
$disp_list = json_decode($_GET["disList"] ?? "[]") ?: [];
$pesos = json_decode($_GET["pesos"] ?? "[]") ?: [];
$game = $_GET["game"] ?? null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Calculadora de Planos de Internet</title>
</head>
<body class="flex flex-col items-center justify-start w-full h-screen">
<header class="flex text-blue-500 items-center justify-center h-30 w-full bg-[#cbdae2] p-4">
    <p class="text-4xl">Calculadora de Planos</p>
</header>
<main class="flex flex-col items-center justify-center w-full h-full">
    <svg viewBox="0 0 15 15" fill="#22c55e" class="w-40 h-20 animate-bounce mt-4">
        <path d="M10 10C9 10 9 11 9 11 9 12 10 12 10 12 11 12 11 11 11 11 11 11 11 10 10 10M7 10C9 7 11 7 13 10 13 10 13 11 12 11 11 9 9 9 8 11 8 11 7 11 7 10M5 8C9 4 11 4 15 8 15 9 15 9 14 9 11 6 9 6 6 9 5 9 5 9 5 8"/>
    </svg>
    <form class="bg-[#cbdae2] text-white rounded-md flex flex-col items-center justify-center gap-4 border p-12" action="http://localhost:3000/calculo.php" method="post">
        <div class="flex items-center justify-center gap-4">
            <p class="w-24 px-2 py-2" for="celular">Celular</p>
            <button class="rounded-md bg-green-500 text-white w-10 h-10" type="button" onclick="document.getElementById('celular').stepUp()">+</button>
            <input class="text-[#1E64B7] rounded-md  text-center w-32 px-2 py-2" value="0" type="number" name="celular" id="celular">
            <button class="rounded-md bg-red-500 text-white w-10 h-10" type="button" onclick="document.getElementById('celular').stepDown()">-</button>
        </div>
        <div class="flex items-center justify-center gap-4">
            <p class="w-24 px-2 py-2" for="computador">Computador</p>
            <button class="rounded-md bg-green-500 text-white w-10 h-10" type="button" onclick="document.getElementById('computador').stepUp()">+</button>
            <input  class="text-[#1E64B7] rounded-md text-center w-32 px-2 py-2" value="0" type="number" name="computador" id="computador">
            <button class="rounded-md bg-red-500 text-white w-10 h-10" type="button" onclick="document.getElementById('computador').stepDown()">-</button>
        </div>
        <div class="flex items-center justify-center gap-4">
            <p class="w-24 px-2 py-2" for="smarttv">Smart TV</p>
            <button class="rounded-md bg-green-500 text-white w-10 h-10" type="button" onclick="document.getElementById('smarttv').stepUp()">+</button>
            <input class="text-[#1E64B7] rounded-md text-center w-32 px-2 py-2" value="0" type="number" name="smarttv" id="smarttv">
            <button class="rounded-md bg-red-500 text-white w-10 h-10" type="button" onclick="document.getElementById('smarttv').stepDown()">-</button>
        </div>
        <div class="flex items-center justify-center gap-4">
            <p class="w-24 px-2 py-2" for="tvbox">TV Box</p>
            <button class="rounded-md bg-green-500 text-white w-10 h-10" type="button" onclick="document.getElementById('tvbox').stepUp()">+</button>
            <input class="text-[#1E64B7] rounded-md text-center w-32 px-2 py-2" value="0" type="number" name="tvbox" id="tvbox">
            <button class="rounded-md bg-red-500 text-white w-10 h-10" type="button" onclick="document.getElementById('tvbox').stepDown()">-</button>
        </div>
        <div class="flex items-center justify-center gap-4">
            <p class="w-24 px-2 py-2" for="outros">Outros</p>
            <button class="rounded-md bg-green-500 text-white w-10 h-10" type="button" onclick="document.getElementById('outros').stepUp()">+</button>
            <input class="text-[#1E64B7] rounded-md  text-center w-32 px-2 py-2" value="0" type="number" name="outros" id="outros">
            <button class="rounded-md bg-red-500 text-white w-10 h-10" type="button" onclick="document.getElementById('outros').stepDown()">-</button>
        </div>
        <div class="flex gap-4">
            <p>Uso de internet para game</p>
            <div id="pai" class="relative bg-gray-200 w-16 h-6 rounded-xl cursor-pointer">
              <input class="hidden" type="checkbox" name="game" id="game">
              <span id="filho" class="absolute -top-1 -left-1 w-8 h-8 bg-gray-500 rounded-full"></span>
            </div>
        </div>
        <input class="w-60 px-4 py-2 bg-green-500 rounded-md text-white" type="submit" value="CALCULAR PLANO">
    </form>
</main>

<?php if(isset($pesototal) && $pesototal > 0): ?>
    <div id="planopai" class="fixed inset-0 w-full h-full bg-gray-500/10 backdrop-blur-[1px] flex">
        <div id="corPlano" class=" w-[20%] h-auto m-auto p-4 rounded-md shadow-md">
            <a href="http://localhost:3001/calculadora_plano.php" onclick="document.getElementById('planopai').classList.add('hidden')" class=" cursor-pointer p-2 text-[#1E64B7] flex items-center">
                  <svg class="w-6 h-6"  stroke="currentColor" stroke-width="1.5"
                       stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 10 10">
                  <path d="M2 1 5 4 8 1 C9 1 9 1 9 2 L6 5
                   M6 5 9 8 C9 9 9 9 8 9 L5 6 2 9
                   C1 9 1 9 1 8 L4 5 1 2 C1 1 1 1 2 1"
                   />
                </svg>
            </a>
            <form class="flex flex-col items-center justify-center w-full p-4" action="http://localhost:3001/suas_informacoes.php" method="post">
                <?php foreach ($disp_list as $i => $dispositivo):?>
                <input type="hidden" name="qtd[]" value="<?= $qtd[$i] ?>">
                <input type="hidden" name="pesos[]" value="<?= $pesos[$i] ?>">
                <input type="hidden" name="disList[]" value="<?= $dispositivo ?>">
                <?php endforeach;?>
                <input type="hidden" name="game" value="<?= $game ?>">
                <input type="hidden" name="pesototal" value="<?= $pesototal ?>">
                <?php if($pesototal < 1.0): ?>
                     <script> document.getElementById('corPlano').classList.add('bg-[#e6e6e6]')</script>
                    <input class="text-[#1E64B7] mt-10 text-center text-3xl bg-[#e6e6e6]" value="Plano Prata" type="text" name="plano" id="planoPrata" readonly>
                    <p class="text-[#1E64B7] text-center text-6xl" >100Mb</p>
                    <p class="text-[#1E64B7] text-center text-2xl" ><strong>R$</strong> 59,99</p>
                    <p class="text-[#1E64B7] text-center text-lg" >mensal</p>
                    <input type="hidden" name="detalhe" value="Plano de internet Prata 100Mb, R$ 59,99 mensal">
                    <input class=" mt-10 bg-green-500 text-white px-4 py-2 rounded-md" type="submit" value="CONTRATAR">
                <?php elseif($pesototal >= 1.0 && $pesototal <= 2.0): ?>
                    <script> document.getElementById('corPlano').classList.add('bg-[#cd7f32]')</script>
                    <input class=" mt-10 text-white text-center text-3xl bg-[#cd7f32]"  value="Plano Bronze" type="text" name="plano" id="planoBronze" readonly>
                    <p class="text-center text-white text-6xl">300Mb</p>
                    <p class="text-center text-white text-2xl"><strong>R$</strong> 99,99</p>
                    <p class="text-center text-white text-lg">mensal</p>
                    <input type="hidden" name="detalhe" value="Plano de internet Bronze 300Mb, R$ 99,99 mensal">
                    <input class=" mt-10 bg-green-500 text-white px-4 py-2 rounded-md" type="submit" value="CONTRATAR">
                <?php elseif($pesototal > 2.0 && $pesototal <= 3.0): ?>
                    <script> document.getElementById('corPlano').classList.add('bg-[#ffd700]')</script>
                    <input class=" mt-10 text-white text-center text-3xl bg-[#ffd700]"  value="Plano Ouro" type="text" name="plano" id="planoOuro" readonly>
                    <p class="text-center text-white text-6xl">500Mb</p>
                    <p class="text-center text-white text-2xl"><strong>R$</strong> 109,99</p>
                    <p class="text-center text-white text-lg">mensal</p>
                    <input type="hidden" name="detalhe" value="Plano de internet Ouro 500Mb, R$ 109,99 mensal">
                    <input class=" mt-10 bg-green-500 text-white px-4 py-2 rounded-md" type="submit" value="CONTRATAR">
                <?php else: ?>
                    <script> document.getElementById('corPlano').classList.add('bg-[#b9f2ff]')</script>
                    <input class=" text-white mt-10 text-center text-3xl bg-[#b9f2ff]"  value="Plano Diamante" type="text" name="plano" id="planoDiamante" readonly>
                    <p class="text-white text-center text-6xl">800Mb</p>
                    <p class="text-white text-center text-2xl"><strong>R$</strong> 129,99</p>
                    <p class=text-white "text-center text-lg">mensal</p>
                    <input type="hidden" name="detalhe" value="Plano de internet Diamante 800Mb, R$ 129,99 mensal">
                    <input class=" mt-10 bg-green-500 text-white px-4 py-2 rounded-md" type="submit" value="CONTRATAR">
                <?php endif; ?>
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

        if (checkbox.checked) {
           filho.classList.remove('-left-1');
           filho.classList.add('-right-1', 'bg-green-500');
           pai.classList.add('bg-green-200');
        }
        else {
            filho.classList.remove('-right-1', 'bg-green-500');
            filho.classList.add('-left-1', 'bg-gray-500');
            pai.classList.remove('bg-green-200');
    }
    });
</script>
</body>
</html>
