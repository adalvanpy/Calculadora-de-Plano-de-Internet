<?php
include __DIR__ . '/database/conexao.php';
include __DIR__ . '/crud/CriarVendas.php';



$vender = new CriarVendas($conexao);
$criar_dispositivo = new CriarVendas($conexao);

$plano = "";
$nome = "";
$email = "";
$list_disp = [];
$qtd = [];
$pesos = [];
$contrato = [];
$pesototal = 0;
$detalhe = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $pesototal = $_POST['pesototal'];
    $plano = $_POST['plano'];
    $qtd = $_POST['qtd'];
    $list_disp = $_POST['disList'];
    $game = $_POST['game'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $pesos = $_POST['pesos'];
    $data = new DateTime();
    $data = $data->format('Y-m-d');
    $detalhe = $_POST['detalhe'];



    $id_venda = $vender->criarVenda($nome,$email,$telefone,$plano,$data,$game,'Dispositivo');

    foreach ($list_disp as $i => $dispositivo) {
        $criar_dispositivo->criarDispositivo($dispositivo,$qtd[$i],$id_venda);
        $contrato[] = "Dispositivo: " . $dispositivo . " quantidade: " . $qtd[$i] ." peso: " . $pesos[$i] . "<br>";
    }
}
$contrato[] = "Peso total ". $pesototal;

require __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = $_ENV['SMTP_USER'];
    $mail->Password   = $_ENV['SMTP_PASS'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom($_ENV['SMTP_USER'], 'Desafio Miks');
    $mail->addAddress($email, $nome);
    $mail->addAddress('operacoes@micks.com');

    $mail->isHTML(true);
    $mail->Subject = 'Plano Internet';

    $mail->Body = "Olá $nome, você acaba de contratar o $detalhe!<br>
                   Detalhes do plano: " . implode(",", $contrato) . "<br>
                   Agradecemos pela preferência.";

    $mail->send();

    header('location: http://localhost:3001/calculadora_plano.php');
    exit();
} catch (Exception $e) {
    echo "Falha ao enviar e-mail: {$mail->ErrorInfo}";
}
