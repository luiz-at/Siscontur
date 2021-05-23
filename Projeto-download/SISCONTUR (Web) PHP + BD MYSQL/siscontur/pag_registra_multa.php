<?php

	//pegando arquivos para trabalhar com chegada
    require_once("modelo/Chegada.php");
	require_once("persistencia/ChegadaDAO.php");
	//pegando arquivos para trabalhar com Partida
	require_once("modelo/Partida.php");
	require_once("persistencia/PartidaDAO.php");
	//pegando arquivos para trabalhar com Excursao
	require_once("modelo/Excursao.php");
	require_once("persistencia/ExcursaoDAO.php");
	//pegando arquivo para usar as funcoes prontas
	require_once("funcoes.php");

	require_once("persistencia/MultaDAO.php");
    require_once("modelo/Multa.php");

?>

<script type="text/javascript">
	function Nova()
	{
		location.href=" index.php";
	}	
</script>

<script type="text/javascript">
	function Nova()
	{
		location.href=" index.php"
	}		
</script>

<html>
	<head>
		<title>Registro de multas</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style/p_registra_multa.css">	
	</head>
	<body>
		<div id="base">
			<div id="tituloPagina">
				<h1 id="textoTituloPagina">REGISTRO DE MULTA</h1>
			</div>

			<div id="barraBusca">
				<form action="pag_registra_multa.php" method="post">

					<div id="textoBarra">
						<p id="texto">DIGITE O CÓDIGO DE REGISTRO DA EXCURSÃO: </p>
					</div>
					
					<div id="barraBotaoBuscar">
						<input size="10" id="inputBarraBuscar" type="text" name="cod" id="cod"> <button id="btBuscar">BUSCAR</button>
					</div>
				</form>	
			</div>			

			<input id="botao_voltar" type="button" value="VOLTAR" onClick="Nova()">

		<?php 
			if(isset($_POST["cod"]) == "")
			{

			}
			else{				
					$excursao = ExcursaoDAO::buscaPorCodigoRegistro($_POST["cod"]);
					if($excursao == NULL)
					{?>
						<script type="text/javascript">		
								function excNaoEncontrada()
								{
									alert("Excursão não encontrada!");
									location.href=" pag_registra_multa.php"
								}
								excNaoEncontrada();
						</script>
		<?php		}
					elseif($excursao->id_chegada == NULL)
					{?>
						<script type="text/javascript">		
								function excNaoEncontrada()
								{
									alert("Chegada não registrada!");
									location.href=" pag_registra_multa.php"
								}
								excNaoEncontrada();
						</script>
		<?php		}
					elseif($excursao->id_partida == NULL)
					{?>
						<script type="text/javascript">		
								function excNaoEncontrada()
								{
									alert("Partida não registrada!");
									location.href=" pag_registra_multa.php"
								}
								excNaoEncontrada();
						</script>
		<?php		}
					else{?>						
						<?php
						 	$chegada = ChegadaDAO::buscaPorCodigoRegistro($excursao->id_chegada);
							$partida = PartidaDAO::buscaPorCodigoRegistro($excursao->id_partida);
							
							$dias_presentes = Funcoes::calculaDiferencaDatas($chegada->data_chegada,
																			$partida->data_saida);
																			
							if($dias_presentes > 7)
							{
								$dias_ultrapassados = $dias_presentes - 7;
							}
							else{
								$dias_ultrapassados = 0;
							}

							$multa = ($partida->valor_taxa_pago * 0.10) * $dias_ultrapassados;?>

							<div id="conteudo">
								<p style="font-family: consolas,arial; color: #C08282; font-size: 25px; background-color: rgb(47, 42, 42); padding: 15 10 ;margin-top: 0">MULTA REGISTRADA!</p>
								<div id="txtValorMulta">
									<p>Valor da Multa</p>
								</div>
								<div id="conteudoValorMulta">
									<p style="background-color: rgb(47, 42, 42);"><?php echo $multa;?></p>
								</div>			
							</div>						
							 
					<?php	$m = new Multa($multa);

							MultaDAO::registraMulta($m);

							ExcursaoDAO::cadastraIdMulta(MultaDAO::retornaIdMulta(),$excursao->codigo_registro);
						 ?>					
		       <?php }?>
		   <?php }?>		
		</div>		
	</body>
	
</html>