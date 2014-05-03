<?
error_reporting(0);
session_start();
require_once("../../engine/conexao.php");
include_once("../../engine/funcoes.php");
logadoAdmin();

if($_GET){
    extract($_GET);

    $SQL = "SELECT * ,DATE_FORMAT(data_inicio, '%d/%m/%Y') as data_inicioFor, DATE_FORMAT(data_fim, '%d/%m/%Y') as data_fimFor FROM eventos WHERE id = $id";
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

  if($data_inicio == ""){
    $erros["data_inicio"] = "Campo obrigatorio";
  }

  if($empresa_id == 0){
    $erros["empresa_id"] = "Campo obrigatorio";
  }

  if($resumo == ""){
    $erros["resumo"] = "Campo obrigatorio";
  }


 if($erros == NULL){

      if(is_uploaded_file($_FILES["logo_evento"]["tmp_name"])){

          $SQL = "SELECT imagem_logo FROM eventos WHERE id = $noticia_id";

          $fotoAtual = mysql_result(mysql_query($SQL),0);

          $caminhoAtual = "./arquivos/$noticia_id/logo/".$fotoAtual;
          @unlink($caminhoAtual);

          $arquivo = str_replace(" ","_",$_FILES["logo_evento"]["name"]);
          $destino = "./arquivos/$noticia_id/logo/".$arquivo;

      
          if(is_uploaded_file($_FILES['logo_evento']['tmp_name'])){
              copy($_FILES['logo_evento']['tmp_name'], $destino); 
          }

          $SQL = "UPDATE eventos SET imagem_logo = '$arquivo' WHERE id = $noticia_id;";
          mysql_query($SQL) or die($SQL." - ".mysql_error());



      }


      if(is_uploaded_file($_FILES["imagem"]["tmp_name"])){

          $SQL = "SELECT imagem FROM eventos WHERE id = $noticia_id";

          $fotoAtual = mysql_result(mysql_query($SQL),0);

          $caminhoAtual = "./arquivos/$noticia_id/".$fotoAtual;
          @unlink($caminhoAtual);

          $arquivo = str_replace(" ","_",$_FILES["imagem"]["name"]);
          $destino = "./arquivos/$noticia_id/".$arquivo;

      
          if(is_uploaded_file($_FILES['imagem']['tmp_name'])){
              copy($_FILES['imagem']['tmp_name'], $destino);       
          }

          $SQL = "UPDATE eventos SET imagem = '$arquivo' WHERE id = $noticia_id;";
          mysql_query($SQL) or die($SQL." - ".mysql_error());

      }    

      $data_inicio = dataToBD($data_inicio);
      $data_fim = dataToBD($data_fim);

      //$resumo = addslashes($resumo);

      $SQL = "UPDATE eventos SET
              titulo = '$titulo', 
              data_inicio = '$data_inicio',
              data_fim = '$data_fim',
              resumo = '$resumo', 
              site = '$site', 
              empresa_id = $empresa_id,
              local = local
              WHERE id = $noticia_id;";

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
            <span class="mws-i-24 i-list">Alterar Evento</span>
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
                              <input type="text" id ="data_inicio" name="data_inicio" value="<?=$data_inicioFor;?>" class="mws-textinput"/>
                              <?php   exibeErros($erros['data_inicio']);  ?>
                            </div>
                        </div>

                        <div class="mws-form-row">
                            <label for="data_fim">Data Fim</label>
                            <div class="mws-form-item large">
                              <input type="text" id ="data_fim" name="data_fim" value="<?=$data_fimFor;?>" class="mws-textinput"/>
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
                              <option value="<?=$linha['id'];?>" <?marcaSelect($linha['id'], $empresa_id)?> ><?=$linha['nome'];?></option>
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
                                <label for="logo_evento">Logo evento - 113px X 113px</label>
                                <div class="mws-form-item large">
                                  <input type="file" id ="logo_evento" name="logo_evento" value="" class="mws-fileinput"/>
                                  <?php   exibeErros($erros['logo_evento']);  ?>
                                </div>
                        </div>
                        
                          <div class="mws-form-row">
                            <img src="./arquivos/<?=$id;?>/logo/<?=$imagem_logo;?>" alt="<?=$nome;?>" width="113px"/>
                        </div>


                        <div class="mws-form-row">
                                <label for="imagem">Imagem -<small style="color:red">Tamanho mínimo 200px X 150px e máximo 800px X 600px</small></label>
                                <div class="mws-form-item large">
                                  <input type="file" id ="imagem" name="imagem" value="" class="mws-fileinput"/>
                                  <?php   exibeErros($erros['imagem']);  ?>
                                </div>
                        </div>

                          <div class="mws-form-row">
                            <img src="./arquivos/<?=$id;?>/<?=$imagem;?>" alt="<?=$nome;?>" width="200px"/>
                        </div>
          </div>
           <div class="mws-button-row">
                  <input type="hidden" name="noticia_id" value="<?=$id;?>" class="mws-button red" />
                  <input type="submit" value="Alterar" class="mws-button red" />
                  <input type="reset" value="Limpar" class="mws-button gray" />
          </div>
      </div>     
      </div>
    
      </form>



<? include("../rodape.php")?>