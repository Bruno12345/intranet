<?
error_reporting(0);
session_start();
require_once("./engine/conexao.php");
include_once("./engine/funcoes.php");

if($_POST){

  extract($_POST);
  $erros = array();

  if($usuario == ""){
    $erros["usuario"] = "Campo obrigatorio";
  }

  if($senha == ""){
    $erros["senha"] = "Campo obrigatorio";
  }


  if($erros == NULL){

    $SQL = "SELECT COUNT(*) FROM usuarios WHERE email = '$usuario' AND senha = MD5('$senha')";
    $total = mysql_result(mysql_query($SQL),0);

    if($total == 1){

      $SQL2 = "SELECT id, nome, admin FROM usuarios WHERE email = '$usuario' AND senha = MD5('$senha')";
      $resultado = mysql_query($SQL2);
      $linha = mysql_fetch_array($resultado);
      extract($linha);

      $_SESSION['user_id'] = $id;
      $_SESSION['user_nome'] = $nome;
      $_SESSION['admin'] = $admin;
      $_SESSION['acesso_guia'] = TRUE;

      header("location: principal.php");


    }else{
      $erros["senha"] = "Login / Senha n&atilde;o cadastrados no sistema";
    }        

  }   
    
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="all" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />

<title>GL events Brasil | Intranet</title>
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/jcarousellite_1.0.1.min.js"></script>
<script type="text/javascript">
 <!--
    $(function() {
      $("#entrar").click(function(){
          $("#log").submit();
      });        
    });
-->
 </script>

</head>

<body>
<div id="container">
  <div id="topo">
  	<div id="logo">
    	<a href="index.php"><img src="images/topo/logo_gl.png" alt="GL events" title="GL events Brasil" width="300" height="80"  /></a>
    </div><!-- fim da div logo -->
    </div> <!--fim do topo-->
  
  <div id="conteudo">
  	<div id="login">
    	
        <div id="form-login">
        <h1 class="titulo-log">Seja bem vindo(a)</h1>
        	<form action="#" method="POST" id="log" name="log">
            	<table>
                <tr>
                		<td><label for="usuario">Usuário</label></td>
                		<td><input type="text" name="usuario" id="usuario" class="box-input" /></td>
                    <?php   exibeErros($erros['usuario']);  ?>
                </tr>
                <tr>
                    <td><label for="senha">Senha</label></td>
                		<td><input type="password" name="senha" id="senha" class="box-input"  /></td>
                    <?php   exibeErros($erros['senha']);  ?>
       		     </tr>
               <tr>
                	<td></td>
                	<td class="bt"><input type="image" src="./images/btn-login.png" id="entrar" name="entrar" /></td>
               </tr>
              </table>        
            </form><!-- fim do form log -->
            <!--<p>Deseja reinicializar sua senha?&nbsp;<a href="lembrasenha.php">Clique aqui</a></p> -->
        </div><!-- fim div form-login -->
  	</div><!-- div login -->
    
  </div><!--Fim da div conteudo -->
  <div id="rodape">
	
  </div><!-- Fim da div rodape -->

</div><!--Fim da div container-->


<!--[if lt IE 8]>
  <script src="http://ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
<![endif]-->
</body>
</html>
