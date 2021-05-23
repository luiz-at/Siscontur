<?php

    require_once("../modelo/Chegada.php");
    require_once("../persistencia/ChegadaDAO.php");

    $idChegada = $_POST['id_chegada'];
    $dataChegada = $_POST['dt_chegada'];
    $dataProvavelRetorno = $_POST['dt_provavel_retorno'];
    $qdtTotalPessoas = $_POST['qtd_total_pessoas'];
    $cidadeOrigem = $_POST['cidade_origem'];
    $estabelecimento = $_POST['estabelecimento'];
    
    ChegadaDAO::atualizainformacoes($idChegada,$dataChegada,$dataProvavelRetorno,$qdtTotalPessoas,
                                    $cidadeOrigem,$estabelecimento); 

?>