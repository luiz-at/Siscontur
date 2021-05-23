<?php
    session_start();
    //pegando arquivos para trabalhar com excursao
    require_once("persistencia/ExcursaoDAO.php");
    require_once("modelo/Excursao.php");
    //pegando arquivos para trabalhar com chegada
    require_once("modelo/Chegada.php");
	require_once("persistencia/ChegadaDAO.php");
	//pegando arquivos para trabalhar com Partida
	require_once("modelo/Partida.php");
	require_once("persistencia/PartidaDAO.php");

?>
<script type="text/javascript">
	function registrou(){
		alert("Registrado com sucesso");
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
		<title>Registro de Partida</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style/p_registra_partida.css">	
	</head>
	<body>
		<div id="base">		
			<div id="tituloPagina">
				<h1 id="textoTituloPagina">REGISTRO DE PARTIDA</h1>
			</div>
			<div id="barraBusca">
				<form action="pag_registra_partida.php" method="post">
					<div id="textoBarra">
						<p id="texto">DIGITE O CÓDIGO DE REGISTRO DA EXCURSÃO: </p> 
					</div>
					<div id="barraBotaoBuscar">
						<input size="10" id="inputBarraBuscar" type="text" name="cod"> <button id="btBuscar">BUSCAR</button>
					</div>		
				</form>	
			</div>

			<input id="botao_voltar" type="button" value="VOLTAR" onClick="Nova()">

			<div id="conteudoPagina">
	<?php					
				if(isset($_POST["cod"]) == "")
				{

				}
				else
				{
					$excursao = ExcursaoDAO::buscaPorCodigoRegistro($_POST["cod"]);
					if($excursao == NULL)
					{?>
						<!-- /* echo "Excursao não encontrada"; */ -->
						<script type="text/javascript">		
							function excNaoEncontrada()
							{
								alert("Excursão não encontrada.");
								location.href="  pag_registra_partida.php";
							}
							excNaoEncontrada();
						</script>
	<?php   		}
					else
					{
						if($excursao->id_chegada == NULL)
						{?>
							<!-- echo "Chegada nao registrada"; -->
							<script type="text/javascript">		
								function excNaoEncontrada()
								{
									alert("Chegada não registrada.");
									location.href=" pag_registra_partida.php"
								}
								excNaoEncontrada();
							</script>
	<?php       		} 
						else
						{?>
							<div class="conteudo1">
								<h1 id="tituloExcursao"><?php echo "EXCURSAO ENCONTRADA";?></h1>
								<?php $excursao_chegada = ChegadaDAO::buscaPorCodigoRegistro($excursao->id_chegada);?>
											
								<div class="conteudo1" id="conteudo1Textos">
									<p>Nome Responsável:</p>
									<p>CPF do Responsável:</p>
									<p>Data de chegada:</p>
									<p>Cidade de origem:</p>
								</div>
								<div class="conteudo1" id="conteudo1Conteudo">
									<p class="conteudo"><?php echo $excursao->nome_responsavel?></p>
									<p class="conteudo"><?php echo $excursao->cpf_responsavel?></p>
									<p class="conteudo"><?php echo $excursao_chegada->data_chegada?></p>
									<p class="conteudo"><?php echo $excursao_chegada->cidade_origem?></p>
								</div>										
							</div>

	<?php
							$excursao = ExcursaoDAO::buscaPorCodigoRegistro($_POST["cod"]);
							$chegada = ChegadaDAO::buscaPorCodigoRegistro($excursao->id_chegada);
										
							$taxa = 0;								
							switch ($chegada->tipo_estabelecimento)
							{
								case "CNPJ":
								if($excursao->tipo_transporte == "Ônibus")
								{
									$taxa = 300;
								} 
								elseif($excursao->tipo_transporte == "Micro-ônibus")
								{
									$taxa = 200;
								}
								else{
									$taxa = 100;
								}
								break;
									
								case "CPF":
								if($excursao->tipo_transporte == "Ônibus")
								{
									$taxa = 400;
								} 
								elseif($excursao->tipo_transporte == "Micro-ônibus")
								{
									$taxa = 300;
								}
								else
								{
									$taxa = 180;
								}
								break;    
												
								case "OUTR":
								if($excursao->tipo_transporte == "Ônibus")
								{
									$taxa = 1500;
								} 
								elseif($excursao->tipo_transporte == "Micro-ônibus")
								{
									$taxa = 1000;
								}
								else
								{
									$taxa = 5000;
								}
								break; 
							}	

							$_SESSION["taxa_paga"] = $taxa;
							$_SESSION["codigo_partida_buscado"] = $_POST["cod"];					
					?>					
							<div class="conteudo2">
								<h1 id="tituloRegistraPartida">REGISTRAR PARTIDA</h1>

								<div id="campoValorTaxa">
									<div id="txtValorTaxa"><p>Valor da taxa:</p></div>
									<div id="txtConteudoValorTaxa"><p style="background-color: rgb(47, 42, 42); text-align: center"><?php echo number_format($taxa,2,',','')?></p></div>
								</div>

								<form action="controle/registra_partida.php" onsubmit="registrou()" method="post">
									<div id="textRegistraPartida">
										<p><label for="nome">Data de partida: </label></p>
										<p><label for="nome">Ocorrências  </label></p>
									</div>
									<div id="conteudoRegistraPartida">
										<p><input type="date" name="data_partida" id="data_partida" min="<?php echo date('Y-m-d');?>"></p>
										<p><input type="text" name="ocorrencias" id="ocorrencias"></p>
									</div>																			
									<button id="btRegistrar"> REGISTRAR</button>	
								</form>	
							</div>									
	<?php               }?>
	<?php           }?>
	<?php       }?>	
			</div>				
	</body>
</html>