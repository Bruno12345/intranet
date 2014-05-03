<?
error_reporting(0);
session_start();
require_once("../../engine/conexao.php");
include_once("../../engine/funcoes.php");
logadoAdmin();

if($_GET){
    extract($_GET);

    $SQL = "SELECT * FROM fotos WHERE categoria_fotos_id = $cat_id";
    $resultado = mysql_query($SQL);
    $linhas = mysql_fetch_array($resultado);
    extract($linhas);

}



if($_POST){

  extract($_POST);

	$erros = array();

  if($categoria_id == 0){
    $erros["categoria_id"] = "Campo obrigatorio";
  }

  if($erros == NULL){

      if(isset($foto_id)){
        foreach ($foto_id as $idFoto) {

            $SQL = "SELECT fotos FROM fotos WHERE id = $idFoto;";
            $imagem = mysql_result(mysql_query($SQL),0);
            
            $path = "./arquivos/$cat_id/$imagem";
            @unlink($path);
           
            $SQL = "DELETE FROM fotos WHERE id = $idFoto;";
            mysql_query($SQL);        

            $SQL = "UPDATE fotos SET categoria_fotos_id = $categoria_id WHERE id = $idFoto;";
            mysql_query($SQL) or die($SQL." - ".mysql_error());   
        }
      }
      header("location: index.php");
  }  

}

include("../topo.php");
?>
    <form class="mws-form" action="" method="post" enctype="multipart/form-data">
    <div class="mws-panel grid_8">
       <div class="mws-panel-header">
            <span class="mws-i-24 i-list">Alterar Arquivos</span>
       </div>
        <div class="mws-panel-body">
                 <div class="mws-form-block">

                <div class="mws-form-row">
                  <label for="categoria_id">Categoria</label>
                  <div class="mws-form-item large">
                      <select name="categoria_id">
                        <option value="0">Selecione uma op&ccedil;&atilde;o</option>
                        <?
                        $SQL = "SELECT * FROM categoria_fotos ORDER BY nome";
                        $resultado = mysql_query($SQL);
                        while($linha = mysql_fetch_array($resultado)){
                        ?>
                        <option value="<?=$linha['id'];?>" <?marcaSelect($linha['id'], $categoria_fotos_id)?>><?=$linha['nome'];?></option>
                        <?php
                        }
                        ?>
                      </select>
                  <?php   exibeErros($erros['categoria_id']);  ?>
                  </div>
                </div>                         

               <?php 
                
                $SQL = "SELECT id AS id_foto, fotos FROM fotos WHERE categoria_fotos_id = $cat_id;";
                $resultado  = mysql_query($SQL) or die(mysql_error());
                
                while($linha = mysql_fetch_array($resultado)){
                  extract($linha);
                ?>
                  <div class="mws-form-row">
                       <img src="./arquivos/<?=$cat_id?>/<?=$fotos?>" alt="<?=$fotos?>" width="200px"/>
                  </div>
                  <div class="mws-form-row">
                    <div class="mws-form-item large">
                        <input type="checkbox" id ="foto_id_<?=$id_foto;?>" name="foto_id[]" value="<?=$linha["id_foto"];?>" class="mws-fileinput"/> <label for="foto_id_<?=$linha["id_foto"];?>">Excluir Imagem</label>
                    </div>
                  </div>  
                <?            
                }
                ?>
          </div>
           <div class="mws-button-row">
                        <input type="hidden" name="id" value="<?=$cat_id;?>" class="mws-button red" />
                        <input type="submit" value="Alterar" class="mws-button red" />
                        <input type="reset" value="Limpar" class="mws-button gray" />
          </div>
      </div>
       
        
       
      </div>
      </form>



<? include("../rodape.php")?>