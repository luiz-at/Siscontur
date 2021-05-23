<?php
    require_once("../modelo/Excursao.php");
    require_once("../persistencia/ExcursaoDAO.php");

    $nome_responsavel = $_POST["nome_responsavel"];
    $cpf_responsavel = $_POST["cpf_responsavel"];
    $numero_turistas = $_POST["numero_turistas"];
    $tipo_transporte = $_POST["transporte"];
    
    $pegaid = ExcursaoDAO::retornaId();
    if($pegaid == NULL)
    {
        $aux = "PSG00001";
    }
    else
    {
            $aux = "PSG";
            $id_em_string = $pegaid+1;
            $qtdCaracteres = strlen($id_em_string);

            for($i=3;$i<8-$qtdCaracteres;$i++)
            {
                $aux = $aux."0";
            }
            $aux = $aux.$id_em_string;            
    }


    $e = new Excursao($nome_responsavel,$cpf_responsavel,$numero_turistas,$tipo_transporte,$aux,NULL,NULL,NULL);
    ExcursaoDAO::registrar($e);
    
    header("location: ../index.php");
?>