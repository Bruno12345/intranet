<?
error_reporting(0);
session_start();
require_once("../../engine/conexao.php");
require_once("../../engine/funcoes.php");
logadoAdmin();


if($_GET){
   extract($_GET);

   $SQL = "SELECT fotos, categoria_fotos_id AS categoria FROM fotos WHERE id = $id;";
   $resultado = mysql_query($SQL) or die($SQL." - ".mysql_error());
   $linha = mysql_fetch_array($resultado);
   extract($linha);

   $path = "./arquivos/$categoria/$fotos";
   @unlink($path);
  
   $SQL1 = "DELETE FROM fotos WHERE id = $id;";
   $resultado = mysql_query($SQL1) or die($SQL." - ".mysql_error());
   header("location: index.php");

}
?>
