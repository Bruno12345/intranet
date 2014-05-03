<?
error_reporting(0);
session_start();
require_once("../../engine/conexao.php");
require_once("../../engine/funcoes.php");
logadoAdmin();


if($_GET){
   extract($_GET);

   $SQL = "SELECT foto1 FROM empresa WHERE id = $id;";
   $resultado = mysql_query($SQL) or die($SQL." - ".mysql_error());
   $nomeImagem = mysql_result($resultado, 0);


   $path = "./arquivos/$id/imagens/$nomeImagem";
   @unlink($path);

   $SQL = "SELECT foto2 FROM empresa WHERE id = $id;";
   $resultado = mysql_query($SQL) or die($SQL." - ".mysql_error());
   $nomeImagem = mysql_result($resultado, 0);


   $path = "./arquivos/$id/imagens/$nomeImagem";
   @unlink($path);


   $path = "./arquivos/$id/imagens";
   @rmdir($path);

   $SQL = "SELECT imagem FROM empresa WHERE id = $id;";
   $resultado = mysql_query($SQL) or die($SQL." - ".mysql_error());
   $nomeImagem = mysql_result($resultado, 0);


   $path = "./arquivos/$id/$nomeImagem";
   @unlink($path);
   

   $path = "./arquivos/$id";
   @rmdir($path);

   $SQL = "DELETE FROM empresa WHERE id = $id;";
   $resultado = mysql_query($SQL) or die($SQL." - ".mysql_error());
   header("location: index.php");
   


}

?>
