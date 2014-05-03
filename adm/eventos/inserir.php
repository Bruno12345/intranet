<?
error_reporting(0);
session_start();
require_once("../../engine/conexao.php");
include_once("../../engine/funcoes.php");
logadoAdmin();

if($_POST){
	extract($_POST);

	$erros = array();

	if($titulo == ""){
		$erros["titulo"] = "Campo obrigatorio";
	}

  if($data_inicio == ""){
    $erros["data_inicio"] = "Campo obrigatorio";
  }

  if($empresa_id == 0){
    $erros["empresa_id"] = "Campo obrigatorio";
  }

  if($resumo == ""){
    $erros["resumo"] = "Campo obrigatorio";
  }

  if(is_uploaded_file($_FILES["logo_evento"]["tmp_name"])){

      $extensao       = @strtolower(end(explode(".",$_FILES["logo_evento"]["name"])));

      if(($extensao != "jpg") && ($extensao != "png") && ($extensao != "gif")){
              $erros["logo_evento"] = "Extens&atilde;o n&atilde;o permitida.";
      }else{
          if($_FILES["logo_evento"]["size"] > $FILESIZE){
              $erros["logo_evento"] = "Tamanho superior a 1MB.";
          }
      }
  }else{
    $erros["logo_evento"] = "Campo obrigatorio";    
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
  }else{
    $erros["imagem"] = "Campo obrigatorio";    
  }


 if($erros == NULL){

   if(isset($_FILES["imagem"]["tmp_name"])){

      $data_inicio = dataToBD($data_inicio);
      $data_fim = dataToBD($data_fim);

      $imagem    = str_replace(" ","_",$_FILES["imagem"]["name"]);
      $logo_evento    = str_replace(" ","_",$_FILES["logo_evento"]["name"]);
      //$resumo = addslashes($resumo);

      $SQL = "INSERT INTO eventos VALUES(DEFAULT, '$titulo', '$data_inicio', '$data_fim','$resumo', '$site', $empresa_id, '$imagem', '$logo_evento','$local');";
      mysql_query($SQL) or die($SQL." - ".mysql_error());
      $id_local = mysql_insert_id();

      @mkdir("./arquivos", 0705);

      $pasta = "./arquivos/".$id_local;

      @mkdir($pasta, 0705);

      $destino = $pasta."/". $imagem;
      
      if(is_uploaded_file($_FILES['imagem']['tmp_name'])){
          copy($_FILES['imagem']['tmp_name'], $destino);
      }      


      $caminho = "./arquivos/".$id_local."/logo";

      @mkdir($caminho, 0705);

      $destino = $caminho."/". $logo_evento;

      if(is_uploaded_file($_FILES['logo_evento']['tmp_name'])){
          copy($_FILES['logo_evento']['tmp_name'], $destino);
      }      

      $_SESSION['msg'] = "Noticia inserida com sucesso.";
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
            $("#data_inicio").datepicker($.datepicker.regional["pt-BR"]);
            $("#data_inicio").datepicker("option", "dateFormat", "dd/mm/yy"); 

            $("#data_fim").datepicker($.datepicker.regional["pt-BR"]);
            $("#data_fim").datepicker("option", "dateFormat", "dd/mm/yy");
    });
-->
</script>
<script type="text/javascript" src="../../engine/ckeditor/ckeditor.js"></script>
    <form class="mws-form" action="" method="post" enctype="multipart/form-data">
    <div class="mws-panel grid_8">
       <div class="mws-panel-header">
            <span class="mws-i-24 i-list">Inserir Evento</span>
       </div>
        <div class="mws-panel-body">
                 <div class="mws-form-block">

                        <div class="mws-form-row">
                            <label for="titulo">Titulo</label>
                            <div class="mws-form-item large">
                              <input type="text" id ="titulo" name="titulo" value="<?=$titulo;?>" class="mws-textinput"/>
                              <?php   exibeErros($erros['titulo']);  ?>
                            </div>
                        </div>

                        <div class="mws-form-row">
                            <label for="data_inicio">Data Inicio</label>
                            <div class="mws-form-item large">
                              <input type="text" id ="data_inicio" name="data_inicio" value="<?=$data_inicio;?>" class="mws-textinput"/>
                              <?php   exibeErros($erros['data_inicio']);  ?>
                            </div>
                        </div>

                        <div class="mws-form-row">
                            <label for="data_fim">Data Fim</label>
                            <div class="mws-form-item large">
                              <input type="text" id ="data_fim" name="data_fim" value="<?=$data_fim;?>" class="mws-textinput"/>
                              <?php   exibeErros($erros['data_fim']);  ?>
                            </div>
                        </div>

                        <div class="mws-form-row">
                            <label for="local">Local</label>
                            <div class="mws-form-item large">
                              <input type="text" id ="local" name="local" value="<?=$local;?>" class="mws-textinput"/>
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
                              <option value="<?=$linha['id'];?>"><?=$linha['nome'];?></option>
                              <?php
                              }
                              ?>
                            </select>
                        <?php   exibeErros($erros['empresa_id']);  ?>
                        </div>
                      </div>


                        <div class="mws-form-row">
                                <label>Texto</label>
                                <div class="mws-form-item large">
                                   <textarea name="resumo" class="ckeditor" rows="100%" cols="100%"><?=$resumo;?></textarea>
                                   <?php   exibeErros($erros['resumo']);  ?>
                                </div>
                        </div>


                        <div class="mws-form-row">
                            <label for="site">Site - <small>Ex: www.nomedosite.com.br</small></label>
                            <div class="mws-form-item large">
                              <input type="text" id ="site" name="site" value="<?=$site;?>" class="mws-textinput"/>
                              
                            </div>
                        </div>

                        <div class="mws-form-row">
                                <label for="logo_evento">Logo evento - <small style="color:red;">113px X 113px</small></label>
                                <div class="mws-form-item large">
                                  <input type="file" id ="logo_evento" name="logo_evento" value="" class="mws-fileinput"/>
                                  <?php   exibeErros($erros['logo_evento']);  ?>
                                </div>
                        </div>

                        <div class="mws-form-row">
                                <label for="imagem">Imagem -<small style="color:red;">Tamanho mínimo 200px X 150px e máximo 800px X 600px</small></label>
                                <div class="mws-form-item large">
                                  <input type="file" id ="imagem" name="imagem" value="" class="mws-fileinput"/>
                                  <?php   exibeErros($erros['imagem']);  ?>
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