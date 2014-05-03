<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$FILESIZE = 1*1024*1024; // 1 Mb


function exibeErros($variavel){
    if(isset($variavel)){
        echo "<div class='mws-error'>";
        echo $variavel;
        echo " </div>";
        unset($variavel);
    }
}

function exibeMsg($variavel){
    if(isset($variavel)){
        echo "<div class='mws-erro'>";
        echo $variavel;
        echo "</div>";
        unset($variavel);
    }
}


function marcaSelect($variavel1, $variavel2){
    if($variavel1 == $variavel2){
        echo "selected ='selected'";
    }
}

//passa um vetor e o elemento
function marcaCheckbox($variavel1, $variavel2){
   if(in_array($variavel2, $variavel1) == TRUE){
        echo "checked ='checked'";

   }
}

function dataToBD($variavel){
    $vetor = explode("/", $variavel);
    $data = $vetor[2]."-".$vetor[1]."-".$vetor[0];
    return $data;
}


function dataToUser($variavel){
    $vetor = explode("-", $variavel);
    $data = $vetor[0]."/".$vetor[1]."/".$vetor[2];
    return $data;
}

function valorToBD($variavel){
    $resposta = str_replace(",",".", $variavel);
    return $resposta;
}

function valorToUser($variavel){
    $resposta = str_replace(".",",", $variavel);
    return $resposta;
}


function logado(){
    if($_SESSION['acesso_guia'] != 1){
		echo "<html><script>alert('Por favor, faca o login');window.top.location='index.php'</script></html>";
    }
}

function logadoAdmin(){
	  if($_SESSION['acesso_guia'] != 1){
			echo "<html><script>window.top.location='../index.php'</script></html>";
    }
}

function alternaLink($tipo,$id){

    if($tipo == "genero"){
        echo "genero.php?id=$id";
    }
     if($tipo == "categoria"){
        echo "categoria.php?id=$id";
    }
     if($tipo == "eventos"){
        echo "evento.php?id=$id";
    }

}


function modificaFrame($frame){
    $variavel = str_replace('"', '|', $frame);
    $variavel = str_replace("'", "|", $variavel);
    $variavel = str_replace('<', '_', $variavel);
    return $variavel;

}


function corrigeFrame($frame){
    $variavel = str_replace( "|","'", $frame);
    $variavel = str_replace('_','<', $variavel);
    return $variavel;

}

function curPageURL() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on"){
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80"){
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    }else{
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
     echo $pageURL;

 }

 function geradorPassword($tamanho){
     $vogais = "aeiouyAEIOUY";
     $consoantes = "bcdefghijklmnpqrstvxzBCDFGHJKLMNPQRSTVXZ";
     $password = "";
     $alt = time()%2;
     for($i=0; $i<$tamanho;$i++){
         if($alt == 1){

             $password .= $consoantes[(rand()%strlen($consoantes))];
             $alt= 0;

         }else{
             $password .= $vogais[(rand()%strlen($vogais))];
             $alt= 1;

         }

     }
     return $password;
 }


 function exibeMes($variavel1){

    if($variavel1 == 1){
        return "jan";
    }
    if($variavel1 == 2){
        return "fev";
    }
    if($variavel1 == 3){
        return "mar";
    }
    if($variavel1 == 4){
        return "abr";
    }
    if($variavel1 == 5){
        return "mai";
    }
    if($variavel1 == 6){
        return "jun";
    }
    if($variavel1 == 7){
        return "jul";
    }
    if($variavel1 == 8){
        return "ago";
    }
    if($variavel1 == 9){
        return "set";
    }
    if($variavel1 == 10){
        return "out";
    }
    if($variavel1 == 11){
        return "nov";
    }
    if($variavel1 == 12){
        return "dez";
    }
}

function paginate(){
    $RECORDS = 3;

    if(isset($_GET["p"]) && is_numeric($_GET["p"]) && $_GET["p"]>0){
        $page = $_GET["p"];
    }else{
        $page = 1;
    }

    $start = ($page-1)*$RECORDS;
    return " LIMIT $start, $RECORDS";
}

function paginateTable($SQL,$pagina){
    $RECORDS = 3;
    $links = "";

    $countSet = mysql_query($SQL);
    $recordCount = mysql_num_rows($countSet);
    mysql_free_result($countSet);

    $pages = ceil($recordCount/$RECORDS);

    for($i=1; $i<=ceil($recordCount/$RECORDS); $i++){
	$pAtual = end(explode('=',$_SERVER ['REQUEST_URI']));
	if($i == $pAtual){
		$links .= "<a href=\"$pagina?p=$i\" class=\"patual\">$i</a>";
	}else{
		$links .= "<a href=\"$pagina?p=$i\">$i</a>";
	}

    }
    return $links;
}


function redEmail($email){

    $aux = explode('@',$email);
    $servidor = $aux[1];

    if($servidor == "glbr.com.br"){
      echo "http://webmail.glbr.com.br";
    }

    if($servidor == "fagga.com.br"){
      echo "http://webmail.fagga.com.br";
    }

    if($servidor == "revistayoubrasil.com.br"){
      echo "http://webmail.revistayoubrasil.com.br/src/login.php";
    }

    if($servidor == "revistalne.com.br"){
      echo "http://webmail.revistalne.com.br/src/login.php";
    }

    if($servidor == "glveredas.com"){
      echo "http://gmail.com/glveredas.com";
    }

    if($servidor == "riocentro.com.br"){
      echo "http://195.115.183.36";
    }

    if($servidor == "gl-events.com"){
      echo "#";
    }

    if($servidor == "hsbcarena.com.br"){
      echo "http://webmail.hsbcarena.com.br";
    }

    if($servidor == "glveredas.com.br"){
      echo "http://gmail.com/glveredas.com";
    }


}

?>