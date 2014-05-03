<?
error_reporting(0);
session_start();
require_once("../../engine/conexao.php");
include_once("../../engine/funcoes.php");
logadoAdmin();

if($_GET){
    extract($_GET);

    $SQL = "SELECT * FROM imagens WHERE id = $id";
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

  if(is_uploaded_file($_FILES["imagem"]["tmp_name"])){

      $extensao       = @strtolower(end(explode(".",$_FILES["imagem"]["name"])));

      if(($extensao != "jpg") && ($extensao != "png") && ($extensao != "gif")){
              $erros["imagem"] = "Extens&atilde;o n&atilde;o permitida.";
      }
  }

  if($erros == NULL){

      if(is_uploaded_file($_FILES["imagem"]["tmp_name"])){

        $SQL = "SELECT imagem FROM imagens WHERE id = $id";
        $fotoAtual = mysql_result(mysql_query($SQL),0);

        $caminhoAtual = "./arquivos/$id/".$fotoAtual;
        @unlink($caminhoAtual);

        $arquivo = str_replace(" ","_",$_FILES["imagem"]["name"]);
        $destino = "./arquivos/$id/".$arquivo;
    
        if(is_uploaded_file($_FILES['imagem']['tmp_name'])){
            copy($_FILES['imagem']['tmp_name'], $destino);       
        }           

        $SQL = "UPDATE imagens SET categoria_imagens_id = $categoria_id, imagem = '$arquivo' WHERE id = $id;";
        mysql_query($SQL) or die($SQL." - ".mysql_error());
        header("location: index.php");

      }else{    

        $SQL = "UPDATE imagens SET categoria_imagens_id = $categoria_id WHERE id = $id;";
        mysql_query($SQL) or die($SQL." - ".mysql_error());
        header("location: index.php");
      }

    }  

}

include("../topo.php");
?>
    <form class="mws-form" action="" method="post" enctype="multipart/form-data">
    <div class="mws-panel grid_8">
       <div class="mws-panel-header">
            <span class="mws-i-24 i-list">Alterar Imagem</span>
       </div>
        <div class="mws-panel-body">
                 <div class="mws-form-block">

                <div class="mws-form-row">
                  <label for="categoria_id">Categoria</label>
                  <div class="mws-form-item large">
                      <select name="categoria_id">
                        <option value="0">Selecione uma op&ccedil;&atilde;o</option>
                        <?
                        $SQL = "SELECT * FROM categoria_imagens ORDER BY nome";
                        $resultado = mysql_query($SQL);
                        while($linha = mysql_fetch_array($resultado)){
                        ?>
                        <option value="<?=$linha['id'];?>" <?marcaSelect($linha['id'], $categoria_imagens_id)?>><?=$linha['nome'];?></option>
                        <?php
                        }
                        ?>
                      </select>
                  <?php   exibeErros($erros['categoria_id']);  ?>
                  </div>
                </div>                         

                <div class="mws-form-row">
                    <label for="imagem">Imagem</label>
                    <div class="mws-form-item large">
                      <input type="file" id ="imagem" name="imagem" value="" class="mws-fileinput"/>
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