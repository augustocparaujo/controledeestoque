<?php
session_start();
include('conexao.php');
include('funcoes.php');

$iduser = $_SESSION['iduser'];
$usuario = $_SESSION['nomeuser']; //pega usuario que est� executando a a��o
$matriculauser = $_SESSION['matricula'];
$emailuser = $_SESSION['emailuser'];
$ip = $_SERVER['REMOTE_ADDR']; // pegar ip da maquina
$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']); //pega nome da maquina
$data = date('Y-m-d H:m:s');

@$id = $_POST['id'];
@$localidade	= $_POST['localidade'];
@$tipo = $_POST['tipo'];
@$fabricante	= $_POST['fabricante'];
@$modelo = $_POST['modelo'];
@$npatrimonio = $_POST['npatrimonio'];
@$nserie = $_POST['nserie'];
@$sistema = $_POST['sistema'];
@$build = $_POST['build'];
@$mac = $_POST['mac'];
@$quantidade = $_POST['quantidade'];
@$local = $_POST['local'];
if($_POST['almoxarifado'] != ''){ @$almoxarifado = $_POST['almoxarifado'];}else{ @$almoxarifado = $_POST['novoalmoxarifado'];}
@$observacao = AspasBanco($_POST['observacao']);
@$status	= $_POST['status'];
@$usuario = $iduser;
@$usuarioalterou = $iduser;
@$datacadastro = $data;
@$dataatualizacao = $data;	          

if($id == ''){
try {
    $sql = $conpdo->prepare("INSERT INTO estoque
    (localidade,tipo,fabricante,modelo,npatrimonio,nserie,sistema,build,mac,quantidade,local,almoxarifado,observacao,status,usuario,datacadastro) 
    VALUES (:localidade,:tipo,:fabricante,:modelo,:npatrimonio,:nserie,:sistema,:build,:mac,:quantidade,:local,:almoxarifado,:observacao,:status,:usuario,:datacadastro)");
    $sql->bindValue(":localidade",$localidade);
    $sql->bindValue(":tipo",$tipo);
    $sql->bindValue(":fabricante",$fabricante);
    $sql->bindValue(":modelo",$modelo);
    $sql->bindValue(":npatrimonio",$npatrimonio);
    $sql->bindValue(":nserie",$nserie);
    $sql->bindValue(":sistema",$sistema);
    $sql->bindValue(":build",$build);
    $sql->bindValue(":mac",$mac);
    $sql->bindValue(":quantidade",$quantidade);
    $sql->bindValue(":local",$local);
    $sql->bindValue(":almoxarifado",$almoxarifado);
    $sql->bindValue(":observacao",$observacao);
    $sql->bindValue(":status",$status);
    $sql->bindValue(":usuario",$usuario);
    $sql->bindValue(":datacadastro",$data);
    $sql->execute();

    echo alert('Incluído com sucesso');

} catch(PDOException $e) { echo alert($e->getMessage()); } 
}else{

    try {
        $sql = $conpdo->prepare("UPDATE estoque SET
        localidade=:localidade,tipo=:tipo,fabricante=:fabricante,modelo=:modelo,
        npatrimonio=:npatrimonio,nserie=:nserie,sistema=:sistema,build=:build,mac=:mac,quantidade=:quantidade,local=:local,
        almoxarifado=:almoxarifado,observacao=:observacao,status=:status,usuarioalterou=:usuarioalterou,
        dataatualizacao=:dataatualizacao WHERE id=:id");
        $sql->bindValue(":id",$id);
        $sql->bindValue(":localidade",$localidade);
        $sql->bindValue(":tipo",$tipo);
        $sql->bindValue(":fabricante",$fabricante);
        $sql->bindValue(":modelo",$modelo);
        $sql->bindValue(":npatrimonio",$npatrimonio);
        $sql->bindValue(":nserie",$nserie);
        $sql->bindValue(":sistema",$sistema);
        $sql->bindValue(":build",$build);
        $sql->bindValue(":mac",$mac);
        $sql->bindValue(":quantidade",$quantidade);
        $sql->bindValue(":local",$local);
        $sql->bindValue(":almoxarifado",$almoxarifado);
        $sql->bindValue(":observacao",$observacao);
        $sql->bindValue(":status",$status);
        $sql->bindValue(":usuarioalterou",$usuarioalterou);
        $sql->bindValue(":dataatualizacao",$data);
        $sql->execute();
    
        echo alert('Alterado com sucesso');
    
    } catch(PDOException $e) { echo alert($e->getMessage()); } 

}
?>