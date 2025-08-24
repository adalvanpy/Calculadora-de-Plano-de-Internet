<?php
$pesototal = 0;
$qtd = [];
$disp_list = [];
$pesos = [];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $celular = (float)($_POST["celular"] ?? 0);
    $computador = (float)($_POST["computador"] ?? 0);
    $smarttv = (float)($_POST["smarttv"] ?? 0);
    $tvbox = (float)($_POST["tvbox"] ?? 0);
    $outros = (float)($_POST["outros"] ?? 0);

    $pesototal += $celular * 0.8;
    if($celular > 0){
        $disp_list[] = "Celular";
        $qtd[] = $celular;
        $pesos[] = $celular * 0.8;
    }

    $pesototal += $computador * 0.5;
    if($computador > 0){
        $disp_list[] = "Computador";
        $qtd[] = $computador;
        $pesos[] = $computador * 0.5;
    }

    $pesototal += $smarttv * 0.4;
    if($smarttv > 0){
        $disp_list[] = "Smart TV";
        $qtd[] = $smarttv;
        $pesos[] = $smarttv * 0.4;
    }

    $pesototal += $tvbox * 0.6;
    if($tvbox > 0){
        $disp_list[] = "TV Box";
        $qtd[] = $tvbox;
        $pesos[] = $tvbox * 0.6;
    }

    $pesototal += $outros * 0.1;
    if($outros > 0){
        $disp_list[] = "Outros";
        $qtd[] = $outros;
        $pesos[] = $outros * 0.1;
    }
    $game = isset($_POST["game"]);
    if($game){
        $pesototal *= 2;
        $game = true;
    }
    else{
        $game = false;
    }
    $disp_list = urlencode(json_encode($disp_list));
    $qtd = urlencode(json_encode($qtd));
    $pesos = urlencode(json_encode($pesos));
}
header("Location: http://localhost:3001/calculadora_plano.php?peso=$pesototal&qtd=$qtd&game=$game&disList=$disp_list&pesos=$pesos");
exit;

?>

