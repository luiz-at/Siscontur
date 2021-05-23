<?php
    require_once("persistencia/MultaDAO.php");
    require_once("modelo/Multa.php");

    $cod = $_GET["id"];
    $multa = MultaDAO::buscaPorCodigoRegistro($cod);  
    if($multa != null)
    {
        $multa_formatada = number_format($multa->valor_multa,2,',','');
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
        <link rel="stylesheet" type="text/css" href="style/p_informacoes_multa.css">
    </head>
    <body>
        <div id="base">            
            <div id="tituloPagina">
                <h1 id="textoTituloPagina">INFORMAÇÕES DA MULTA</h1>
            </div>
                    <div id="conteudoPagina">
                    <?php if($multa == NULL)
                           {?>
                                <h1 id="excecaoMultaNaoRegistrada"><?php echo "MULTA NÃO REGISTRADA";?></h1>                        
                <?php }else{?> 
                                <div id="conteudoDescricao">
                                    <p>Valor da multa:</p>
                                </div>
                                <div id="conteudoConteudo">
                                    <p class="conteudo"><?php echo $multa_formatada?></p>
                                </div>
                     <?php }?>
                    </div>            
            <input id="btVoltar" type="button" value="VOLTAR" onClick="Nova()">
        </div>
    </body>
</html>
