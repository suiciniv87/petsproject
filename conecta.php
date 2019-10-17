<?php
	$servidor = "localhost";
	$usuario = "root";
	$senha = "";
	$dbname = "pets";
	//Criar a conexao
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
	
	//Checar a conexao
	if ($conn->connect_error) {
		die("Conexão falhou: " . $conn->connect_error);
	}
?>
	