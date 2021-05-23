<?php    
        require_once("persistencia/ExcursaoDAO.php");
        require_once("modelo/Excursao.php");
        require_once("persistencia/ChegadaDAO.php");
        require_once("modelo/Chegada.php");
        require_once("persistencia/PartidaDAO.php");
        require_once("modelo/Partida.php");
        require_once("persistencia/MultaDAO.php");
        require_once("modelo/Multa.php");

    $cod = $_GET["id"];

    $info_excursoes = ExcursaoDAO::buscaPorCodigoRegistro($cod);      
    $info_chegada = ChegadaDAO::buscaPorCodigoRegistro($info_excursoes->id_chegada);
    $info_partida = PartidaDAO::buscaPorCodigoRegistro($info_excursoes->id_partida);
    $info_multa = MultaDAO::buscaPorCodigoRegistro($info_excursoes->id_multa);
?>

<script type="text/javascript">
function Nova(){
    location.href="pag_exibe_excursoes.php"
}
</script>

<html>
    <head>
        <meta charset="utf-8">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>       
        <link rel="stylesheet" type="text/css" href="style/p_edita_informacoes.css">        	
        <script type="text/javascript">  
            jQuery(document).ready(function(){
		        jQuery('#inf_exc').submit(function(){			        
                        var dados = jQuery( this ).serialize();
                        jQuery.ajax({
                            type: "POST",
                            url: "controle/at_info_excursao.php",
                            data: dados,
                            success: function( data )
                            {
                                alert("Dados Atualizados");
                            }
                        });			
			        return false;
                });
                jQuery('#inf_chegada').submit(function(){			        
                        var dados = jQuery( this ).serialize();
                        jQuery.ajax({
                            type: "POST",
                            url: "controle/at_info_chegada.php",
                            data: dados,
                            success: function( data )
                            {
                                alert("Dados Atualizados");
                            }
                        });			
			        return false;
                });
                jQuery('#inf_partida').submit(function(){			        
                        var dados = jQuery( this ).serialize();
                        jQuery.ajax({
                            type: "POST",
                            url: "controle/at_info_partida.php",
                            data: dados,
                            success: function( data )
                            {
                                alert("Dados Atualizados");
                            }
                        });			
			        return false;
		        });
	        });                
        </script>    
    </head>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
    <script>
            $(document).ready(function () { 
            var $meuCamp = $("#cpf_responsavel");
            $meuCamp.mask('000.000.000-00');
        });
    </script>
    <body>
        <div id="corpo">
            <div id="barracima">
                <p id="txt_barracima">EDITAR</p>
            </div>
                <div id="infoExcursao">
                            <h1 class="titulo"> 
                                INFORMAÇÕES DA EXCURSÃO  
                            </h1> 

                            <form id="inf_exc" method="post"  action="#"> 
                            <p>
                                <div class="textosFormulario"><label id="txt1" class="textos" for="nome">Código de registro</label></div>
                                <div class="inputsFormulario"><input  style="text-align: center;" readonly="true" size="15" type="text" id="cd_registro" name="cd_registro" value="<?php echo $info_excursoes->codigo_registro;?>"></div>
                            </p>  

                            <p>
                                <div class="textosFormulario"><label id="txt1" class="textos" for="nome">Nome do responsável</label></div>
                                <div class="inputsFormulario"><input style="padding-left: 10px;" size="30" type="text" name="nome_responsavel" id="nome_responsavel" value="<?php echo $info_excursoes->nome_responsavel;?>"></div>
                            </p>
                            <p>
                                <div class="textosFormulario"><label id="txt1" class="textos" for="nome">CPF do responsável</label></div>
                                <div class="inputsFormulario"><input style="text-align: center;" size="14" type="text" readonly="true" class="form-control" name="cpf_responsavel" id="cpf_responsavel" value="<?php echo $info_excursoes->cpf_responsavel;?>"></div>
                            </p>
                            <p>
                                <div class="textosFormulario"><label id="txt3" class="textos" for="nome">Número de turistas</label></div>
                                <div class="inputsFormulario"><input style="padding-left: 10px;" type="number"  name="n_turistas" id="n_turistas" value="<?php echo $info_excursoes->numero_turistas;?>"></div>
                            </p>
                            <p>                                
                                <?php 
                                    switch($info_excursoes->tipo_transporte)
                                    {
                                        case "Ônibus" : ?>
                                            <div class="textosFormulario"><label for="transporte">Tipo de transporte </label></div>
                                            <div class="inputsFormulario">
                                                <select id="tp_transporte" name="transporte">
                                                    <option value="Ônibus" selected>Ônibus</option>
                                                    <option value="Vans e similares">Vans e similares</option>
                                                    <option value="Micro-ônibus">Micro-ônibus</option>
                                                </select>
                                            </div>
                                  <?php break;
                                        case "Vans e similares" : ?>
                                            <div class="textosFormulario"><label for="transporte">Tipo de transporte </label></div>
                                            <div class="inputsFormulario">
                                                <select id="tp_transporte" name="transporte">
                                                    <option value="Ônibus">Ônibus</option>
                                                    <option value="Vans e similares" selected>Vans e similares</option>
                                                    <option value="Micro-ônibus">Micro-ônibus</option>
                                                </select>  
                                            </div> 
                                <?php break;
                                      case "Micro-ônibus" : ?>
                                            <div class="textosFormulario"><label for="transporte">Tipo de transporte </label></div>
                                            <div class="inputsFormulario">
                                                <select id="tp_transporte" name="transporte">
                                                    <option value="Ônibus">Ônibus</option>
                                                    <option value="Vans e similares">Vans e similares</option>
                                                    <option value="Micro-ônibus" selected>Micro-ônibus</option>
                                                </select>
                                            </div>
                                <?php break;
                                    }?>                                
                            </p>     
                                <div class="inputsFormulario"><input id="btAtualizarInfExcursao" class="botaoAtualizar" type="submit" name="enviar" value="ATUALIZAR"/></div>                          
                            </form>  
                            <p>                                
                                <div class="textosFormulario"><a  id="botaoExlcluirInfExcursao" href="controle/exclui_excursao.php?id=<?php echo $cod?>">EXCLUIR</a></div>                                                 
                            </p>
                 </div>

                <div id="infoChegada">
                        <h1 id="tituloChegada" class="titulo">
                            INFORMAÇÕES DA CHEGADA                                   
                        </h1>                          
                        <?php
                            if($info_excursoes->id_chegada != null)
                            {?>
                                <form id="inf_chegada" method="post"  action="#"> 
                                <p>
                                    <div class="textosFormularioChegada"><label id="txt1" class="textos" for="nome">Data da chegada </label></div>
                                    <div class="inputsFormularioChegada"><input style="padding-left:5px;" size="35" type="date" name="dt_chegada" value="<?php echo $info_chegada->data_chegada;?>"></div>
                                </p>
                                <p>
                                    <div class="textosFormularioChegada"><label id="txt1" class="textos" for="nome">Data provável de retorno </label></div>
                                    <div class="inputsFormularioChegada"><input style="padding-left:5px;" size="35" type="date" name="dt_provavel_retorno" value="<?php echo $info_chegada->data_provavel_retorno;?>"></div>
                                </p>
                                <p>
                                    <div class="textosFormularioChegada"><label id="txt1" class="textos" for="nome">Quantidade total de pessoas </label></div>
                                    <div class="inputsFormularioChegada"><input style="width:55px;padding-left:5px;" size="2" type="number" name="qtd_total_pessoas" value="<?php echo $info_chegada->qtd_total_pessoas;?>"></div>
                                </p>
                                <p>
                                    <div class="textosFormularioChegada"><label id="txt1" class="textos" for="nome">Cidade de origem </label></div>
                                    <div class="inputsFormularioChegada"><input style="padding-left:5px;" size="20" type="text" name="cidade_origem" value="<?php echo $info_chegada->cidade_origem;?>"></div>
                                </p>
                                    <input type="hidden" id="pendente" name="id_chegada" value="<?php echo $info_excursoes->id_chegada;?>">
                                <p>
                                    <?php
                                        switch($info_chegada->tipo_estabelecimento)
                                        {
                                            case "CNPJ" :?>
                                                <div class="textosFormularioChegada"><label for="estabelecimento">Tipo de estabelecimento </label></div>
                                                <div class="inputsFormularioChegada">
                                                <select  name="estabelecimento">
                                                    <option value="CNPJ" selected>CNPJ</option>
                                                    <option value="CPF">CPF</option>
                                                    <option value="OUTRO">OUTRO</option>
                                                </select> 
                                                </div> 
                                      <?php break;
                                            case "CPF" :?>
                                                <div class="textosFormularioChegada"><label for="estabelecimento">Tipo de estabelecimento </label></div>
                                                <div class="inputsFormularioChegada">
                                                <select  name="estabelecimento">
                                                    <option value="OUTRO"> OUTRO </option>
                                                    <option value="CPF" selected> CPF </option>
                                                    <option value="CNPJ"> CNPJ </option>
                                                </select>  
                                                </div>
                                      <?php break;
                                            case "OUTRO" : ?>
                                                <div class="textosFormularioChegada"><label for="estabelecimento">Tipo de estabelecimento </label></div>
                                                <div class="inputsFormularioChegada">
                                                <select  name="estabelecimento">
                                                    <option value="CPF">CPF</option>
                                                    <option value="CNPJ"> CNPJ </option>
                                                    <option value="OUTRO" selected>OUTRO</option>
                                                </select>
                                                </div>
                                      <?php break;
                                        }?>                    
                                </p>
                                    <div class="inputsFormularioChegada"><label><input id="btAtualizarInfChegada" class="botaoAtualizar" type="submit" name="enviar" value="ATUALIZAR" /></label></div>                              
                                </form>
                                <p> 
                                    <div class="textosFormularioChegada"><a id="botaoExlcluirInfChegada" href="controle/exclui_excursao.php?id=<?php echo $cod?>">EXCLUIR</a></div>
                                </p>
                      <?php }else{?>
                                    <p class="semregistro">NÃO REGISTRADA</p>
                           <?php }?>                                                       
                </div>

                <div id="infoPartida">
                            <h1 id="tituloPartida" class="titulo">
                                INFORMAÇÕES DA PARTIDA                           
                            </h1>

                        <?php
                            if($info_excursoes->id_partida != null)
                            {?>
                                <form id="inf_partida" method="post"  action="#"> 
                                    <p>
                                        <div class="textosFormularioPartida"><label class="textos" for="nome">Data de partida </label></div>
                                        <div class="inputsFormularioPartida"><input style="padding-left:5px;" size="35" type="date" name="dt_partida" value="<?php echo $info_partida->data_saida;?>"></div>
                                    </p>
                                    <p>
                                        <div class="textosFormularioPartida"><label class="textos" for="ocorrencias">Ocorrências </label></div>
                                        <div class="inputsFormularioPartida">
                                        <textarea name="ocorrencias" rows="3" cols="33" style="resize:none;">
                                            <?php echo $info_partida->ocorrencias;?>
                                        </textarea>      
                                        </div>                              
                                    </p>
                                    <p>
                                        <div class="textosFormularioPartida"><label class="textos" for="nome">Valor da taxa pago </label></div>
                                        <div class="inputsFormularioPartida"><input style="padding-left:5px;" size="11" type="text" name="valorTaxa" readonly="true" value="<?php echo number_format($info_partida->valor_taxa_pago,2,',','');?>"></div>
                                    </p>             
                                    <input type="hidden" id="pendente" name="id_partida" value="<?php echo $info_excursoes->id_partida;?>"> 
                                    <div class="inputsFormularioPartida"><input id="btAtualizarInfPartida" class="botaoAtualizar" type="submit" name="enviar" value="ATUALIZAR"/></div>                                      
                                </form>          
                                <div class="textosFormularioPartida"><a id="botaoExlcluirInfPartida" href="controle/exclui_excursao.php?id=<?php echo $cod?>">EXCLUIR</a></div> 
                 <?php }else{?>
                                <p style="margin-top: 65px" class="semregistro">NÃO REGISTRADA</p>
                      <?php }?>            
                </div>

                <div id="infoMulta">
                            <h1 id="tituloMulta" class="titulo">
                                INFORMAÇÕES DA MULTA
                            </h1>

                            <?php
                            if($info_excursoes->id_multa != null)
                            {?>
                                <form id="inf_multa" method="post"  action="#"> 
                                <p>
                                    <div class="textosFormularioMulta"><label class="textos" for="nome">Valor da multa </label></div>
                                    <div class="inputsFormularioMulta"><input style="text-align: center;" readonly="true" size="11" type="text" name="valorMulta" value="<?php echo number_format($info_multa->valor_multa,2,',','');?>"></div>
                                </p>                        
                                </form> 
                      <?php }else{?>
                                <p style="margin-top: 65px" class="semregistro">NÃO REGISTRADA</p>
                      <?php }?>                     
                </div>            
            <input id="bt-voltar" type="button" value="VOLTAR" onClick="Nova()">
        </div>
        
        
    </body>

</html>