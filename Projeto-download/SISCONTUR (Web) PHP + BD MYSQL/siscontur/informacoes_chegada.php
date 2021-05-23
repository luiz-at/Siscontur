<?php
    require_once("persistencia/ChegadaDAO.php");
    require_once("modelo/Chegada.php");

    $i = $_GET["id"];    
    $c = ChegadaDAO::buscaPorCodigoRegistro($i); 
    
    if($c != null){
        $data_chegada = date("d-m-Y", strtotime($c->data_chegada));
        $data_provavel_retorno = date("d-m-Y", strtotime($c->data_provavel_retorno));
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
        <link rel="stylesheet" type="text/css" href="style/p_informacoes_chegada.css">
    </head>
    <body>  
        <div id="base">

                <div id="tituloPagina">
                    <h1 id="textoTituloPagina">INFORMAÇÕES DA CHEGADA</h1>
                </div>  

                <div id="conteudoPagina">
                <?php if($c == NULL)
                      {?>
                        <h1 id="excecaoChegadaNaoRegistrada"><?php echo "CHEGADA NÃO REGISTRADA";?></h1>                        
                <?php }else{?>                        
                            <div id="conteudoDescricao">
                                <p>Data da Chegada:</p>
                                <p>Data provável de retorno:</p>
                                <p>Quantidade total de pessoas:</p>
                                <p>Cidade de origem:</p>
                                <p>Tipo de estabelecimento:</p>
                            </div>
                            <div id="conteudoConteudo">
                                <p class="conteudo"> <?php echo $data_chegada;?> </p>
                                <p class="conteudo"> <?php echo $data_provavel_retorno;?> </p>
                                <p class="conteudo"> <?php echo $c->qtd_total_pessoas;?> </p>
                                <p class="conteudo"> <?php echo $c->cidade_origem;?> </p>
                                <p class="conteudo"> <?php echo $c->tipo_estabelecimento;?> </p>
                            </div>
                     <?php }?>
                </div>
                <input id="btVoltar" type="button" value="VOLTAR" onClick="Nova()">
        </div>    
    </body>
</html>