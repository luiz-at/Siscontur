<?php
    //pegando arquivos para trabalhar com excursao
    require_once("persistencia/ExcursaoDAO.php");
    require_once("modelo/Excursao.php");
    //pegando arquivos para trabalhar com chegada
    require_once("modelo/Chegada.php");
	require_once("persistencia/ChegadaDAO.php");
    class Funcoes{
    
    public static function calculaDiferencaDatas($d1,$d2)
    { 
        $data1 = date_create($d1);
        $data2 = date_create($d2);
        
        $diff=date_diff($data1,$data2);
        $diferenca = $diff->format("%a");
        return $diferenca;
    }

    public static function calculaTaxaTransporte($codigo_excursao)
    {   
          
        $excursao = ExcursaoDAO::buscaPorCodigoRegistro($codigo_excursao);

        $chegada = ChegadaDAO::buscaPorCodigoRegistro($excursao->id_chegada);

        switch ($chegada->tipo_estabelecimento)
        {
            case "CNPJ":
                if($tpTransporte == "Ônibus")
                {
                    $taxa = 300;
                } 
                elseif($tpTransporte == "Micro-ônibus")
                {
                    $taxa = 200;
                }
                else{
                    $taxa = 100;
                }
                break;

            case "CPF":
                if($tpTransporte == "Ônibus")
                {
                    $taxa = 400;
                } 
                elseif($tpTransporte == "Micro-ônibus")
                {
                    $taxa = 300;
                }
                else{
                    $taxa = 180;
                }
                break;    
            
            case "OUTR":
                if($tpTransporte == "Ônibus")
                {
                    $taxa = 1500;
                } 
                elseif($tpTransporte == "Micro-ônibus")
                {
                    $taxa = 1000;
                }
                else{
                    $taxa = 5000;
                }
                break; 
        }

        return $taxa;
    }

    public static function atualizaTaxaPorAlteracaoExcursao($idChegada,$idPartida,$tpTransporte)
    {
        $chegada = ChegadaDAO::buscaPorCodigoRegistro($id_chegada);

        $tpEstabelecimento = $chegada->tipo_estabelecimento;

        switch ($tpEstabelecimento)
        {
            case "CNPJ":
                if($tpTransporte == "Ônibus")
                {
                    $taxa = 300;
                } 
                elseif($tpTransporte == "Micro-ônibus")
                {
                    $taxa = 200;
                }
                else{
                    $taxa = 100;
                }
                break;

            case "CPF":
                if($tpTransporte == "Ônibus")
                {
                    $taxa = 400;
                } 
                elseif($tpTransporte == "Micro-ônibus")
                {
                    $taxa = 300;
                }
                else{
                    $taxa = 180;
                }
                break;    
            
            case "OUTRO":
                if($tpTransporte == "Ônibus")
                {
                    $taxa = 1500;
                } 
                elseif($tpTransporte == "Micro-ônibus")
                {
                    $taxa = 1000;
                }
                else{
                    $taxa = 5000;
                }
                break;

            $novaTaxa = $taxa;

            PartidaDAO::atualizaTaxaPartida($idPartida,$taxa);
        }
    }

}

?>