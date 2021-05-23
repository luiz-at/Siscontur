<?php
    require_once("persistencia/PartidaDAO.php");
    require_once("modelo/Partida.php");

    $cod = $_GET["id"];     
    $partida = PartidaDAO::buscaPorCodigoRegistro($cod);
    
    if($partida != null){
        $data_partida = date("d-m-Y", strtotime($partida->data_saida));        
    }  

?>

<script type="text/javascript">
function Nova()
{
    location.href="pag_exibe_excursoes.php"
}
</script>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style/p_informacoes_partida.css">
    </head>
    <body>
        <div id="base">
            <div id=tituloPagina>
                <h1 id="textoTituloPagina">INFORMAÇÕES DA PARTIDA</h1>
            </div>

                <div id="conteudoPagina">
                <?php if($partida == NULL)
                      {?> 
                      <h1 id="excecaoPartidaNaoRegistrada"><?php echo "PARTIDA NÃO REGISTRADA";?></h1>                        
                <?php }else{?> 
                            <div id="conteudoDescricao">
                                <p>Data da partida:</p>
                                <p>Ocorrências:</p>
                                    <div id="campoValorTaxa">
                                        <p>Valor da taxa pago:</p>
                                    </div>
                            </div>
                            <div id="conteudoConteudo">
                                <p class="conteudo"><?php echo $data_partida?></p>                    
                                <p id="campoOcorrencias" class="conteudo"><?php echo $partida->ocorrencias?></p>                    
                                <p class="conteudo"><?php echo number_format($partida->valor_taxa_pago,2,',','');?></p> 
                            </div>
                        <?php }?>
                    </div>

            <input id="btVoltar" type="button" value="VOLTAR" onClick="Nova()">          
        </div>
    </body>

</html>