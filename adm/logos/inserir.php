<?
error_reporting(0);
session_start();
require_once("../../engine/conexao.php");
include_once("../../engine/funcoes.php");
logadoAdmin();


if($_POST){
	extract($_POST);

	$erros = array();

  if($categoria_id == 0){
    $erros["categoria_id"] = "Campo obrigatorio";
  }  

  if(!is_uploaded_file($_FILES["imagem"]["tmp_name"])){
     $erros["imagem"] = "Campo Obrigatorio.";
  }


 if($erros == NULL){

   if(isset($_FILES["imagem"]["tmp_name"])){

      $arquivo    = str_replace(" ","_",$_FILES["imagem"]["name"]);
      
      $SQL = "INSERT INTO logos VALUES(DEFAULT, '$arquivo', $categoria_id);";
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

    }
  }
}

include("../topo.php");

?>

    <form class="mws-form" action="" method="post" enctype="multipart/form-data">
    <div class="mws-panel grid_8">
       <div class="mws-panel-header">
            <span class="mws-i-24 i-list">Inserir Logo</span>
       </div>
        <div class="mws-panel-body">
            <div class="mws-form-block">                                            
               <div class="mws-form-row">
                  <label for="categoria_id">Categoria</label>
                  <div class="mws-form-item large">
                      <select name="categoria_id">
                        <option value="0">Selecione uma op&ccedil;&atilde;o</option>
                        <?
                        $SQL = "SELECT * FROM categoria_logos ORDER BY nome";
                        $resultado = mysql_query($SQL);
                        while($linha = mysql_fetch_array($resultado)){
                        ?>
                        <option value="<?=$linha['id'];?>" <?marcaSelect($linha['id'], $categoria_id)?>><?=$linha['nome'];?></option>
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
          </div>
           <div class="mws-button-row">
                  <input type="submit" value="Inserir" class="mws-button red" />
                  <input type="reset" value="Limpar" class="mws-button gray" />
          </div>
      </div>     
      </div>
      </form>




<? include("../rodape.php")?>