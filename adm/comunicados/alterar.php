<?
error_reporting(0);
session_start();
require_once("../../engine/conexao.php");
include_once("../../engine/funcoes.php");
logadoAdmin();

if($_GET){
    extract($_GET);

    $SQL = "SELECT * ,DATE_FORMAT(data, '%d/%m/%Y') as novaData FROM comunicados WHERE id = $id";
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

 if($texto == ""){
    $erros["texto"] = "Campo obrigatorio";
  }

  
 if($erros == NULL){     

    $data = dataToBD($data);      

    $SQL = "UPDATE comunicados SET
            titulo = '$titulo', 
            data = '$data', 
            texto = '$texto'            
            WHERE id = $comunicados_id;";

    mysql_query($SQL) or die($SQL." - ".mysql_error());

    $SQL2 = "UPDATE usuarios SET recado = 0 ;";
    mysql_query($SQL2);

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
            <span class="mws-i-24 i-list">Alterar Comunicados</span>
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
                    <input type="text" id ="data" name="data" value="<?=$novaData;?>" class="mws-textinput"/>
                    <?php   exibeErros($erros['data']);  ?>
                  </div>
              </div>                    

              <div class="mws-form-row">
                    <label>Texto</label>
                    <div class="mws-form-item large">
                       <textarea name="texto" class="ckeditor" rows="100%" cols="100%"><?=$texto;?></textarea>
                    </div>
              </div>                      
          </div>
           <div class="mws-button-row">
              <input type="hidden" name="comunicados_id" value="<?=$id;?>" class="mws-button red" />
              <input type="submit" value="Alterar" class="mws-button red" />
              <input type="reset" value="Limpar" class="mws-button gray" />
          </div>
      </div>
       
        
       
      </div>
      </form>



<? include("../rodape.php")?>