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

  if($link == ""){
    $erros["link"] = "Campo obrigatorio";
  }  

 if($erros == NULL){

  $SQL = "INSERT INTO sistemas VALUES(DEFAULT, '$nome','$link', $visivel);";
  mysql_query($SQL) or die($SQL." - ".mysql_error());
  
  $_SESSION['msg'] = "Setor inserida com sucesso.";
  header("location: index.php");
   
  }
}

include("../topo.php");

?>

    <form class="mws-form" action="" method="post" enctype="multipart/form-data">
    <div class="mws-panel grid_8">
       <div class="mws-panel-header">
            <span class="mws-i-24 i-list">Inserir Setor</span>
       </div>
        <div class="mws-panel-body">
            <div class="mws-form-block">
              <div class="mws-form-row">
                  <label for="nome">Nome</label>
                  <div class="mws-form-item large">
                    <input type="text" id ="nome" name="nome" value="<?=$nome;?>" class="mws-textinput"/>
                    <?php   exibeErros($erros['nome']);  ?>
                  </div>
              </div>  
              <div class="mws-form-row">
                  <label for="nome">Link</label>
                  <div class="mws-form-item large">
                    <input type="text" id ="link" name="link" value="<?=$link;?>" class="mws-textinput"/>
                    <?php   exibeErros($erros['link']);  ?>
                  </div>
              </div>  
              <div class="mws-form-row">
                  <label>Exibir no menu</label>
                  <div class="mws-form-item large">
                    <input type="radio"  name="visivel" value="0"/>Não
                    <input type="radio"  name="visivel" value="1"/>Sim                   
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