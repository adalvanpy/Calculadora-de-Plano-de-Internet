<?php
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login Admin</title>
</head>
<body class="flex flex-col min-h-screen bg-gray-100">

<header class="flex items-center justify-center h-28 w-full bg-gradient-to-r from-blue-400 to-blue-600 shadow-md">
    <h1 class="text-3xl font-semibold text-white">Login Admin</h1>
</header>


<main class="flex flex-1 items-center justify-center p-6">
    <div class="bg-white w-full max-w-md p-8 rounded-2xl shadow-lg">

        <div class="flex justify-center mb-6">
            <svg viewBox="0 0 15 15" fill="#22c55e" class="w-20 h-20 animate-bounce">
                <path d="M10 10C9 10 9 11 9 11 9 12 10 12 10 12 11 12 11 11 11 11 11 11 11 10 10 10M7 10C9 7 11 7 13 10 13 10 13 11 12 11 11 9 9 9 8 11 8 11 7 11 7 10M5 8C9 4 11 4 15 8 15 9 15 9 14 9 11 6 9 6 6 9 5 9 5 9 5 8"/>
            </svg>
        </div>

        <form action="http://localhost:3000/loginAdmin.php" method="post" class="flex flex-col gap-4">
            <input
                    class="w-full py-3 px-4 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                    type="text" name="usuario" id="usuario" placeholder="Usuário" required>

            <input
                    class="w-full py-3 px-4 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                    type="password" name="senha" id="senha" placeholder="Senha" required>

            <button
                    type="submit"
                    class="w-full py-3 px-4 bg-blue-500 hover:bg-blue-600 transition rounded-md text-white font-medium shadow-md">
                Entrar
            </button>
        </form>
    </div>
</main>
</body>
</html>

