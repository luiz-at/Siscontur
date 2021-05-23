<?php
    session_start();
    
    //importando as classes necessarias
    require_once("../persistencia/ExcursaoDAO.php");
    require_once("../persistencia/ChegadaDAO.php");
    require_once("../modelo/Chegada.php");

    //recebendo dados do formulario da pag "pag_registra_chegada" e armazenando em variaveis
    $data_chegada = $_POST["data_chegada"];
    $data_provavel_retorno = $_POST["dt"];
    $quantidade_total_pessoas = $_POST["qtd_pessoas"];
    $cidade_origem = $_POST["cidade_origem"];
    $tipo_estabelecimento = $_POST["estabelecimento"];
    
    //substituindo nas variaveis que armazenam datas o caractere "/" por "-" para salvar no banco
    str_replace("/","-",$data_chegada);
    str_replace("/","-",$data_provavel_retorno);      

    /*criando um objeto do tipo chegada e passando como parametro as variaveis que contem os dados do 
    formulario*/
    $ch = new Chegada($data_chegada,$data_provavel_retorno,$quantidade_total_pessoas,
                      $cidade_origem,$tipo_estabelecimento);
    
    //salvando no banco de dados a chegada
    ChegadaDAO::registraChegada($ch);


    //pegando id da chegada registrada para atribuir ao codigo da excursao digitado
    $id_ultima_chegada = ChegadaDAO::retornaIdChegada();

    /*pegando o cogido da excursao que deve ser registrada a chegada, 
    obtida pelo usuario ao entrar na pag "pagina_registra_chegada"*/
    $codigo_excursao_chegada = $_SESSION["valor"];

    //atribuindo o id da chegada registrada ao codigo da excursao informado pelo usuario
    ExcursaoDAO::cadastraIdChegada($id_ultima_chegada,$codigo_excursao_chegada);


    //volta para pagina inicial
    header("location: ../index.php");

?>