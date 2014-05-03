<?
error_reporting(0);
session_start();
require_once("../../engine/conexao.php");
include_once("../../engine/funcoes.php");
logadoAdmin();

if($_GET){
    extract($_GET);

    $SQL = "SELECT * FROM downloads WHERE id = $id";
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

  if($titulo == ""){
    $erros["titulo"] = "Campo obrigatorio";
  }

  if($descricao == ""){
    $erros["descricao"] = "Campo obrigatorio";
  }

  if($erros == NULL){

  
      $SQL = "UPDATE downloads SET 
      titulo = '$titulo', 
      descricao = '$descricao',
      categoria_downloads_id = $categoria_id
      WHERE id = $id;";  

      mysql_query($SQL) or die($SQL." - ".mysql_error());


    if(is_uploaded_file($_FILES["imagem"]["tmp_name"])){

        $SQL = "SELECT imagem FROM downloads WHERE id = $id";
        $fotoAtual = mysql_result(mysql_query($SQL),0);

        $caminhoAtual = "./arquivos/$id/".$fotoAtual;
        @unlink($caminhoAtual);

        $arquivo    = str_replace(" ","_",$_FILES["imagem"]["name"]); 

        @mkdir("./arquivos", 0705);

        $pasta = "./arquivos/".$id;

        @mkdir($pasta, 0705);

        $destino = $pasta."/". $arquivo;
        
        if(is_uploaded_file($_FILES['imagem']['tmp_name'])){
            copy($_FILES['imagem']['tmp_name'], $destino);
        }

        $SQL2 = "UPDATE  downloads SET imagem = '$arquivo' WHERE id = $id;";
        mysql_query($SQL2);
    }



     if(is_uploaded_file($_FILES["arquivo"]["tmp_name"])){

        $SQL = "SELECT arquivo FROM downloads WHERE id = $id";
        $fotoAtual = mysql_result(mysql_query($SQL),0);

        $caminhoAtual = "./arquivos/$id/arquivo/".$fotoAtual;
        @unlink($caminhoAtual);

        $file    = str_replace(" ","_",$_FILES["arquivo"]["name"]);

        @mkdir("./arquivos", 0705);

        $pasta = "./arquivos/".$id;

        @mkdir($pasta, 0705);


        $pasta2 = "./arquivos/".$id."/arquivo";

        @mkdir($pasta2, 0777);

        $destino = $pasta2."/". $file;

             
        if(is_uploaded_file($_FILES['arquivo']['tmp_name'])){
            copy($_FILES['arquivo']['tmp_name'], $destino);
        }

        $SQL3 = "UPDATE  downloads SET arquivo = '$file' WHERE id = $id;";
        mysql_query($SQL3);

     }         

      $_SESSION['msg'] = "Download inserido com sucesso.";
      header("location: index.php");
        
  }
}


include("../topo.php");
?>
    <form class="mws-form" action="" method="post" enctype="multipart/form-data">
    <div class="mws-panel grid_8">
       <div class="mws-panel-header">
            <span class="mws-i-24 i-list">Alterar Logo</span>
       </div>
        <div class="mws-panel-body">
                 <div class="mws-form-block">

                  <div class="mws-form-row">
                  <label for="categoria_id">Categoria</label>
                  <div class="mws-form-item large">
                      <select name="categoria_id">
                        <option value="0">Selecione uma op&ccedil;&atilde;o</option>
                        <?
                        $SQL = "SELECT * FROM categoria_downloads ORDER BY nome";
                        $resultado = mysql_query($SQL);
                        while($linha = mysql_fetch_array($resultado)){
                        ?>
                        <option value="<?=$linha['id'];?>" <?marcaSelect($linha['id'], $categoria_downloads_id)?>><?=$linha['nome'];?></option>
                        <?php
                        }
                        ?>
                      </select>
                  <?php   exibeErros($erros['categoria_id']);  ?>
                  </div>
                </div> 

                 <div class="mws-form-row">
                      <label for="titulo">Titulo</label>
                      <div class="mws-form-item large">
                        <input type="text" id ="titulo" name="titulo" value="<?=$titulo;?>" class="mws-textinput"/>
                        <?php   exibeErros($erros['titulo']);  ?>
                      </div>
                 </div>   

                <div class="mws-form-row">
                    <label>Descrição</label>
                    <div class="mws-form-item large">
                       <textarea name="descricao" rows="100%" cols="100%"><?=$descricao;?></textarea>
                       <?php   exibeErros($erros['descricao']);  ?>
                    </div>
                </div>                           

                <div class="mws-form-row">
                    <label for="imagem">Imagem - <small style="color:#FF0000;">Tamanho Máx. 150 X 113 pixels</small> </label>
                    <div class="mws-form-item large">
                      <input type="file" id ="imagem" name="imagem" value="" class="mws-fileinput"/>
                    </div>
                </div>

                <div class="mws-form-row">
                    <img src="./arquivos/<?=$id;?>/<?=$imagem;?>" alt="<?=$nome;?>" width="150px"/>
                </div> 

                <div class="mws-form-row">
                    <label for="arquivo">Arquivo</label>
                    <div class="mws-form-item large">
                      <input type="file" id ="arquivo" name="arquivo" value="" class="mws-fileinput"/>
                      <?php   exibeErros($erros['arquivo']);  ?>
                    </div>
                </div>

                 <div class="mws-form-row">
                    <a href="./arquivos/<?=$id;?>/arquivo/<?=$arquivo;?>"><?=$arquivo;?></a>
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