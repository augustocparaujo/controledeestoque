<?php
//arrays
$tipo = array('Adpatador','Bateria Notebook','Bateria RF','Carregador','Desktop','Impressora','IMPRESSORA TÉRMICA (ZEBRA)','Headset','HD','Bateria','Memória','Monitor','Notebook','Teclado','Toner','Tablet','Mouse','Ramal IP','RF','Switch','Scanner de Mão','Scanner de Mesa','Outro');
//fabricantas
$fabricantes = array('DELL','HP','LENOVO','MOTOROLA','AOC','CISCO','PLANTRONICS','MICROSOFT','CANON','ZEBRA','SYMBOL','SAMSUNG','INTERMEC TECHNOLOGIES CORP','OUTRO');
//build winddows
$build = array('20h2','1909','1809','1709','1607','OUTRO');

function alert($msg){
    echo'<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible bg-black p-r-35 animated rotateInUpRight" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; top: 20px; right: 20px;"><button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button><span data-notify="icon"></span> <span data-notify="title"></span> <span data-notify="message">'.$msg.'</span><a href="#" target="_blank" data-notify="url"></a></div>'; 
    echo"<script>$().ready(function(){ window.setTimeout(function() { $('.alert').addClass('rotateOutUpRight'); }, 2500); });</script>";
}

function verificaBuild(){
    echo'<div class="alert bg-red">Lorem ipsum dolor sit amet, id fugit tollit pro, illud nostrud aliquando ad est, quo esse dolorum id</div>';
    echo'<div class="alert bg-green">Lorem ipsum dolor sit amet, id fugit tollit pro, illud nostrud aliquando ad est, quo esse dolorum id</div>';

}

//verifica
function verificaBrech(){
    include('conexao.php');
    @$iduserVerifica = $_SESSION['iduser'];

    //verifica se o usuário está ativo e tem session
    if (isset($iduserVerifica) != true) { echo '<script>location.href="sair.php";</script>'; }

    //verifica em que session o usuário está logado e ativo
  /*   $sql = $conpdo->prepare("SELECT * FROM usuario WHERE id_user=:verifica");
    $sql->bindValue(":verifica", $iduserVerifica);
    $sql->execute();
    $dados_vv = $sql->fetch(PDO::FETCH_ASSOC);
    if ($_SESSION['brech2'] != $dados_vv['brech2']){  echo '<script>location.href="sair.php";</script>';} */
}

//permissao atualzia��o //recebe informa��es vindas do array de permiss�o
function Permissao($item,$id){
    include('conexao.php');
    @$data = date('Y-m-d H:m:s');
    @$iduser = $_SESSION['iduser'];
    @$usuario = $_SESSION['nomeuser']; //pega usuario que est� executando a a��o
    @$ip = $_SERVER['REMOTE_ADDR']; // pegar ip da maquina
    @$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']); //pega nome da maquina

    $sql = $conpdo->prepare("SELECT * FROM permissoes WHERE usuario=:id AND item=:item");
    $sql->bindValue(':id',$id);
    $sql->bindValue(':item',$item);
    $sql->execute();
    if($sql->rowCount() >= 1){ 
        $sql = $conpdo->prepare("UPDATE permissoes SET valor=:ativo,usuariocad=:usuariocad,datacad=:datacad WHERE usuario=:id AND item=:item");
        $sql->bindValue(':id',$id);
        $sql->bindValue(':item',$item);
        $sql->bindValue(':ativo','ativo');
        $sql->bindValue(':usuariocad',$usuario);
$sql->bindValue(':datacad',$data);
        $sql->execute();
    }else{
        $sql = $conpdo->prepare("INSERT INTO permissoes (usuario,item,valor,usuariocad,datacad) VALUES (:id,:item,:ativo,:usuariocad,:datacad)");
        $sql->bindValue(':id',$id);
        $sql->bindValue(':item',$item);
        $sql->bindValue(':ativo','ativo');
        $sql->bindValue(':usuariocad',$usuario);
        $sql->bindValue(':datacad',$data);
        $sql->execute();
    }
};

//fun��o verifica se existem libera��o apra acesso ao menu
function PermissaoCheck($item,$id){
     include('conexao.php');
    $sql = $conpdo->prepare("SELECT * FROM permissoes WHERE usuario=:id AND item=:item AND valor=:ativo");
    $sql->bindValue(':id',$id);
    $sql->bindValue(':item',$item);	
    $sql->bindValue(':ativo','ativo');
    $sql->execute();
    if($sql->rowCount() >= 1 ){ 
        return 'checked';
    }
};

//fun��o limpa ponto e tra�o
function limpaCPF_CNPJ($valor){
$valor = trim($valor);
$valor = str_replace(".", "", $valor);
$valor = str_replace(",", "", $valor);
$valor = str_replace("-", "", $valor);
$valor = str_replace("/", "", $valor);
return $valor;
};

function Moeda($get_valor) {
$source = array('.', ',');
$replace = array('', '.');
$valor = str_replace($source, $replace, $get_valor); //remove os pontos e substitui a virgula pelo ponto
if(empty($valor)){return 0;}else{return $valor;} //retorna o valor formatado para gravar no banco
};//moeda

function Moeda2($valor) {
$valor = number_format($valor,2);
$source = array(',', '.');
$replace = array('.', '');
$valor = str_replace($source, $replace, $valor);
return $valor;
};//moeda2

function Real($valor){ if($valor==true){ return number_format($valor,2,',','.');} else { return '0,00';}};

/* //case de meses por valor
switch (date("m")) {
    case "01":    @$mes = Janeiro;     break;
    case "02":    @$mes = Fevereiro;   break;
    case "03":    @$mes = Mar�o;       break;
    case "04":    @$mes = Abril;       break;
    case "05":    @$mes = Maio;        break;
    case "06":    @$mes = Junho;       break;
    case "07":    @$mes = Julho;       break;
    case "08":    @$mes = Agosto;      break;
    case "09":    @$mes = Setembro;    break;
    case "10":    @$mes = Outubro;     break;
    case "11":    @$mes = Novembro;    break;
    case "12":    @$mes = Dezembro;    break; 
}; */

//idadeCerta
function idadeCerta($nascimento){
    // Declara a data! :P
    $data = $nascimento;
    // Separa em dia, m�s e ano
    list($dia, $mes, $ano) = explode('-', $data);
    // Descobre que dia � hoje e retorna a unix timestamp
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    // Descobre a unix timestamp da data de nascimento do fulano
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    // Depois apenas fazemos o c�lculo j� citado :)
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
    return $idade;
};

function AspasForm($string){
	$string = str_replace('"',chr(146).chr(146), $string);
	$string = str_replace("'",chr(146), $string);
	return $string;
};

function AspasBanco($string){
	$string = str_replace(chr(146).chr(146),'"', $string);
	$string = str_replace(chr(146),"'",$string);
	return addslashes($string);
};

function url_amigavel($string){
    $table = array(
        '�'=>'S', '�'=>'s', '�'=>'D', 'd'=>'d', '�'=>'Z',
        '�'=>'z', 'C'=>'C', 'c'=>'c', 'C'=>'C', 'c'=>'c',
        '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'A',
        '�'=>'A', '�'=>'A', '�'=>'C', '�'=>'E', '�'=>'E',
        '�'=>'E', '�'=>'E', '�'=>'I', '�'=>'I', '�'=>'I',
        '�'=>'I', '�'=>'N', '�'=>'O', '�'=>'O', '�'=>'O',
        '�'=>'O', '�'=>'O', '�'=>'O', '�'=>'U', '�'=>'U',
        '�'=>'U', '�'=>'U', '�'=>'Y', '�'=>'B', '�'=>'Ss',
        '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'a',
        '�'=>'a', '�'=>'a', '�'=>'c', '�'=>'e', '�'=>'e',
        '�'=>'e', '�'=>'e', '�'=>'i', '�'=>'i', '�'=>'i',
        '�'=>'i', '�'=>'o', '�'=>'n', '�'=>'o', '�'=>'o',
        '�'=>'o', '�'=>'o', '�'=>'o', '�'=>'o', '�'=>'u',
        '�'=>'u', '�'=>'u', '�'=>'y', '�'=>'y', '�'=>'b',
        '�'=>'y', 'R'=>'R', 'r'=>'r',  );
    // Traduz os caracteres em $string, baseado no vetor $table
    $string = strtr($string, $table);
    // converte para min�sculo
    $string = strtolower($string);
    // remove caracteres indesej�veis (que n�o est�o no padr�o)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    // Remove m�ltiplas ocorr�ncias de h�fens ou espa�os
    $string = preg_replace("/[\s-]+/", " ", $string);
    // Transforma espa�os e underscores em h�fens
    $string = preg_replace("/[\s_]/", " ", $string);
    // retorna a string
    return $string;
};//url_amigavel

?>