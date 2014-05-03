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

  

 if($erros == NULL){

    $SQL = "INSERT INTO categoria_media VALUES(DEFAULT, '$nome');";
    mysql_query($SQL) or die($SQL." - ".mysql_error());

    $_SESSION['msg'] = "Categoria com inserida sucesso.";
    header("location: index.php");
   
  }
}

include("../topo.php");

?>
<form class="mws-form" action="" method="post" enctype="multipart/form-data">
  <div class="mws-panel grid_8">
    <div class="mws-panel-header">
      <span class="mws-i-24 i-list">Inserir Categoria</span>
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
      </div>
      <div class="mws-button-row">
            <input type="submit" value="Inserir" class="mws-button red" />
            <input type="reset" value="Limpar" class="mws-button gray" />
      </div>
    </div>     
  </div>
</form>




<? include("../rodape.php")?>