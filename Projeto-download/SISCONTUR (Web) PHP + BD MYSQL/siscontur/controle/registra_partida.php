<?php
    session_start();
    //pegando arquivos para trabalhar com "ExcursaoDAO"
    require_once("../persistencia/ExcursaoDAO.php");
	//pegando arquivos para trabalhar com "Partida" e "PardidaDAO"
 	require_once("../modelo/Partida.php");
	require_once("../persistencia/PartidaDAO.php");

    $data_partida = $_POST["data_partida"];
    $ocorrencias = $_POST["ocorrencias"];
    $taxa = $_SESSION["taxa_paga"];
    
    str_replace("/","-",$data_partida);
    
    $p = new Partida($data_partida,$ocorrencias,$taxa);
    
    PartidaDAO::registraPartida($p);
    
    $id_ultima_partida = PartidaDAO::retornaIdPartida();    
    
    ExcursaoDAO::cadastraIdPartida($id_ultima_partida,$_SESSION["codigo_partida_buscado"]);

    header("location: ../index.php");




?>