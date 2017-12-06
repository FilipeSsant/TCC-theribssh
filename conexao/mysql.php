<?php

	//Conexão Filezilla
	
	//Realiza a conexão com o banco de dados mysqli
	//passamos o local do BD, o usuario e a senha
	//$conexao = mysqli_connect("192.168.1.1", "theribssh","bcd127@theribssh");
	
	//Tornar os dados que vem do banco em utf-8 (acentos)
	//mysqli_set_charset("utf8");
	
	//Definimos o database a ser utilizado no projeto
	//mysqli_select_db("dbtheribssh");
	
	//Realiza a conexão com o banco de dados mysqli
	//passamos o local do BD, o usuario e a senha
	$conexao = mysql_connect("localhost", "root","");
	//Definimos o database a ser utilizado no projeto
	mysql_select_db("dbtheribssh");
?>
