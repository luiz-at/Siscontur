
<script type="text/javascript">
function Nova()
{
    location.href=" index.php"
}
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
        
<script type="text/javascript">
    $("#cpf_responsavel").mask("000.000.000-00");
</script>	

<script type="text/javascript">
	function registrou(){
		alert("Registrado com sucesso");
	}
</script>

<html>
	<head>
		<title>Registro de excursao</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style/pg_registra_excursao.css">	
	</head>
	<body>	

		<div id="corpo">
			<div id="barracima">
				<p id="txt_barracima">REGISTRAR EXCURSÃO</p>
			</div>
				<div id="corpo_form">
					
					<form action="controle/registra_excursao.php" onsubmit="registrou()" method="post">
						<div id="campo_nresponsavel">	
							<p>
								<label id="txt1" class="textos" for="nome">Nome do responsável </label>
								<input class="inputsFormulario" size="35" type="text" name="nome_responsavel" placeholder=" Ex.: Luiz Antonio Santos Batista" id="nome_responsavel" required maxlength="60">
							</p>
						
							<p>
								<label id="txt2" class="textos" for="nome">CPF do responsável </label>
								<input class="inputsFormulario" type="text" class="form-control" placeholder=" Ex.: 000.000.000-00" name="cpf_responsavel" id="cpf_responsavel" required pattern="[0-9.-]{14}" title="digite um numero valido">
							</p>
							
							<p>
								<label id="txt3" class="textos" for="nome">Número de turistas </label>
								<input class="inputsFormulario" type="number" name="numero_turistas" placeholder=" Ex.: 30" id="numero_turistas" required max="999">
							</p>
						</div>
						
						
						<div id="botoesradial">
						<p>
						<p style="font-size:30px;">Transporte</p>
							<input required class="radio" type="radio" id="oni" name="transporte" value="Ônibus">
							<label class="labels" for="onibus"> Ônibus</label><br>

							<input required class="radio" type="radio" id="mc" name="transporte" value="Micro-ônibus">
							<label class="labels" for="mc"> Micro-ônibus</label><br>

							<input required class="radio" type="radio" id="vs" name="transporte" value="Vans e similares">
							<label class="labels" for="vs"> Vans e similares</label><br>
						</p>
						</div>
					</div>
							<button id="bt-registrar">REGISTRAR</button>							
					</form>		
					
					
	</body>
	<input id="voltar" type="button" value="VOLTAR" onClick="Nova()">
	</div>
</html>