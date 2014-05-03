<?
error_reporting(0);
session_start();
require_once("../../engine/conexao.php");
include_once("../../engine/funcoes.php");
logadoAdmin();

if($_GET){
    extract($_GET);

    $SQL = "SELECT * FROM tvs WHERE id = $id";
    $resultado = mysql_query($SQL);
    $linhas = mysql_fetch_array($resultado);
    extract($linhas);  
}

if($_POST){

  extract($_POST);

	$erros = array();

  if($tvfagga == ""){
    $erros["tvfagga"] = "Campo obrigatorio";
  }  

  if($tvriocentro == ""){
    $erros["tvriocentro"] = "Campo obrigatorio";
  }  

  if($tvmundo == ""){
    $erros["tvmundo"] = "Campo obrigatorio";
  }  

  if($tvhsbc == ""){
    $erros["tvhsbc"] = "Campo obrigatorio";
  }  

  if($erros == NULL){

    $tvfagga = modificaFrame($tvfagga);
    $tvriocentro = modificaFrame($tvriocentro);
    $tvmundo = modificaFrame($tvmundo);
    $tvhsbc = modificaFrame($tvhsbc);

      $SQL = "UPDATE tvs SET 
          tvfagga = '$tvfagga',
          tvmundo = '$tvmundo',
          tvriocentro = '$tvriocentro',
          tvhsbc = '$tvhsbc'
          WHERE id = $id;";
      mysql_query($SQL) or die($SQL." - ".mysql_error());
      header("location: index.php");
  }
}


include("../topo.php");
?>

    <form class="mws-form" action="" method="post" enctype="multipart/form-data">
    <div class="mws-panel grid_8">
       <div class="mws-panel-header">
            <span class="mws-i-24 i-list">Alterar TVS</span>
       </div>
        <div class="mws-panel-body">
            <div class="mws-form-block">

              <div class="mws-form-row">
                  <label for="tvfagga">TV Fagga</label>
                  <div class="mws-form-item large">
                    <input type="text" id ="tvfagga" name="tvfagga" value="<?=$tvfagga;?>" class="mws-textinput"/>
                    <?php   exibeErros($erros['tvfagga']);  ?>
                  </div>
              </div>    

               <div class="mws-form-row">
                  <label for="tvmundo">TV  Mundo</label>
                  <div class="mws-form-item large">
                    <input type="text" id ="tvmundo" name="tvmundo" value="<?=$tvmundo;?>" class="mws-textinput"/>
                    <?php   exibeErros($erros['tvmundo']);  ?>
                  </div>
              </div>    

               <div class="mws-form-row">
                  <label for="tvriocentro">TV Rio Centro</label>
                  <div class="mws-form-item large">
                    <input type="text" id ="tvriocentro" name="tvriocentro" value="<?=$tvriocentro;?>" class="mws-textinput"/>
                    <?php   exibeErros($erros['tvriocentro']);  ?>
                  </div>
              </div>    

               <div class="mws-form-row">
                  <label for="tvhsbc">TV HSBC</label>
                  <div class="mws-form-item large">
                    <input type="text" id ="tvhsbc" name="tvhsbc" value="<?=$tvhsbc;?>" class="mws-textinput"/>
                    <?php   exibeErros($erros['tvhsbc']);  ?>
                  </div>
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