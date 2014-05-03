<?
error_reporting(0);
session_start();
require_once("../../engine/conexao.php");
require_once("../../engine/funcoes.php");
logadoAdmin();

if($_GET){
    extract($_GET);


   $SQL = "SELECT imagem FROM noticias WHERE id = $id";
   $foto = mysql_result(mysql_query($SQL),0);   

   $caminho = "./arquivos/$id/".$foto;   
   @unlink($caminho); 

   $path = "./arquivos/$id";
   @rmdir($path);

   $SQL = "DELETE FROM noticias WHERE id = $id;";
   $resultado = mysql_query($SQL) or die($SQL." - ".mysql_error());
   header("location: index.php");
}

?>
