<?php
session_start();
include('conexao.php');
include('funcoes.php');
@$data = date('Y-m-d');
@$iduser = $_SESSION['iduser'];
@$usuario = $_SESSION['nomeuser'];//pega usuario que est� executando a a��o
@$ip = $_SERVER['REMOTE_ADDR']; // pegar ip da maquina
@$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']); //pega nome da maquina


session_unset();
session_destroy(); //destroi sess�o do usu�rio
ob_end_clean();// J� podemos encerrar o buffer e limpar tudo que h� nele
echo "<script>location.href='login.php'</script>";

?>
