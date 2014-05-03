<?
error_reporting(0);
session_start();
require_once("./engine/conexao.php");
include_once("./engine/funcoes.php");

if($_POST){
  extract($_POST);
  $erros = array();

  if($email == ""){
    $erros['email'] = "Campo obrigatorio.";

  }

  if($erros == null){

    $SQL = "SELECT nome, email FROM usuarios WHERE email = '$email' LIMIT 1";
    $resultado = mysql_query($SQL);
    $total = mysql_num_rows($resultado);
    
    if($total != 1){
      header("location:index.php");
    }else{

      $linha = mysql_fetch_array($resultado);
      extract($linha);

      $senhaUser = geradorPassword(8);
      //Envio de e-mail com senha alterada

      require_once('./engine/mail/class.phpmailer.php');
      require_once('./engine/mail/class.smtp.php');

      // Instanciamos a classe
      $mail = new PHPMailer();

      // Informamos que a classe ira enviar o email por SMTP
      $mail->isSMTP();

      // Configuração de SMTP
      $mail->SMTPSecure = "tls"; 
      $mail->Host = "smtp.googlemail.com";
      $mail->SMTPAuth = true;
      $mail->SMTPDebug = true;
      $mail->Port     = 465;
      $mail->Username = "glbrintranetbrasil@gmail.com";
      $mail->Password = "intranet102030";

      // na classe, há a opção de idioma, setei como br
      $mail->SetLanguage("br","./engine/mail/language/");

      // configura o charset do e-mail
      $mail->CharSet = 'utf8';

      // Iremos enviar o email no formato HTML
      $mail->IsHTML(true);
      
      // email do remetente da mensagem
      $mail->From = "glbrintranet@glbrintranet.com.br";

      // nome do remetente do email
      $mail->FromName = "GL Eventos Intranet";

      // Endereço de destino do email, ou seja, pra onde você quer que a mensagem do formulário vá?
      $mail->AddAddress($email,$nome);

      // informando no email, o assunto da mensagem
      $mail->Subject = "Alteração de senha - GL Eventos Intranet";

    
      // Define o texto da mensagem (aceita HTML)
      $mail->Body = "<h3><strong>Senhor(a) $nome,</strong></h3>
                  <p>Sua senha foi alterada pelo administrador do sistema.</p>
                  <p>
                  Aqui segue seu login e senha para que o senhor(a) tenha acesso a sua área administrativa
                  <ul>
                  <li>Login: $email</li>
                  <li>Senha: $senhaUser</li>
                  </ul>
                  </p>";

      if($mail->Send()) {
          $SQL = "UPDATE usuarios SET senha = MD5('$senhaUser') WHERE email = '$email'";
          mysql_query($SQL)or die(mysql_error());   
          $_SESSION['msg'] = "Alteração de senha do aluno $nome enviada com sucesso.";
          header("location: index.php");
      }else{
        $mail->Error();
      }
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

<title>GL-events Brasil | Intranet</title>
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
    	<a href="principal.html"><img src="images/topo/logo_gl.png" alt="GL events" title="GL events Brasil" width="300" height="80"  /></a>
    </div><!-- fim da div logo -->
    </div> <!--fim do topo-->
  
  <div id="conteudo">
  	<div id="login">
    	
        <div id="form-login">
        <h1 class="titulo-log">Digite seu email para recuperação de sua senha</h1>
        	<form action="" method="post" id="log" name="log">
            	<table>
                <tr>
                		<td><label for="email">Email</label></td>
                		<td><input type="text" name="email" id="email" class="box-input" /></td>
                    <?php   exibeErros($erros['email']);  ?>
                </tr>
                <tr>
                	<td></td>
                	<td class="bt"><input type="image" src="./images/btn-login.png" id="entrar" name="entrar" /></td>
               </tr>
              </table>        
            </form><!-- fim do form log -->           
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
