<?
error_reporting(0);
session_start();
require_once("../../engine/conexao.php");
require_once("../../engine/funcoes.php");
logadoAdmin();


if($_GET){
   extract($_GET);

   $SQL = "DELETE FROM posts WHERE id = $id;";
   $resultado = mysql_query($SQL) or die($SQL." - ".mysql_error());
   header("location: index.php");
}

?>
