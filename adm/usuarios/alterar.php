<?
error_reporting(0);
session_start();
require_once("../../engine/conexao.php");
include_once("../../engine/funcoes.php");
logadoAdmin();

if($_GET){
    extract($_GET);

    $SQL = "SELECT * FROM usuarios WHERE id = $id";
    $resultado = mysql_query($SQL);
    $linhas = mysql_fetch_array($resultado);
    extract($linhas);

    if(strlen($nascimento_dia) == 1){
      $nascimento_dia = "0".$nascimento_dia;
    }

    if(strlen($nascimento_mes) == 1){
      $nascimento_mes = "0".$nascimento_mes;
    }
    $dtNascimento = $nascimento_dia."/".$nascimento_mes."/00";
}



if($_POST){

  extract($_POST);

	$erros = array();

 if($nome == ""){
    $erros["nome"] = "Campo obrigatorio";
  }

  if($email == ""){
    $erros["email"] = "Campo obrigatorio";
  }

  if($empresa_id == 0){
    $erros["empresa_id"] = "Campo obrigatorio";
  }

  if($setores_id == 0){
    $erros["setores_id"] = "Campo obrigatorio";
  }

  if($cargos_id == 0){
    $erros["cargo_id"] = "Campo obrigatorio";
  }


  if($telefone == ""){
    $erros["telefone"] = "Campo obrigatorio";
  }



  if(is_uploaded_file($_FILES["imagem"]["tmp_name"])){

        $extensao       = @strtolower(end(explode(".",$_FILES["imagem"]["name"])));

        if(($extensao != "jpg") && ($extensao != "png") && ($extensao != "gif")){
                $erros["imagem"] = "Extens&atilde;o n&atilde;o permitida.";
        }else{
            if($_FILES["imagem"]["size"] > $FILESIZE){
                $erros["imagem"] = "Tamanho superior a 1MB.";
            }
        }
    }

    if($erros == NULL){

      if(is_uploaded_file($_FILES["imagem"]["tmp_name"])){

          $SQL = "SELECT imagem FROM usuarios WHERE id = $id";
          echo $SQL;
            
          $fotoAtual = mysql_result(mysql_query($SQL),0);

          $caminhoAtual = "./arquivos/$id/".$fotoAtual;
          @unlink($caminhoAtual);

          $arquivo = str_replace(" ","_",$_FILES["imagem"]["name"]);
          $destino = "./arquivos/$id/".$arquivo;

      
          if(is_uploaded_file($_FILES['imagem']['tmp_name'])){
              copy($_FILES['imagem']['tmp_name'], $destino);       
          }

        $vetor = explode("/", $nascimento);
        $nascimento_dia = $vetor[0];
        $nascimento_mes = $vetor[1];  

        if($senha == ""){

          $SQL = "UPDATE usuarios SET 
                  nome = '$nome', 
                  email = '$email', 
                  nascimento_dia = '$nascimento_dia', 
                  nascimento_mes = '$nascimento_mes', 
                  telefone = '$telefone', 
                  ramal = '$ramal',                  
                  imagem = '$arquivo', 
                  empresa_id = $empresa_id, 
                  cargos_id = $cargos_id, 
                  setores_id = $setores_id,
                  admin = $admin  
                  WHERE id = $id;";


        }else{

          $SQL = "UPDATE usuarios SET 
                  nome = '$nome', 
                  email = '$email', 
                  nascimento_dia = '$nascimento_dia', 
                  nascimento_mes = '$nascimento_mes', 
                  telefone = '$telefone', 
                  ramal = '$ramal', 
                  senha  = MD5('$senha'), 
                  imagem = '$arquivo', 
                  empresa_id = $empresa_id, 
                  cargos_id = $cargos_id, 
                  setores_id = $setores_id,
                  admin = $admin    
                  WHERE id = $id;";
        }            

          mysql_query($SQL) or die($SQL." - ".mysql_error());
          header("location: index.php");

      }else{

        
        $vetor = explode("/", $nascimento);
        $nascimento_dia = $vetor[0];
        $nascimento_mes = $vetor[1];  

       
        if($senha == ""){

          $SQL = "UPDATE usuarios SET 
                  nome = '$nome', 
                  email = '$email', 
                  nascimento_dia = '$nascimento_dia', 
                  nascimento_mes = '$nascimento_mes', 
                  telefone = '$telefone', 
                  ramal = '$ramal',                  
                  empresa_id = $empresa_id, 
                  cargos_id = $cargos_id, 
                  setores_id = $setores_id,
                  admin = $admin  
                  WHERE id = $id;";


        }else{

          $SQL = "UPDATE usuarios SET 
                  nome = '$nome', 
                  email = '$email', 
                  nascimento_dia = '$nascimento_dia', 
                  nascimento_mes = '$nascimento_mes', 
                  telefone = '$telefone', 
                  ramal = '$ramal', 
                  senha  = MD5('$senha'), 
                  empresa_id = $empresa_id, 
                  cargos_id = $cargos_id, 
                  setores_id = $setores_id, 
                  admin = $admin
                  WHERE id = $id;";
        }

        mysql_query($SQL) or die($SQL." - ".mysql_error());
        header("location: index.php");

      }


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
            $("#nascimento").datepicker($.datepicker.regional["pt-BR"]);
            $("#nascimento").datepicker("option", "dateFormat", "dd/mm");
    });
-->
</script>

    <form class="mws-form" action="" method="post" enctype="multipart/form-data">
    <div class="mws-panel grid_8">
       <div class="mws-panel-header">
            <span class="mws-i-24 i-list">Alterar Usuário</span>
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
                            <label for="email">Email</label>
                            <div class="mws-form-item large">
                              <input type="text" id ="email" name="email" value="<?=$email;?>" class="mws-textinput"/>
                              <?php   exibeErros($erros['email']);  ?>
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
                          <label for="setores_id">Setores</label>
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
                          <label for="cargos_id">Cargos</label>
                          <div class="mws-form-item large">
                              <select name="cargos_id">
                                <option value="0">Selecione uma op&ccedil;&atilde;o</option>
                                <?
                                $SQL = "SELECT * FROM cargos ORDER BY nome";
                                $resultado = mysql_query($SQL);
                                while($linha = mysql_fetch_array($resultado)){
                                ?>
                                <option value="<?=$linha['id'];?>" <?marcaSelect($linha['id'], $cargos_id)?>><?=$linha['nome'];?></option>
                                <?php
                                }
                                ?>
                              </select>
                          <?php   exibeErros($erros['cargos_id']);  ?>
                          </div>
                        </div>  

                        <div class="mws-form-row">
                            <label for="nascimento">Data de Nascimento</label>
                            <div class="mws-form-item large">
                              <input type="text" id ="nascimento" name="nascimento" value="<?=$dtNascimento;?>" class="mws-textinput"/>
                              <?php   exibeErros($erros['nascimento']);  ?>
                            </div>
                        </div>
                        
                         <div class="mws-form-row">
                            <label for="telefone">Telefone</label>
                            <div class="mws-form-item large">
                              <input type="text" id ="telefone" name="telefone" value="<?=$telefone;?>" class="mws-textinput"/>
                              <?php   exibeErros($erros['telefone']);  ?>
                            </div>
                        </div>      

                         <div class="mws-form-row">
                            <label for="ramal">Ramal</label>
                            <div class="mws-form-item large">
                              <input type="text" id ="ramal" name="ramal" value="<?=$ramal;?>" class="mws-textinput"/>
                              <?php   exibeErros($erros['ramal']);  ?>
                            </div>
                        </div>       

                         <div class="mws-form-row">
                            <label for="senha">Senha</label>
                            <div class="mws-form-item large">
                              <input type="text" id ="senha" name="senha" value="" class="mws-textinput"/>
                     
                            </div>
                        </div> 
                         <div class="mws-form-row">
                            <label>Administrador</label>
                            <div class="mws-form-item large">
                              <input type="radio"  name="admin" value="0" <? if($admin == 0){ echo "checked='checked'";} ?>/>Não
                              <input type="radio"  name="admin" value="1" <? if($admin == 1){ echo "checked='checked'";} ?>/>Sim                   
                            </div>
                        </div>                                         

                        <div class="mws-form-row">
                                <label for="imagem">Foto - <small style="color:red">Tamanhos: min. 75px X 75px e máx. 200px X 200px</small></label>
                                <div class="mws-form-item large">
                                  <input type="file" id ="imagem" name="imagem" value="" class="mws-fileinput"/>
                                </div>
                        </div>
                         <div class="mws-form-row">
                            <img src="./arquivos/<?=$id;?>/<?=$imagem;?>" alt="<?=$nome;?>" width="75px"/>
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