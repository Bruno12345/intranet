<?
error_reporting(0);
session_start();
require_once("../../engine/conexao.php");
include_once("../../engine/funcoes.php");
logadoAdmin();


if($_POST){
	extract($_POST);

	$erros = array();

	if($nome == ""){
		$erros["nome"] = "Campo obrigatorio";
	}

  if($email == ""){
    $erros["email"] = "Campo obrigatorio";
  }

 /* if($empresa_id == 0){
    $erros["empresa_id"] = "Campo obrigatorio";
  } */

  if($setores_id == 0){
    $erros["setores_id"] = "Campo obrigatorio";
  }

  if($cargo_id == 0){
    $erros["cargo_id"] = "Campo obrigatorio";
  }

  if($nascimento == ""){
    $erros["nascimento"] = "Campo obrigatorio";
  }

  if($telefone == ""){
    $erros["telefone"] = "Campo obrigatorio";
  }

  if($senha == ""){
    $erros["senha"] = "Campo obrigatorio";
  }

  if(is_uploaded_file($_FILES["imagem"]["tmp_name"])){

      $extensao       = @strtolower(end(explode(".",$_FILES["imagem"]["name"])));

      if(($extensao != "jpg") && ($extensao != "png") && ($extensao != "gif")){
              $erros["imagem"] = "Extens&atilde;o n&atilde;o permitida.";
      }else{
          if($_FILES["imagem"]["size"] > $FILESIZE){
              $erros["imagem"] = "Tamanho superior a 1MB.";
          }
      }
  }


 if($erros == NULL){

   if(isset($_FILES["imagem"]["tmp_name"])){

      $arquivo    = str_replace(" ","_",$_FILES["imagem"]["name"]);
      $vetor = explode("/", $nascimento);
      $nascimento_dia = $vetor[0];
      $nascimento_mes = $vetor[1];

      $SQL = "INSERT INTO usuarios VALUES(DEFAULT,  '$nome', '$email', '$nascimento_dia', '$nascimento_mes', '$telefone', '$ramal', MD5('$senha'), '$arquivo', $empresa_id, $cargo_id, $setores_id,  0, $admin);";
      mysql_query($SQL) or die($SQL." - ".mysql_error());
      $id_local = mysql_insert_id();

      @mkdir("./arquivos", 0705);

      $pasta = "./arquivos/".$id_local;

      @mkdir($pasta, 0705);

      $destino = $pasta."/". $arquivo;
      
      if(is_uploaded_file($_FILES['imagem']['tmp_name'])){
          copy($_FILES['imagem']['tmp_name'], $destino);
      }

      $_SESSION['msg'] = "Usuario inserido com sucesso.";
      header("location: index.php");

    }else{

      $vetor = explode("/", $nascimento);
      $nascimento_dia = $vetor[0];
      $nascimento_mes = $vetor[1];

      $SQL = "INSERT INTO usuarios VALUES(DEFAULT,  '$nome', '$email', '$nascimento_dia', '$nascimento_mes', '$telefone', '$ramal', MD5('$senha'), '', $empresa_id, $cargo_id, $setores_id, 0, $admin);";
      mysql_query($SQL) or die($SQL." - ".mysql_error());

      $_SESSION['msg'] = "Usuario inserido com sucesso.";
      header("location: index.php");
   }
  }
}

include("../topo.php");

?>
<link type="text/css" href="../../engine/css/smoothness/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
<script type="text/javascript" src="../../engine/js/jquery-ui-1.8.20.custom.min.js"></script>
<script type="text/javascript" src="../../engine/js/i18n/jquery.ui.datepicker-pt-BR.js"></script>
<script type="text/javascript">
<!--
    $(function() {
            $("#nascimento").datepicker($.datepicker.regional["pt-BR"]);
            $("#nascimento").datepicker("option", "dateFormat", "dd/mm");
    });
-->
</script>
    <form class="mws-form" action="" method="post" enctype="multipart/form-data">
    <div class="mws-panel grid_8">
       <div class="mws-panel-header">
            <span class="mws-i-24 i-list">Inserir Usuario</span>
       </div>
        <div class="mws-panel-body">
                 <div class="mws-form-block">

                        <div class="mws-form-row">
                            <label for="nome">Nome</label>
                            <div class="mws-form-item large">
                              <input type="text" id ="nome" name="nome" value="<?=$nome;?>" class="mws-textinput"/>
                              <?php   exibeErros($erros['nome']);  ?>
                            </div>
                        </div>

                         <div class="mws-form-row">
                            <label for="email">Email</label>
                            <div class="mws-form-item large">
                              <input type="text" id ="email" name="email" value="<?=$email;?>" class="mws-textinput"/>
                              <?php   exibeErros($erros['email']);  ?>
                            </div>
                        </div>

                         <div class="mws-form-row">
                          <label for="empresa_id">Empresa</label>
                          <div class="mws-form-item large">
                              <select name="empresa_id">
                                <option value="0">Selecione uma op&ccedil;&atilde;o</option>
                                <?
                                $SQL = "SELECT * FROM empresa ORDER BY nome";
                                $resultado = mysql_query($SQL);
                                while($linha = mysql_fetch_array($resultado)){
                                ?>
                                <option value="<?=$linha['id'];?>" <?marcaSelect($linha['id'], $empresa_id)?>><?=$linha['nome'];?></option>
                                <?php
                                }
                                ?>
                              </select>
                          <?php   exibeErros($erros['empresa_id']);  ?>
                          </div>
                        </div>  

                         <div class="mws-form-row">
                          <label for="setores_id">Setores</label>
                          <div class="mws-form-item large">
                              <select name="setores_id">
                                <option value="0">Selecione uma op&ccedil;&atilde;o</option>
                                <?
                                $SQL = "SELECT * FROM setores ORDER BY nome";
                                $resultado = mysql_query($SQL);
                                while($linha = mysql_fetch_array($resultado)){
                                ?>
                                <option value="<?=$linha['id'];?>" <?marcaSelect($linha['id'], $setores_id)?>><?=$linha['nome'];?></option>
                                <?php
                                }
                                ?>
                              </select>
                          <?php   exibeErros($erros['setores_id']);  ?>
                          </div>
                        </div>  

                         <div class="mws-form-row">
                          <label for="cargo_id">Cargos</label>
                          <div class="mws-form-item large">
                              <select name="cargo_id">
                                <option value="0">Selecione uma op&ccedil;&atilde;o</option>
                                <?
                                $SQL = "SELECT * FROM cargos ORDER BY nome";
                                $resultado = mysql_query($SQL);
                                while($linha = mysql_fetch_array($resultado)){
                                ?>
                                <option value="<?=$linha['id'];?>" <?marcaSelect($linha['id'], $cargo_id)?>><?=$linha['nome'];?></option>
                                <?php
                                }
                                ?>
                              </select>
                          <?php   exibeErros($erros['cargo_id']);  ?>
                          </div>
                        </div>  

                        <div class="mws-form-row">
                            <label for="nascimento">Data de Nascimento</label>
                            <div class="mws-form-item large">
                              <input type="text" id ="nascimento" name="nascimento" value="<?=$nascimento;?>" class="mws-textinput"/>
                              <?php   exibeErros($erros['nascimento']);  ?>
                            </div>
                        </div>
                        
                         <div class="mws-form-row">
                            <label for="telefone">Telefone</label>
                            <div class="mws-form-item large">
                              <input type="text" id ="telefone" name="telefone" value="<?=$telefone;?>" class="mws-textinput"/>
                              <?php   exibeErros($erros['telefone']);  ?>
                            </div>
                        </div>      

                         <div class="mws-form-row">
                            <label for="ramal">Ramal</label>
                            <div class="mws-form-item large">
                              <input type="text" id ="ramal" name="ramal" value="<?=$ramal;?>" class="mws-textinput"/>
                              <?php   exibeErros($erros['ramal']);  ?>
                            </div>
                        </div>       

                         <div class="mws-form-row">
                            <label for="senha">Senha</label>
                            <div class="mws-form-item large">
                              <input type="password" id ="senha" name="senha" value="<?=$senha;?>" class="mws-textinput"/>
                              <?php   exibeErros($erros['senha']);  ?>
                            </div>
                        </div> 
                        <div class="mws-form-row">
                            <label>Administrador</label>
                            <div class="mws-form-item large">
                              <input type="radio"  name="admin" value="0"/>Não
                              <input type="radio"  name="admin" value="1"/>Sim                   
                            </div>
                        </div>                   

                        <div class="mws-form-row">
                                <label for="imagem">Foto - <small style="color:red">Tamanhos: min. 75px X 75px e máx. 200px X 200px</small></label>
                                <div class="mws-form-item large">
                                  <input type="file" id ="imagem" name="imagem" value="" class="mws-fileinput"/>
                                </div>
                        </div>
          </div>
           <div class="mws-button-row">
                  <input type="submit" value="Inserir" class="mws-button red" />
                  <input type="reset" value="Limpar" class="mws-button gray" />
          </div>
      </div>     
      </div>
      </form>




<? include("../rodape.php")?>