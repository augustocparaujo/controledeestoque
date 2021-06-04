<?php
include('topo.php');
echo'
    <section class="content">
        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="col-lg-4 col-md-4 col-sm-4"><h2>TABELA - '.$unidade.'</h2></div>
                            <div class="col-lg-2 col-md-2 col-sm-2"></div>
                            <div class="col-lg-2 col-md-2 col-sm-2"></div>
                            <div class="col-lg-2 col-md-2 col-sm-2"></div>
                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <button type="button" class="btn bg-indigo waves-effect" data-toggle="modal" data-target="#addEquipamento"><i class="material-icons">add</i><span>  EQUIPAMENTO</span></button>
                            </div>
                            <div class="row"></div>
                            </div>
                        <div class="body">
                            <div class="table-responsive" style="font-size:12px !important">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Localidade</th>
                                            <th>Tipo</th>
                                            <th>Fabricante</th>
                                            <th>Modelo</th>
                                            <th>Nº patrimônio</th>
                                            <th>Nº série</th>
                                            <th>Sistema/Build</th>
                                            <th>MAC adress</th>
                                            <th>Localização do equipamento</th>
                                            <th>QNT</th>                                         
                                            <th>Satus</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Localidade</th>
                                            <th>Tipo</th>
                                            <th>Fabricante</th>
                                            <th>Modelo</th>
                                            <th>Nº patrimônio</th>
                                            <th>Nº série</th>
                                            <th>Sistema/Build</th>
                                            <th>MAC adress</th>
                                            <th>Localização do equipamento</th>  
                                            <th>QNT</th>                                                                                   
                                            <th>Status</th>                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>';
                                    $sql = $conpdo->prepare("SELECT * FROM estoque WHERE localidade LIKE '%$unidade'");
                                    $sql->execute();
                                    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($result as $item0){
                                        echo'
                                            <tr onclick="alterar('.$item0['id'].')" title="'.$item0['observacao'].'">
                                                <td>'.$item0['localidade'].'</td>
                                                <td>'.$item0['tipo'].'</td>
                                                <td>'.$item0['fabricante'].'</td>
                                                <td>'.$item0['modelo'].'</td>
                                                <td>'.$item0['npatrimonio'].'</td>
                                                <td>'.$item0['nserie'].'</td>
                                                <td>'.$item0['sistema'].'-'.$item0['build'].'</td>
                                                <td>'.$item0['mac'].'</td>
                                                <td>'.$item0['local'].'</td> 
                                                <td>'.$item0['quantidade'].'</td>                                           
                                                <td>';
                                                    if($item0['status'] == 'Em uso'){echo'<span class="badge bg-orange">'.$item0['status'].'</span>';}
                                                    elseif($item0['status'] == 'Back-up'){echo'<span class="badge bg-teal">'.$item0['status'].'</span>';}
                                                    elseif($item0['status'] == 'Danificado'){echo'<span class="badge bg-pink">'.$item0['status'].'</span>';}
                                                    else{echo'<span class="badge bg-black">'.$item0['status'].'</span>';}
                                                echo'
                                                </td>
                                            </tr>';
                                    }echo'
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>
    
    <!-- add equipamento -->
    <div class="modal fade in" id="addEquipamento" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Adicionar equipamento</h4>
                </div>
                <form method="post" id="formadd">
                <div class="modal-body">
                    <div class="row">
                        <input type="text" class="form-control" id="unidadelocal" name="localidade" value="'.$unidade.'" style="display:none" required/>
                        <label class="col-xs-6 col-lg-6 col-md-12 col-sm-12">Tipo
                        <select type="text" class="form-control" name="tipo" required>
                            <option value="">selecione</option>';
                            foreach($tipo as $item){echo'<option value="'.$item.'">'.$item.'</option>';}
                            echo'
                        </select>
                        </label>
                        <label class="col-xs-6 col-lg-6 col-md-12 col-sm-12">Fabricante
                        <select type="text" class="form-control" name="fabricante" required>
                            <option value="">selecione</option>';
                            foreach($fabricantes as $item){echo'<option value="'.$item.'">'.$item.'</option>';}
                            echo'
                        </select>
                        </label>
                        <label class="col-xs-6 col-lg-6 col-md-12 col-sm-12">Modelo
                            <input type="text" class="form-control" name="modelo" placeholder="Modelo"/>
                        </label>
                        <label class="col-xs-6 col-lg-6 col-md-12 col-sm-12">Nº patrimônio
                            <input type="text" class="form-control" name="npatrimonio" placeholder="Nº patrimonio"/>
                        </label>
                        <label class="col-xs-6 col-lg-6 col-md-12 col-sm-12">Nº série
                            <input type="text" class="form-control" name="nserie" placeholder="Nº série"/>
                        </label>
                        <label class="col-xs-6 col-lg-6 col-md-12 col-sm-12">Sistema
                        <input type="text" class="form-control" name="sistema" placeholder="Sistema"/>
                        </label>
                        <label class="col-xs-6 col-lg-6 col-md-12 col-sm-12">Build
                            <select type="text" class="form-control" name="build">
                            <option value="">selecione</option>';
                                foreach($build as $item2){ echo'<option value="'.$item2.'">'.$item2.'</option>';}
                            echo'
                            </select>
                        </label>
                        <label class="col-xs-6 col-lg-6 col-md-12 col-sm-12">MAC adress
                            <input type="text" class="form-control" name="mac" placeholder="MAC"/>
                        </label>
                        <label class="col-xs-6 col-lg-6 col-md-12 col-sm-12">Local/Andar/Área
                            <input type="text" class="form-control" name="local" placeholder="Local/Andar/Área"/>
                        </label>
                        <label class="col-xs-6 col-lg-6 col-md-12 col-sm-12">Observação
                            <textarea rows="2" class="form-control" name="observacao" placeholder="Observação"></textarea>
                        </label>
                        <label class="col-xs-6 col-lg-6 col-md-12 col-sm-12">Quantidade
                            <input type="text" class="form-control" name="quantidade" placeholder="Quantidade"/>
                        </label>
                        <label class="col-xs-6 col-lg-6 col-md-12 col-sm-12">Status
                            <select type="text" class="form-control" name="status" placeholder="Status" required>
                                <option value="">selecione</option>
                                <option value="Em uso">Em uso</option>
                                <option value="Back-up">Back-up</option>
                                <option value="Danificado">Danificado</option>		
                                <option value="Descarte">Descarte</option>
                                <option value="Sucata">Sucata</option>
                            </select>
                        </label>
                        <label class="col-xs-6 col-lg-6 col-md-12 col-sm-12">Almoxarifado
                        <select type="text" class="form-control" name="almoxarifado" placeholder="Almoxarifado">
                            <option value="">selecione</option>';
                            $sql3 = $conpdo->prepare("SELECT estoque.almoxarifado FROM estoque GROUP BY almoxarifado ORDER BY almoxarifado ASC");
                            $sql3->execute();
                            $result3 = $sql3->fetchAll(PDO::FETCH_ASSOC);
                            foreach($result3 as $item3){
                                echo'<option value="'.$item3['almoxarifado'].'">'.$item3['almoxarifado'].'</option>';
                            }
                            echo'
                        </select>
                        </label>
                        <label class="col-xs-6 col-lg-6 col-md-12 col-sm-12">Novo Almoxarifado
                            <input type="text" class="form-control" name="novoalmoxarifado" placeholder="Novo Almoxarifado"/>
                        </label>                                          
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">FECHAR</button>
                    <button type="submit" class="btn btn-link waves-effect">SALVAR</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- add equipamento -->

    <!-- alt equipamento -->
    <div class="modal fade in" id="altEquipamento" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Alterar equipamento</h4>
                </div>
                <form method="post" id="formalt">
                <div class="modal-body" id="retornoEquipamento">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">FECHAR</button>
                    <button type="submit" class="btn btn-link waves-effect">SALVAR</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- alt equipamento -->
    
    ';
include('rodape.php'); ?>
<script>
$('#ecoparque').addClass('active');
    //chama tabela
/*     $().ready(function(){ tabelaestoque();});
    function tabelaestoque(){
        $.ajax({
            type:'post',
            url:'tabela-estoque.php',
            data:'html',
            success:function(data)
                { $('#tab').show().html(data); }
        });
        return false;
    } */
    //incluir equipamento
    $('#formadd').submit(function(){
        $('#addEquipamento').modal('hide');
        $.ajax({
            type:'post',
            url:'insert-equipamento.php',
            data:$('#formadd').serialize(),
            success:function(data)
                { 
                    $('#retorno').show().html(data); 
                    $('#formadd').each(function(){this.reset();});
                    history.go();
                }
        });
        return false;
    });
    function alterar(id){
        $('#altEquipamento').modal('show');
        $.get('retorno-equipamento.php',{id:id},function(data){
            $('#retornoEquipamento').show().html(data);
        });
        return false;
    };
     //alterar equipamento
     $('#formalt').submit(function(){
        $('#altEquipamento').modal('hide');
        $.ajax({
            type:'post',
            url:'insert-equipamento.php',
            data:$('#formalt').serialize(),
            success:function(data)
                { 
                    $('#retorno').show().html(data); 
                    history.go();                }
        });
        return false;
    });
</script>