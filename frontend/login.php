<?php
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Calculadora de Planos de Internet</title>
</head>
<body class="flex flex-col items-center justify-start w-full h-screen">
<header class="flex text-blue-500 items-center flex-col h-30 w-full bg-[#cbdae2] p-4">
    <p class="text-4xl">Login Admin</p>
</header>
<main class="flex flex-col items-center justify-start w-full h-full p-8">
    <svg viewBox="0 0 15 15" fill="#22c55e" class="w-40 h-20 animate-bounce mt-4">
        <path d="M10 10C9 10 9 11 9 11 9 12 10 12 10 12 11 12 11 11 11 11 11 11 11 10 10 10M7 10C9 7 11 7 13 10 13 10 13 11 12 11 11 9 9 9 8 11 8 11 7 11 7 10M5 8C9 4 11 4 15 8 15 9 15 9 14 9 11 6 9 6 6 9 5 9 5 9 5 8"/>
    </svg>
    <form class=" border mt-20  shadow-md w-[30%] border flex flex-col items-center justify-center gap-4 p-8" action="http://localhost:3000/loginAdmin.php" method="post">
        <input class="w-80 py-3 px-4 border rounded-md" type="text" name="usuario" id="usuario" placeholder="Usuario">
        <input class="w-80 py-3 px-4 border rounded-md"  type="password" name="senha" id="senha" placeholder="Senha">
        <input class=" text-white w-80 py-3 px-4 bg-blue-500 rounded-md"  type="submit" value="Entrar">
    </form>
</main>
</body>
</html>
