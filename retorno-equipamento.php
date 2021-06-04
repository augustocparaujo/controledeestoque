<?php
include('conexao.php');
include('funcoes.php');
$id = $_GET['id'];
$sql = $conpdo->prepare("SELECT * FROM estoque WHERE id=:id");
$sql->bindValue(":id",$id);
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $item){
    echo'
    <div class="row">
    <input type="text" name="id" value="'.$item['id'].'" style="display:none" required/>
    <input type="text" class="form-control" name="localidade" value="'.$item['localidade'].'" style="display:none" required/>
    <label class="col-xs-6 col-lg-6 col-md-12 col-sm-12">Tipo
    <select type="text" class="form-control" name="tipo" required>
        <option value="'.$item['tipo'].'">'.$item['tipo'].'</option>';
        foreach($tipo as $item2){echo'<option value="'.$item2.'">'.$item2.'</option>';}
        echo'
    </select>
    </label>
    <label class="col-xs-6 col-lg-6 col-md-12 col-sm-12">Fabricante
    <select type="text" class="form-control" name="fabricante" required>
        <option value="'.$item['fabricante'].'">'.$item['fabricante'].'</option>';
        foreach($fabricantes as $item3){echo'<option value="'.$item3.'">'.$item3.'</option>';}
        echo'
    </select>
    </label>
    <label class="col-xs-6 col-lg-6 col-md-12 col-sm-12">Modelo
        <input type="text" class="form-control" name="modelo" value="'.$item['modelo'].'" placeholder="modelo" required/>
    </label>
    <label class="col-xs-6 col-lg-6 col-md-12 col-sm-12">Nº patrimonio
        <input type="text" class="form-control" name="npatrimonio" value="'.$item['npatrimonio'].'" placeholder="Nº patrimonio"/>
    </label>
    <label class="col-xs-6 col-lg-6 col-md-12 col-sm-12">Nº série
        <input type="text" class="form-control" name="nserie" value="'.$item['nserie'].'"  placeholder="Nº série"/>
    </label>
    <label class="col-xs-6 col-lg-6 col-md-12 col-sm-12">Sistema
    <input type="text" class="form-control" name="sistema" placeholder="Sistema"/>
    </label>
    <label class="col-xs-6 col-lg-6 col-md-12 col-sm-12">Build
        <select type="text" class="form-control" name="build">';
        if($item['build'] != ''){ echo'<option value="'.$item['build'].'">'.$item['build'].'</option>';}else{echo'<option value="">selecione</option>';}
            foreach($build as $item2){ echo'<option value="'.$item2.'">'.$item2.'</option>';}
        echo'
        <option value="">selecione</option>
        </select>
    </label>
    <label class="col-xs-6 col-lg-6 col-md-12 col-sm-12">MAC adress
        <input type="text" class="form-control" name="mac" value="'.$item['mac'].'"  placeholder="MAC"/>
    </label>
    <label class="col-xs-6 col-lg-6 col-md-12 col-sm-12">Local/Andar/Área
        <input type="text" class="form-control" name="local" value="'.$item['local'].'"  placeholder="Local/Andar/Área"/>
    </label>
    <label class="col-xs-6 col-lg-6 col-md-12 col-sm-12">Observação
        <textarea rows="2" class="form-control" name="observacao" placeholder="Observação">'.AspasForm($item['observacao']).'</textarea>
    </label>
    <label class="col-xs-6 col-lg-6 col-md-12 col-sm-12">Quantidade
        <input type="text" class="form-control" name="quantidade" value="'.$item['quantidade'].'"  placeholder="Quantidade"/>
    </label>
    <label class="col-xs-6 col-lg-6 col-md-12 col-sm-12">Satus
        <select type="text" class="form-control" name="status" placeholder="Satus" required>
            <option value="'.$item['status'].'">'.$item['status'].'</option>
            <option value="Em uso">Em uso</option>
            <option value="Back-up">Back-up</option>
            <option value="Danificado">Danificado</option>		
            <option value="Descarte">Descarte</option>		
        </select>
    </label>
    <label class="col-xs-6 col-lg-6 col-md-12 col-sm-12">Almoxarifado
    <select type="text" class="form-control" name="almoxarifado" placeholder="Almoxarifado">
        <option value="'.$item['almoxarifado'].'">'.$item['almoxarifado'].'</option>';
        $sql3 = $conpdo->prepare("SELECT estoque.almoxarifado FROM estoque GROUP BY almoxarifado ORDER BY almoxarifado ASC");
        $sql3->execute();
        $result3 = $sql3->fetchAll(PDO::FETCH_ASSOC);
        foreach($result3 as $item3){
            echo'<option value="'.$item3['almoxarifado'].'">'.$item3['almoxarifado'].'</option>';
        }
        echo'
        <option value="">selecione</option>
    </select>
    </label>  
    <label class="col-xs-6 col-lg-6 col-md-12 col-sm-12">Novo Almoxarifado
    <input type="text" class="form-control" name="novoalmoxarifado" placeholder="Novo Almoxarifado"/>
    </label>                                           
</div>';
}

?>