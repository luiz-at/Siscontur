<?php
  session_start();
  require_once("modelo/Excursao.php");   
  require_once("persistencia/ExcursaoDAO.php");
  $excursao = ExcursaoDAO::listaExcursoes(); 
?>

<script type="text/javascript">
function Nova()
{
    location.href=" index.php"
}
</script>

<html>
    <head>
        <title>SISCONTUR</title>
		    <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style/p_exibe_excursoes.css">	
    </head>        
    <body>
        <div id="corpo">

          <div id="barracima">
            <p id="txt_barracima">LISTA DE EXCURSÕES</p>
          </div> 

          <!-- <div id="dvTabela"> -->
            <table id="tabela_excursoes" > 
              <thead>         
              <tr>
                  <th>CÓDIGO</th>
                  <th id="resp">RESPONSÁVEL</th>
                  <th id="cpf">CPF</th>
                  <th id="n-turistas">N° <br>TURISTAS<br></th>
                  <th>TRANSPORTE</th>
                  <th colspan="2" class="cpm">CHEGADA</th>
                  <th colspan="2" class="cpm" > PARTIDA</th>
                  <th colspan="2" id="mt" class="cpm" >MULTA</th>    
                  <th id="nada"> </th>          
              </tr>
            </thead> 
              
            <tbody> 
              <?php foreach($excursao as $e){?>
                  <?php $_SESSION['id_chegada'] = $e->id_chegada;?>
               
              <tr> 
                <td id="tdCodigoRegistro"><?php echo $e->codigo_registro; ?></td>
                <td id="tdNomeResponsavel"><?php echo $e->nome_responsavel; ?></td>
                <td id="tdCpf"><?php echo $e->cpf_responsavel; ?></td>
                <td id="tdNumTuristas"><?php echo $e->numero_turistas; ?></td>
                <td id="tdTipoTransporte"><?php echo $e->tipo_transporte; ?></td>

                <td id="tdChegada" class="c">
                <?php if($e->id_chegada == NULL)
                      {?>
                        <font color="#fc0000"><?php 
                        echo "PENDENTE";?>
                        </font>
                <?php }            
                      else{?>
                        <font color="#2bd900"> 
                <?php   echo "ATIVA";?> 
                        </font>
              <?php  } ?>                                          
              </td>

              <td id="ber-chegada" class="botoes">
                <a class="bt_ver" href="informacoes_chegada.php?id=<?php echo $e->id_chegada;?>"><b>VER<b></a>
              </td>

              <td id="tdPartida" class="c"> 
                <?php if($e->id_partida == NULL)
                      {?>
                        <font color="#fc0000"><?php echo "PENDENTE";?> </font>
                <?php }            
                      else{?>
                            <font color="#2bd900"> <?php echo "ATIVA";?> </font>           
                <?php }?>
              </td>

              <td class="botoes"> 
                <a class="bt_ver" href="informacoes_partida.php?id=<?php echo $e->id_partida;?>"><b>VER<b></a>                            
              </td> 

              <td id="tdMulta" class="c">
              <?php if($e->id_multa == NULL)
                    {?>
                      <font color="#fc0000"><?php echo "PENDENTE";?> </font>                                    
              <?php }            
                    else{?>
                      <font color="#2bd900"><?php echo "ATIVA";?> </font>               
              <?php }?>                                   
              </td>    

              <td class="botoes"><a  class="bt_ver" href="informacoes_multa.php?id=<?php echo $e->id_multa;?>"><b>VER<b></a></td>        

              <td id="td-bt-editar"><a id="btEditar" href="pag_atualiza_informacoes_excursao.php?id=<?php echo $e->codigo_registro;?>"><b>EDITAR<b></a></td>  

            </tr> 
            
      <?php } ?>    
            </tbody>         
            </table>
          <!-- </div>  -->
          <input id="btVoltar" type="button" value="VOLTAR" onClick="Nova()">    
        </div>           
    </body>
</html>




