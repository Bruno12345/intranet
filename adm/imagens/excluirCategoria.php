<?
error_reporting(0);
session_start();
require_once("../../engine/conexao.php");
require_once("../../engine/funcoes.php");
logadoAdmin();


if($_GET){
   extract($_GET);

   $SQL1 = "DELETE FROM categoria_imagens WHERE id = $id;";
   $resultado = mysql_query($SQL1) or die($SQL." - ".mysql_error());
   header("location: index.php");

}
?>
