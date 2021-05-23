<?php
    require_once("../modelo/Partida.php");
    require_once("../persistencia/PartidaDAO.php");

    $codigo = $_POST['id_partida'];
    $dataPartida = $_POST['dt_partida'];
    $ocorrencias = $_POST['ocorrencias'];

    PartidaDAO::atualizainformacoes($codigo,$dataPartida,$ocorrencias);
?>