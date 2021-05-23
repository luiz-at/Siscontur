<?php   
    require_once("persistencia/ExcursaoDAO.php");
    require_once("modelo/Excursao.php");

    require_once("persistencia/ChegadaDAO.php");
    require_once("modelo/Chegada.php");

    require_once("persistencia/PartidaDAO.php");
    require_once("modelo/Partida.php");

    $excursoesNaCidade = ExcursaoDAO::listaExcursoesNaCidade();
    $excursoesForaDaCidade = ExcursaoDAO::listaExcursoesForaDaCidade();


?>

<script type="text/javascript">
    function Nova()
    {
        location.href="index.php"
    }
</script>

<script type="text/javascript">
 
    var visibilidade = true; 
 
    function exibirbt1(){        
        /* if(visibilidade){
            document.getElementById("conteudo1").style.display = "none";
            document.getElementById("conteudo2").style.display = "none"; 
            visibilidade = false;
        }else {
            document.getElementById("conteudo1").style.display = "block";
            visibilidade = true;
        } */
        document.getElementById("conteudo2").style.display = "none";
        document.getElementById("conteudo1").style.display = "block";
    }

    function exibirbt2(){        
        /* if(visibilidade){
            document.getElementById("conteudo2").style.display = "none";
            document.getElementById("conteudo1").style.display = "none"; 
            visibilidade = false;
        }else {
            document.getElementById("conteudo2").style.display = "block";            
            visibilidade = true;
        } */
        document.getElementById("conteudo1").style.display = "none";  
        document.getElementById("conteudo2").style.display = "block";  
    }
</script>

<html>
    <head>
        <title>Relatorio</title>
		<meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style/p_exibe_relatorio.css">	
    </head>
    <body>
        <div id="base">
            <div id="titulo">
                <h1 id="txtTitulo">RELATÓRIO</h1>
            </div>           

            <div id="espacoBotoes">
                <input id="bt1" type="button" value="EXCURSÕES NA CIDADE" onClick="exibirbt1()">
                <input id="bt2" type="button" value="EXCURSÕES QUE PARTIRAM" onClick="exibirbt2()">
            </div>            

            <div id="espacoConteudo">
                <div id="conteudo1">
                    <div id="barracima">
                        <p id="txt_barracima">EXCURSÕES NA CIDADE</p>
                    </div>
                    <table id=tabelaRelatorio1>
                        
                        <tr>
                            <th>CÓDIGO</th>   
                            <th>RESPONSÁVEL</th>  
                            <th>N° TURISTAS</th>  
                            <th>TRANSPORTE</th>  
                            <th>DATA CHEGADA</th> 
                            <th>CIDADE DE ORIGEM</th>      
                        </tr> 
                        
                    <?php foreach($excursoesNaCidade as $e){ 
                        $chegada = ChegadaDAO::buscaPorCodigoRegistro($e->id_chegada); 
                    ?>
                        <tr>
                            <td><?php echo $e->codigo_registro; ?></td>
                            <td><?php echo $e->nome_responsavel; ?></td>
                            <td><?php echo $e->numero_turistas; ?></td>
                            <td><?php echo $e->tipo_transporte; ?></td> 
                            <td><?php echo $chegada->data_chegada; ?></td>
                            <td><?php echo $chegada->cidade_origem; ?></td>
                        </tr>
                    <?php }                                   ?>
                    
                    </table>
                </div>

                <div id="conteudo2">                    
                    <div id="barracima2">
                        <p id="txt_barracima2">EXCURSÕES QUE PARTIRAM</p>
                    </div>
                    <table id=tabelaRelatorio2>
                        <tr>
                            <th>CÓDIGO</th>   
                            <th>RESPONSÁVEL</th>  
                            <th>N° TURISTAS</th>  
                            <th>TRANSPORTE</th>  
                            <th>DATA CHEGADA</th> 
                            <th>CIDADE DE ORIGEM</th>    
                            <th>DATA PARTIDA</th> 
                            <th>TAXA PAGA</th>    
                        </tr>  

                    <?php foreach($excursoesForaDaCidade as $e){ 
                        $chegada = ChegadaDAO::buscaPorCodigoRegistro($e->id_chegada); 
                        $partida = PartidaDAO::buscaPorCodigoRegistro($e->id_partida);
                    ?>
                        <tr>
                            <td><?php echo $e->codigo_registro; ?></td>
                            <td><?php echo $e->nome_responsavel; ?></td>
                            <td><?php echo $e->numero_turistas; ?></td>
                            <td><?php echo $e->tipo_transporte; ?></td> 
                            <td><?php echo $chegada->data_chegada; ?></td>
                            <td><?php echo $chegada->cidade_origem; ?></td>
                            <td><?php echo $partida->data_saida; ?></td>
                            <td><?php echo $partida->valor_taxa_pago; ?></td>
                        </tr>
                    <?php }                                   ?>
                    </table> 
                </div>               
            </div>
            <input id="btVoltar" type="button" value="VOLTAR" onClick="Nova()">        
        <div>
        
    </body>
</html>