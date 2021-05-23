<?php
        require_once("../persistencia/ExcursaoDAO.php");
        require_once("../modelo/Excursao.php");

        require_once("../persistencia/ChegadaDAO.php");
        require_once("../modelo/Chegada.php");

        require_once("../persistencia/PartidaDAO.php");
        require_once("../modelo/Partida.php");
        

        $codigo = $_POST['cd_registro'];
        $nome = $_POST['nome_responsavel'];
        $cpf = $_POST['cpf_responsavel'];
        $nturisstas = $_POST['n_turistas'];
        $tiptransporte = $_POST['transporte'];        

        ExcursaoDAO::atualizainformacoes($codigo,$nome,$cpf,$nturisstas,$tiptransporte);

        /*ATUALIZANDO VALOR DA TAXA*/
        $excursaoAtual = ExcursaoDAO::buscaPorCodigoRegistro($codigo); //PEGANDO INFORMACOES DA EXCURSAO ATUAL

        //$id_chegada = ; //PEGANDO ID DA CHEGADA DA EXCURSAO ATUAL

        $chegada = ChegadaDAO::buscaPorCodigoRegistro($excursaoAtual->id_chegada); //PEGANDO INFORMACOES DA CHEGADA DA EXCURSAO ATUAL

        
        //$tpEstabelecimento =; //PEGANDO E ARMAZENANDO INFOEMACAO DO TIPO DE ESTABELECIMENTO DA CHEGADA DA EXCURSAO ATUAL

        /*CALCULANDO NOVA TAXA COM BASE NAS INFORMACOES ATUALIZADAS*/
        switch ($chegada->tipo_estabelecimento)
        {
            case "CNPJ":
                if($tiptransporte == "Ônibus")
                {
                    $taxa = 300;
                } 
                elseif($tiptransporte == "Micro-ônibus")
                {
                    $taxa = 200;
                }
                else{
                    $taxa = 100;
                }
                break;

            case "CPF":
                if($tiptransporte == "Ônibus")
                {
                    $taxa = 400;
                } 
                elseif($tiptransporte == "Micro-ônibus")
                {
                    $taxa = 300;
                }
                else{
                    $taxa = 180;
                }
                break;    
            
            case "OUTRO":
                if($tiptransporte == "Ônibus")
                {
                    $taxa = 1500;
                } 
                elseif($tiptransporte == "Micro-ônibus")
                {
                    $taxa = 1000;
                }
                else{
                    $taxa = 5000;
                }
                break;
        }
            $novaTaxa = $taxa; //GUARDANDO NOVO VALOR DA TAXA           

            PartidaDAO::atualizaTaxaPartida($idPartida,$taxa); //ATUALIZANDO VALOR DA TAXA  
?>