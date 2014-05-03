<?
error_reporting(0);
session_start();
require_once("../../engine/conexao.php");
include_once("../../engine/funcoes.php");
logadoAdmin();

if($_GET){
    extract($_GET);

    $SQL = "SELECT * ,DATE_FORMAT(data,'%d/%m/%Y') as dataFor FROM noticias WHERE id = $id";  
    $resultado = mysql_query($SQL);
    $linhas = mysql_fetch_array($resultado);
    extract($linhas);
}


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

      if(is_uploaded_file($_FILES["imagem"]["tmp_name"])){

          $SQL = "SELECT imagem FROM noticias WHERE id = $id";
          //echo $SQL."<br/>"; 

          $fotoAtual = mysql_result(mysql_query($SQL),0);
          //echo $fotoAtual."<br/>";

          $caminhoAtual = "./arquivos/$id/".$fotoAtual;
          //echo $caminhoAtual."<br/>";

          unlink($caminhoAtual);

          $arquivo = str_replace(" ","_",$_FILES["imagem"]["name"]);
          //echo $arquivo."<br/>";

          $destino = "./arquivos/$id/".$arquivo;
         // echo $destino."<br/>";
      
          if(is_uploaded_file($_FILES['imagem']['tmp_name'])){
              copy($_FILES['imagem']['tmp_name'], $destino);       
          }

          $SQL2 = "UPDATE noticias SET imagem = '$arquivo' WHERE id = $id;";
          mysql_query($SQL2) or die($SQL2." - ".mysql_error());

        

      }    

      $data = dataToBD($data);
      //$texto = addslashes($texto);

      $SQL = "UPDATE noticias SET
              titulo = '$titulo', 
              data = '$data', 
              texto = '$texto',
              fonte = '$fonte', 
              autor = '$autor',             
              empresa_id = $empresa_id              
              WHERE id = $id;";

      mysql_query($SQL) or die($SQL." - ".mysql_error());
      
      header("location: index.php");
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
            <span class="mws-i-24 i-list">Alterar Notícia</span>
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
                              <input type="text" id ="data" name="data" value="<?=$dataFor;?>" class="mws-textinput"/>
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
                              <option value="<?=$linha['id'];?>" <?marcaSelect($linha['id'], $empresa_id)?>><?=$linha['nome'];?></option>
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
                                   <textarea name="texto" class="ckeditor" rows="100%" cols="100%"><?=$texto;?></textarea>
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

                        <div class="mws-form-row">
                            <img src="./arquivos/<?=$id;?>/<?=$imagem;?>" alt="<?=$nome;?>" width="400px"/>
                        </div>
          </div>
           <div class="mws-button-row">
                  <input type="hidden" name="id" value="<?=$id;?>" class="mws-button red" />
                  <input type="submit" value="Alterar" class="mws-button red" />
                  <input type="reset" value="Limpar" class="mws-button gray" />
          </div>
      </div>     
      </div>
    
      </form>



<? include("../rodape.php")?>