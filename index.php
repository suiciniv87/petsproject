<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
	<title>Consulta PETs</title>
	<link href="css/stylesheet.css" rel="stylesheet"/>
	<!--<script src="scripts/seu-script.js"></script> -->
	
</head>
<body>

	<h1>Consulta PET:</h1>
	
	<div class="consulta">
		<form method="POST" action="pesquisar.php">
			Data Início: <input type="date" name="txt_data_inicio"> <br>Data Fim: <input type="date" name="txt_data_fim"> <br>
			Nome do animal: 
			<!-- AQUI COMEÇA A LISTA DROPDOWN-->
			<?php

				include_once "conecta.php";


				$sql = "SELECT nome_pet FROM pets";
				$resultado = $conn->query($sql);

				echo "<select name='select_nome_pet'>";
				while ($row = mysqli_fetch_array($resultado)) {
					echo "<option value='" . $row['nome_pet'] . "'>" . $row['nome_pet'] . "</option>";
				}
				echo "</select>";

			?>
			<!--Nome: <input type="text" name="nome"><br>-->
			
			
			<!-- AQUI TERMINA A LISTA DROPDOWN -->
			<input type="submit" name="Pesquisar" value="ENVIAR">
		</form>
	</div>
	
		

</body>
</html>