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

  if($descricao == ""){
    $erros["descricao"] = "Campo obrigatorio";
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


  if(is_uploaded_file($_FILES["foto1"]["tmp_name"])){

      $extensao       = @strtolower(end(explode(".",$_FILES["foto1"]["name"])));

      if(($extensao != "jpg") && ($extensao != "png") && ($extensao != "gif")){
              $erros["imagem"] = "Extens&atilde;o n&atilde;o permitida.";
      }
  }



  if(is_uploaded_file($_FILES["foto2"]["tmp_name"])){

      $extensao       = @strtolower(end(explode(".",$_FILES["foto2"]["name"])));

      if(($extensao != "jpg") && ($extensao != "png") && ($extensao != "gif")){
              $erros["imagem"] = "Extens&atilde;o n&atilde;o permitida.";
      }
  }


 if($erros == NULL){

   if(isset($_FILES["imagem"]["tmp_name"])){

      $arquivo    = str_replace(" ","_",$_FILES["imagem"]["name"]);
      $foto1    = str_replace(" ","_",$_FILES["foto1"]["name"]);
      $foto2    = str_replace(" ","_",$_FILES["foto2"]["name"]);

      //$descricao = addslashes($descricao);

      $SQL = "INSERT INTO empresa VALUES(DEFAULT,  '$nome', '$descricao', '$site', '$arquivo', '', '$foto1', '$foto2');";
      mysql_query($SQL) or die($SQL." - ".mysql_error());
      $id_local = mysql_insert_id();

      @mkdir("./arquivos", 0705);

      $pasta = "./arquivos/".$id_local;

      @mkdir($pasta, 0705);

      $destino = $pasta."/". $arquivo;
      
      if(is_uploaded_file($_FILES['imagem']['tmp_name'])){
          copy($_FILES['imagem']['tmp_name'], $destino);
      }

      $path = "./arquivos/".$id_local."/imagens"; 

      @mkdir($path, 0705);

      $destino = $path."/". $foto1;
      
      if(is_uploaded_file($_FILES['foto1']['tmp_name'])){
          copy($_FILES['foto1']['tmp_name'], $destino);
      } 

      $destino = $path."/". $foto2;
      
      if(is_uploaded_file($_FILES['foto2']['tmp_name'])){
          copy($_FILES['foto2']['tmp_name'], $destino);
      }

      $_SESSION['msg'] = "Empresa inserida com sucesso.";
      header("location: index.php");

    }else{

      //$descricao = addslashes($descricao);

       $SQL = "INSERT INTO empresa VALUES(DEFAULT, '$nome', '$descricao', '$site', '', '');";
      mysql_query($SQL) or die($SQL." - ".mysql_error());
      $id_local = mysql_insert_id();

      $_SESSION['msg'] = "Empresa inserida com sucesso.";
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
            $("#data").datepicker($.datepicker.regional["pt-BR"]);
            $("#data").datepicker("option", "dateFormat", "dd/mm/yy");
    });
-->
</script>
<script type="text/javascript" src="../../engine/ckeditor/ckeditor.js"></script>
    <form class="mws-form" action="" method="post" enctype="multipart/form-data">
    <div class="mws-panel grid_8">
       <div class="mws-panel-header">
            <span class="mws-i-24 i-list">Inserir Empresa</span>
       </div>
        <div class="mws-panel-body">
                 <div class="mws-form-block">

                        <div class="mws-form-row">
                            <label for="titulo">Nome</label>
                            <div class="mws-form-item large">
                              <input type="text" id ="nome" name="nome" value="<?=$nome;?>" class="mws-textinput"/>
                              <?php   exibeErros($erros['nome']);  ?>
                            </div>
                        </div>

                         <div class="mws-form-row">
                            <label for="titulo">Site</label>
                            <div class="mws-form-item large">
                              <input type="text" id ="site" name="site" value="<?=$site;?>" class="mws-textinput"/>
                              <?php   exibeErros($erros['site']);  ?>
                            </div>
                        </div>
    

                        <div class="mws-form-row">
                                <label>Descrição</label>
                                <div class="mws-form-item large">
                                   <textarea name="descricao"  class="ckeditor" rows="100%" cols="100%"><?=$descricao;?></textarea>
                                   <?php   exibeErros($erros['descricao']);  ?>
                                </div>
                        </div>

                                           

                        <div class="mws-form-row">
                                <label for="imagem">LOGO *<small style="color:red">Apenas imagens formato PNG com fundo transparente com 310px larg. X 100px Alt.</small></label>
                                <div class="mws-form-item large">
                                  <input type="file" id ="imagem" name="imagem" value="" class="mws-fileinput"/>
                                  <?php   exibeErros($erros['imagem']);  ?>
                                </div>
                        </div>

                        <div class="mws-form-row">
                                <label for="foto1">Foto 01 - <small style="color:red">Tamanhos: min. 330px X 248px e máx. 800px X 600px</small></label>
                                <div class="mws-form-item large">
                                  <input type="file" id ="foto1" name="foto1" value="" class="mws-fileinput"/>
                                  <?php   exibeErros($erros['foto1']);  ?>
                                </div>
                        </div>

                        <div class="mws-form-row">
                                <label for="foto2">Foto 02 - <small style="color:red">Tamanhos: min. 330px X 248px e máx. 800px X 600px</small></label>
                                <div class="mws-form-item large">
                                  <input type="file" id ="foto2" name="foto2" value="" class="mws-fileinput"/>
                                  <?php   exibeErros($erros['foto2']);  ?>
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