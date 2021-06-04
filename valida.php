<?php 
session_start();
include 'conexao.php';
include 'funcoes.php';
@$matricula = md5(addslashes(limpaCPF_CNPJ($_POST['matricula'])));
@$senha = md5(addslashes($_POST['senha']));
@$data = date('Y-m-d');

$sql = $conpdo->prepare("SELECT * FROM usuario WHERE matricula_crp=:matricula_crp AND senha=:senha AND situacao=:ativo LIMIT 1");
$sql->bindValue(":matricula_crp",$matricula);
$sql->bindValue(":senha",$senha);
$sql->bindValue(":ativo","ativo");
$sql->execute();
$dados_uu = $sql->fetch(PDO::FETCH_ASSOC);

	if(empty($dados_uu)){ echo alert('Usuário ou senha incorreto');} 
	//elseif($dados_uu['brech'] == 'logado'){ echo '<div class="alert alert-danger"> Usuário ativo<br>Por favor destravar usuário</div>';} 
	else{
		$_SESSION['iduser'] = $dados_uu['id'];
		$_SESSION['matricula'] = $dados_uu['matricula'];
		$_SESSION['nomeuser'] = $dados_uu['nome'];
        $_SESSION['emailuser'] = $dados_uu['email'];
		$_SESSION['unidade'] = $dados_uu['unidade'];

		$iduser = $_SESSION['iduser'];
		$usuario = $_SESSION['nomeuser']; //pega usuario que est� executando a a��o
		$matriculauser = $_SESSION['matricula'];
		$emailuser = $_SESSION['emailuser'];
		$unidade = $_SESSION['unidade'];
		$ip = $_SERVER['REMOTE_ADDR']; // pegar ip da maquina
		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']); //pega nome da maquina

		$descricao = 'Entrou no sistema';
		//logs($iduser,'Entrou','Usuário',$descricao,$data,$hostname,$ip);

		echo "<script>location.href='index.php';</script>";
		
	}

?>