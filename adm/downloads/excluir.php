<?
error_reporting(0);
session_start();
require_once("../../engine/conexao.php");
require_once("../../engine/funcoes.php");
logadoAdmin();


if($_GET){
   extract($_GET);

   $SQL = "SELECT arquivo FROM downloads WHERE id = $id";
   $arquivoAtual = mysql_result(mysql_query($SQL),0);

   $caminhoAtual1 = "./arquivos/$id/arquivo/".$arquivoAtual;
   @unlink($caminhoAtual1);

   $path = "./arquivos/$id/arquivo/";
   @rmdir($path);

   $SQL = "SELECT imagem FROM downloads WHERE id = $id";
   $fotoAtual = mysql_result(mysql_query($SQL),0);

   $caminhoAtual2 = "./arquivos/$id/".$fotoAtual;
   @unlink($caminhoAtual2);

   $path2 = "./arquivos/$id/";
   @rmdir($path2);
   
   $SQL1 = "DELETE FROM downloads WHERE id = $id;";
   mysql_query($SQL1) or die($SQL." - ".mysql_error());
   header("location: index.php");

}
?>
