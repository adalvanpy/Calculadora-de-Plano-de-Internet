<?php
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Calculadora de Planos de Internet</title>
</head>
<body class="flex flex-col items-center justify-start w-full h-screen bg-[#E6F0FA]">
<header class="flex text-white items-center flex-col h-30 w-full bg-[#1E64B7] p-4">
    <p class="text-4xl">Login Admin</p>
</header>
<main class="flex flex-col items-center justify-start w-full h-full p-8">
    <form class=" border mt-20  border-blue-500 w-[50%] border flex flex-col items-center justify-center gap-4 p-8" action="http://localhost:3000/loginAdmin.php" method="post">
        <input class="w-80 py-3 px-4 border rounded-md" type="text" name="usuario" id="usuario" placeholder="Usuario">
        <input class="w-80 py-3 px-4 border rounded-md"  type="password" name="senha" id="senha" placeholder="Senha">
        <input class=" text-white w-80 py-3 px-4 bg-blue-500 rounded-md"  type="submit" value="Entrar">
    </form>
</main>
</body>
</html>
