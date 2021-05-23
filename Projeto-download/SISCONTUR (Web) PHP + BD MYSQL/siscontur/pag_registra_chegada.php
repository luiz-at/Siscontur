<?php
	session_start();
    require_once("persistencia/ExcursaoDAO.php");
	require_once("modelo/Excursao.php");
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
		<title>Registro de excursão</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style/p_registra_chegada.css">		
	</head>
	<body>
		<div id="base">
			<div id="tituloPagina">
				<h1 id="textoTituloPagina">REGISTRO DE CHEGADA</h1>
			</div>
			<div id="barraBusca">
				<form action="pag_registra_chegada.php"  method="post">
					<div id=textoBarra>
						<p id="texto">DIGITE O CÓDIGO DE REGISTRO DA EXCURSÃO: </p>
					</div>					
					<div id="barraBotaoBuscar">
						<input size="10" id="inputBarraBuscar" type="text" name="cod" id="cod"> <button id="btBuscar">BUSCAR</button>
					</div>			
				</form>
			</div>

			<input class="btn" id="botao_voltar" type="button" value="VOLTAR" onClick="Nova()">						

			<div id="conteudoPagina">				
				<?php
					if(isset($_POST['cod']))
					{
						$valor = $_POST['cod'];
					}
					else{
						$valor = 'Valor padrão';
					}
					
					$_SESSION["valor"] = $valor;
					$resultado = ExcursaoDAO::buscaPorCodigoRegistro($valor);

					if($resultado == NULL )
					{
						
					}
					else{?>	

				<div id="excursaoEncontrada">
					<h1 id="tituloExcursao"><?php echo "EXCURSÃO ENCONTRADA";?></h1>
					<div id="txtNomeExcEncontrada">
						<p>Nome responsável: </p>
						<p>CPF do responsável: </p>
						<p>Tipo de rransporte: </p>
						<p>Número de ruristas: </p>
					</div>
					<div id="txtConteudoExcEncontrada">
						<p class="conteudo"><?php echo $resultado->nome_responsavel?></p>
						<p class="conteudo"><?php echo $resultado->cpf_responsavel?></p>
						<p class="conteudo"><?php echo $resultado->tipo_transporte?></p>
						<p class="conteudo"><?php echo $resultado->numero_turistas?></p>
					</div>					
				</div>
										

				<div id="registroChegada">
					<h1 id="tituloRegistraChegada">REGISTRAR CHEGADA</h1>
					<form action="controle/registra_chegada.php" onsubmit="registrou()" method="post">

					<div id="txtNomeRegistroExc">
						<p><label for="nome">Data de chegada: </label></p>
						<p><label for="nome">Data prevista de retorno: </label></p>
						<p><label for="nome">Quantidade total de pessoas: </label></p>
						<p><label for="nome">Cidade de origem: </label></p>
					</div>

					<div id="txtConteudoRegistroExc">
						<p><input required type="date" name="data_chegada" id="data_chegada" min="<?php echo date('Y-m-d');?>"></p>
						<p><input required type="date" name="dt" id="dt" min="<?php echo date('Y-m-d');?>"></p>
						<p><input required style="width:60px;" type="number" name="qtd_pessoas" id="qtd_pessoas"></p>
						<p><input required style="width:147px;" type="text" name="cidade_origem" id="cidade_origem"></p>
					</div>		
					<div id="botoesRadio">
						<p style="font-size:17; color:#C08282;">Tipo de estabelecimento</p>
						<p id ="tipo_estabelecimento">							
							<input required type="radio" id="cnpj" name="estabelecimento" value="CNPJ">
							<label for="cnpj"> CNPJ</label><br>

							<input required type="radio" id="cpf" name="estabelecimento" value="CPF">
							<label for="cpf"> CPF</label><br>

							<input required type="radio" id="outr" name="estabelecimento" value="OUTRO">
							<label for="outr"> OUTRO</label>														
						</p> 
					</div>		
					<button id="btRegistrar">REGISTRAR</button>		
					</form>
				</div>					
					<?php }?>				
			</div>		
													
		</div>		
		
	</body>
</html>