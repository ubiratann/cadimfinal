<?php
include 'Conexao.php';

$link = AbrirConexao();

if ($link) {
	session_start();

	$crm = $_POST['crm'];
	$senha = $_POST['senha'];

	$result = $link->query("SELECT * from medico where crm=$crm and senha='$senha' ");
	$r = $result->fetch_assoc();
	if ($r) {
		$_SESSION['login'] = $crm;
		$_SESSION['senha'] = $senha;
		header('Location: inicial.php');
	}else{
		unset ($_SESSION['login']);
  		unset ($_SESSION['senha']);
		header('Location: login.html');
	}
}
 
echo "Sucesso: Sucesso ao conectar-se com a base de dados MySQL." . PHP_EOL;

FecharConexao($link)

?> 