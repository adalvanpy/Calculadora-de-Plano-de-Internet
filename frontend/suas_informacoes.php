<?php
$plano = $_POST["plano"] ?? null;
$qtd = $_POST["qtd"] ?? null;
$disp_list = $_POST["disList"] ?? null;
$pesos = $_POST["pesos"] ?? null;
$game = $_POST["game"] ?? null;
$pesototal = $_POST["pesototal"] ?? null;
$detalhe = $_POST["detalhe"] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Suas informações</title>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
<header class="bg-[#cbdae2] shadow-md">
    <div class="max-w-4xl mx-auto py-6 px-4 text-center">
        <h1 class="text-3xl font-bold text-blue-600">Suas informações</h1>
    </div>
</header>

<main class="flex-grow flex flex-col items-center justify-start mt-8 px-4">
    <svg viewBox="0 0 15 15" fill="#22c55e" class="w-20 h-20 animate-bounce mb-6">
        <path d="M10 10C9 10 9 11 9 11 9 12 10 12 10 12 11 12 11 11 11 11 11 11 11 10 10 10M7 10C9 7 11 7 13 10 13 10 13 11 12 11 11 9 9 9 8 11 8 11 7 11 7 10M5 8C9 4 11 4 15 8 15 9 15 9 14 9 11 6 9 6 6 9 5 9 5 9 5 8"/>
    </svg>

    <form class="bg-white shadow-lg rounded-xl p-8 max-w-lg w-full flex flex-col gap-6"
          action="http://localhost:3000/contratacao.php" method="post">

        <input type="hidden" name="plano" value="<?= $plano ?>">
        <?php foreach ($disp_list as $i => $dispositivo): ?>
            <input type="hidden" name="pesos[]" value="<?= $pesos[$i] ?>">
            <input type="hidden" name="qtd[]" value="<?= $qtd[$i] ?>">
            <input type="hidden" name="disList[]" value="<?= $dispositivo ?>">
        <?php endforeach; ?>
        <input type="hidden" name="game" value="<?= $game ?>">
        <input type="hidden" name="pesototal" value="<?= $pesototal ?>">
        <input type="hidden" name="detalhe" value="<?= $detalhe ?>">

        <div>
            <label for="nome" class="block text-gray-700 font-medium">Nome</label>
            <input class="mt-1 w-full py-3 px-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   type="text" name="nome" id="nome" placeholder="Seu nome">
        </div>

        <div>
            <label for="email" class="block text-gray-700 font-medium">Email</label>
            <input class="mt-1 w-full py-3 px-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   type="text" name="email" id="email" placeholder="Seu email">
        </div>

        <div>
            <label for="telefone" class="block text-gray-700 font-medium">Telefone</label>
            <input class="mt-1 w-full py-3 px-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   type="text" name="telefone" id="telefone" placeholder="Seu telefone">
        </div>

        <button class="w-full py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg transition-colors"
                type="button" onclick="contratar()">Contratar</button>

        <div id="contratar"
             class="fixed inset-0 hidden bg-black/40 backdrop-blur-sm flex items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-xl p-8 w-full max-w-md text-center flex flex-col gap-6">
                <h2 class="text-2xl font-bold text-blue-700">Deseja salvar o contrato?</h2>
                <p class="text-sm text-red-500">Após salvar, não será possível editar o contrato!</p>

                <div class="flex justify-center gap-4 mt-6">
                    <input class="w-40 py-2 px-4 rounded-lg text-white bg-green-600 hover:bg-green-700 transition-colors"
                           type="submit" value="Salvar contrato">
                    <button class="w-40 py-2 px-4 rounded-lg text-white bg-red-500 hover:bg-red-600 transition-colors"
                            type="button" onclick="cancelar()">Cancelar</button>
                </div>
            </div>
        </div>
    </form>
</main>

<script>
    const nome = document.getElementById("nome");
    const email = document.getElementById("email");

    function contratar(){
        if(nome.value.trim() === "" || email.value.trim() === ""){
            alert("Por favor, preencha todos os campos!");
            return;
        }
        if(!email.value.includes("@")){
            alert("E-mail inválido!");
            return;
        }
        document.getElementById("contratar").classList.remove("hidden");
    }

    function cancelar(){
        document.getElementById("contratar").classList.add("hidden");
    }
</script>
</body>
</html>

