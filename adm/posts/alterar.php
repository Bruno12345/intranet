<?
error_reporting(0);
session_start();
require_once("../../engine/conexao.php");
include_once("../../engine/funcoes.php");
logadoAdmin();

if($_GET){
    extract($_GET);

    $SQL = "SELECT * FROM posts WHERE id = $id";
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

  if($descricao == ""){
    $erros["descricao"] = "Campo obrigatorio";
  }

  if($setores_id == 0){
    $erros["setores_id"] = "Campo obrigatorio";
  }

  if($erros == NULL){            

      //$descricao = addslashes($descricao);

      $SQL = "UPDATE posts SET
              titulo = '$titulo',                 
              texto = '$descricao',             
              setores_id = $setores_id                                   
              WHERE id = $empresa_id;";

      mysql_query($SQL) or die($SQL." - ".mysql_error());

      header("location: index.php");
  }  

}


include("../topo.php");
?>

<script type="text/javascript" src="../../engine/ckeditor/ckeditor.js"></script>
    <form class="mws-form" action="" method="post" enctype="multipart/form-data">
    <div class="mws-panel grid_8">
       <div class="mws-panel-header">
            <span class="mws-i-24 i-list">Alterar Politica</span>
       </div>
        <div class="mws-panel-body">
                 <div class="mws-form-block">

                 <div class="mws-form-row">
                 <div class="mws-form-row">
                      <label for="titulo">Titulo</label>
                      <div class="mws-form-item large">
                        <input type="text" id ="titulo" name="titulo" value="<?=$titulo;?>" class="mws-textinput"/>
                        <?php   exibeErros($erros['titulo']);  ?>
                      </div>
                  </div>

                  <div class="mws-form-row">
                    <label for="categoria_id">Setores</label>
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
                      <label>Texto</label>
                      <div class="mws-form-item large">
                         <textarea name="descricao" class="ckeditor" rows="100%" cols="100%"><?=$texto;?></textarea>
                         <?php   exibeErros($erros['descricao']);  ?>
                      </div>
                  </div>     
          </div>
           <div class="mws-button-row">
                        <input type="hidden" name="empresa_id" value="<?=$id;?>" class="mws-button red" />
                        <input type="submit" value="Alterar" class="mws-button red" />
                        <input type="reset" value="Limpar" class="mws-button gray" />
          </div>
      </div>
       
        
       
      </div>
      </form>



<? include("../rodape.php")?>