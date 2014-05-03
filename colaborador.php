<?
error_reporting(0);
session_start();
require_once("./engine/conexao.php");
include_once("./engine/funcoes.php");
logado(); 

if(!$_GET['id']){
    header("location: principal.php");

}else{
    extract($_GET);

    $SQL3 = "SELECT  u.id AS userid, u.nome AS nomeUser, u.email AS emailUser, u.imagem AS userImagem, u.ramal, c.nome AS cargo, e.nome AS empresa FROM usuarios u  INNER JOIN cargos c ON u.cargos_id = c.id INNER JOIN empresa e ON u.empresa_id = e.id WHERE u.id = $id;";
    $resultado3 = mysql_query($SQL3);
    $linha3 = mysql_fetch_array($resultado3);
    extract($linha3);

    include("topo.php");
    ?>
    <div id="conteudo">
    <div id="box-categoriasDois">
        <div id="box-contentDireita-noticia">
            <div class="perfilColaborador">
                <?
                    if($userImagem == NULL OR $userImagem == ""){
                    ?>
                        <span><a href="#"><img src="./images/topo/avatar.jpg" width="65" height="65" title="<?=$nomeUser?>"/></a></span>                        
                    <?
                    }else{
                        ?>
                        <span><a href="#"><img src="./adm/usuarios/arquivos/<?=$userid?>/<?=$userImagem?>" width="75" height="75" title="<?=$nomeUser?>" /></a></span>
                        <?
                    }?> 
                    <p><?=$nomeUser?></p>
                    <p><?=$cargo?></p>
					<p><?=$empresa?></p>
                    <p><strong>Ramal:&nbsp;&nbsp;</strong><?=$ramal?></p>
                    <p><a href="mailto:<?=$emailUser?>"><?=$emailUser?></a></p>
                    <p class="btnVoltar"><small><a href="principal.php" class="selecionado">voltar</a></small></p>
            </div><!-- fim div perfilColaborador -->
               
        </div><!-- box-contentDireita-noticia -->
        
    </div><!-- fim div box-eventos -->

  </div><!--Fim da div conteudo -->
        
    <?
    include("rodape.php");

}


?> 
  
