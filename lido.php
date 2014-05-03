<?php
session_start();
require_once("./engine/conexao.php");
include_once("./engine/funcoes.php");

if($_POST){

    extract($_POST);
    $SQL = "UPDATE usuarios SET recado = 1 WHERE id = $id;";
    mysql_query($SQL) or die(mysql_error());
    
}
?>