<?php

######################### conexão usando pdo #########################################
$serverpdo = "mysql:host=localhost;dbname=bd_eco;charset=utf8";
$uidpdo = 'root';
$pwdpdo = '';
try {
    $conpdo = new PDO($serverpdo, $uidpdo, $pwdpdo);
    //echo'sucesso na conexão';
} catch (PDOException $e) {
    echo 'Error com banco: '. $e->getMessage();
} catch (Exception $e) {
    echo 'Outro erro: '. $e->getMessage();
}

?>