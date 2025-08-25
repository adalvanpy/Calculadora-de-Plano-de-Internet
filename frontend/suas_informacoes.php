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
<html>
<head>
    <meta charset="utf-8">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col items-center justify-start w-full h-screen">
<header class="flex text-blue-500 items-center flex-col justify-center h-30 w-full bg-[#cbdae2] p-4">
    <p class="text-4xl">Suas informações</p>
</header>
<main class="flex flex-col items-center justify-start w-full h-full">
    <svg viewBox="0 0 15 15" fill="#22c55e" class="w-40 h-20 animate-bounce mt-4">
        <path d="M10 10C9 10 9 11 9 11 9 12 10 12 10 12 11 12 11 11 11 11 11 11 11 10 10 10M7 10C9 7 11 7 13 10 13 10 13 11 12 11 11 9 9 9 8 11 8 11 7 11 7 10M5 8C9 4 11 4 15 8 15 9 15 9 14 9 11 6 9 6 6 9 5 9 5 9 5 8"/>
    </svg>
    <form  class="flex flex-col w-full p-8 gap-8 items-center justify-center mt-4" action="http://localhost:3000/contratacao.php" method="post">
        <input type="hidden" name="plano" value="<?= $plano ?>">
        <?php foreach ($disp_list as $i => $dispositivo):?>
            <input type="hidden" name="pesos[]" value="<?= $pesos[$i] ?>">
            <input type="hidden" name="qtd[]" value="<?= $qtd[$i] ?>">
            <input type="hidden" name="disList[]" value="<?= $dispositivo ?>">
        <?php endforeach;?>
        <input type="hidden" name="game" value="<?= $game ?>">
        <input type="hidden" name="pesototal" value="<?= $pesototal ?>">
        <input type="hidden" name="detalhe" value="<?= $detalhe ?>">
        <input class="w-[30%] py-4 px-4 border rounded-md" type="text" name="nome" id="nome" placeholder="Seu nome">
        <input class="w-[30%] py-4 px-4 border rounded-md" type="text" name="email" id="email" placeholder="Seu email">
        <input class="w-[30%] py-4 px-4 border rounded-md" type="text" name="telefone" placeholder="Seu telefone">

        <button class="w-[30%] py-4 px-4 bg-green-500 rounded-md text-white"  type="button" onclick="contratar()">Contratar</button>

        <div id="contratar" class="fixed text-white inset-0 m-auto hidden bg-[#1E64B7] w-[25%] p-4 h-80 border rounded-md flex flex-col items-center justify-start">
            <p class="text-4xl text-center mt-8">Deseja salvar o contrato?</p>
            <p class="text-xs mt-2 text-red-500">Após salvar, não será possível editar o contrato!</p>
            <div class="mt-20 flex gap-4">
                <input class="w-40 py-2 px-4 rounded-md text-white bg-green-500" type="submit" value="Salvar contrato">
                <button class="w-40 py-2 px-4  rounded-md text-white bg-red-500" type="button" onclick="cancelar()">Cancelar</button>
            </div>
        </div>
    </form>
</main>
</body>
<script>
    const nome = document.getElementById("nome");
    const email = document.getElementById("email");
    function contratar(){
        if(nome.value.trim() === ""){
            alert("Por favor, preencha todos os campos!");
            return;
        }
        if(!email.value.includes("@")){
            alert("E-mail invalido!");
            return;
        }
        document.getElementById("contratar").classList.remove("hidden");
    }
    function cancelar(){
        document.getElementById("contratar").classList.add("hidden");
    }
</script>
</html>
