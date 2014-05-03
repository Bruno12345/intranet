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

  if($data == ""){
    $erros["data"] = "Campo obrigatorio";
  }

  if($empresa_id == 0){
    $erros["empresa_id"] = "Campo obrigatorio";
  }

  if($texto == ""){
    $erros["texto"] = "Campo obrigatorio";
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

      $data = dataToBD($data);
      //$texto = addslashes($texto);

      $imagem    = str_replace(" ","_",$_FILES["imagem"]["name"]);
     
      $SQL = "INSERT INTO noticias VALUES(DEFAULT, '$titulo', '$data', '$texto','$fonte', '$autor', '$imagem', $empresa_id);";
      mysql_query($SQL) or die($SQL." - ".mysql_error());
      $id_local = mysql_insert_id();

      @mkdir("./arquivos", 0705);

      $pasta = "./arquivos/".$id_local;

      @mkdir($pasta, 0705);

      $destino = $pasta."/". $imagem;
      
      if(is_uploaded_file($_FILES['imagem']['tmp_name'])){
          copy($_FILES['imagem']['tmp_name'], $destino);
      }      

     
      $_SESSION['msg'] = "Noticia inserida com sucesso.";
      header("location: index.php");

    }else{

      $data = dataToBD($data);      
     
      $SQL = "INSERT INTO noticias VALUES(DEFAULT, '$titulo', '$data', '$texto','$fonte', '$autor', '', $empresa_id);";
      mysql_query($SQL) or die($SQL." - ".mysql_error());
      
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
            $("#data").datepicker($.datepicker.regional["pt-BR"]);
            $("#data").datepicker("option", "dateFormat", "dd/mm/yy"); 
    });
-->
</script>
<script type="text/javascript" src="../../engine/ckeditor/ckeditor.js"></script>
    <form class="mws-form" action="" method="post" enctype="multipart/form-data">
    <div class="mws-panel grid_8">
       <div class="mws-panel-header">
            <span class="mws-i-24 i-list">Inserir Noticia</span>
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
                            <label for="data">Data</label>
                            <div class="mws-form-item large">
                              <input type="text" id ="data" name="data" value="<?=$data;?>" class="mws-textinput"/>
                              <?php   exibeErros($erros['data']);  ?>
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
                                   <textarea name="texto"  class="ckeditor" rows="100%" cols="100%"><?=$resumo;?></textarea>
                                   <?php   exibeErros($erros['texto']);  ?>
                                </div>
                        </div>


                        <div class="mws-form-row">
                            <label for="fonte">Fonte</label>
                            <div class="mws-form-item large">
                              <input type="text" id ="fonte" name="fonte" value="<?=$fonte;?>" class="mws-textinput"/>
                              
                            </div>
                        </div>

                          <div class="mws-form-row">
                            <label for="autor">Autor</label>
                            <div class="mws-form-item large">
                              <input type="text" id ="autor" name="autor" value="<?=$autor;?>" class="mws-textinput"/>                              
                            </div>
                        </div>

                    
                        <div class="mws-form-row">
                                <label for="imagem">Imagem - <small style="color:red;">* Tamanho min.250 x 188 pixels e max. 800 x 600 pixels</small> </label>
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