<?
error_reporting(0);
session_start();
require_once("../../engine/conexao.php");
require_once("../../engine/funcoes.php");
logadoAdmin();


if($_GET){
   extract($_GET);

   $SQL = "SELECT imagem FROM logos WHERE id = $id;";
   $resultado = mysql_query($SQL) or die($SQL." - ".mysql_error());
   $nomeImagem = mysql_result($resultado, 0);


   $path = "./arquivos/$id/$nomeImagem";
   unlink($path);

   
   $path2 = "./arquivos/$id";
   rmdir($path2);

   $SQL1 = "DELETE FROM logos WHERE id = $id;";
   $resultado = mysql_query($SQL1) or die($SQL." - ".mysql_error());
   header("location: index.php");

}
?>
