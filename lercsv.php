<?php 
include('conexao.php');
include('funcoes.php');

$data = date('Y-m-d');


if (($handle = fopen("ativos.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 10000, ";")) !== FALSE) {
        $num = count($data);
        for ($c=0; $c < $num; $c++) {

            $localidade = $data[0];
            $tipo = $data[1];
            $fabricante = $data[2];
            $modelo = $data[3];
            $npatrimonio = $data[4];
            $nserie = $data[5];
            $local = $data[7];
            $status =  $data[6];
            $observacao =  $data[8];

      /*     try {
                $sql = $conpdo->prepare("INSERT INTO estoque
                (localidade,tipo,fabricante,modelo,npatrimonio,nserie,local,observacao,status,usuario) 
                VALUES (:localidade,:tipo,:fabricante,:modelo,:npatrimonio,:nserie,:local,:observacao,:status,:usuario)");
                $sql->bindValue(":localidade",$localidade);
                $sql->bindValue(":tipo",$tipo);
                $sql->bindValue(":fabricante",$fabricante);
                $sql->bindValue(":modelo",$modelo);
                $sql->bindValue(":npatrimonio",$npatrimonio);
                $sql->bindValue(":nserie",$nserie);
                $sql->bindValue(":local",$local);
                $sql->bindValue(":observacao",$observacao);
                $sql->bindValue(":status",$status);
                $sql->bindValue(":usuario",10);
                $sql->execute();
            
                echo alert('Incluído com sucesso');
            
            } catch(PDOException $e) { echo alert($e->getMessage()); } */
            

        }
    }
    fclose($handle);
}
?>