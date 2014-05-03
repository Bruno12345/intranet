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

    $SQL = "SELECT id AS setor_id, nome AS nome_setor FROM setores WHERE id = $id";
    $resultado = mysql_query($SQL);
    $linha = mysql_fetch_array($resultado);
    extract($linha);



    include("topo.php");
    ?>
	<script type="text/javascript" src="./js/jquery.js"></script>
        <script type="text/javascript">
        $(document).ready(function(){
            
           $("#box-menuLateral ul li a").each(function() {

                if($(this).attr("href") == "<?=end(explode('/',$_SERVER ['REQUEST_URI']))?>"){
                    $(this).addClass("selecionado");
                }                 

            }); 

        });    
        </script>    
        <div id="conteudo">
        <div id="titulo-categoria">
            <h1><?=$nome_setor?></h1>        
        </div><!-- fim div titulo categoria -->
        
        <div id="box-categoriasDois">
            <!--<div id="diretoriaNomes">
            <h1>Diretoria:&nbsp;&nbsp;<em>
            <?
                $SQL3 = "SELECT nome FROM usuarios WHERE setores_id = $setor_id  AND cargos_id = 55 ";
                $resultado3 = mysql_query($SQL3);
                while($linha3 = mysql_fetch_array($resultado3)){
                extract($linha3);
                        ?><?=$nome;?>&nbsp;&nbsp;<?                        
                }
             ?>               
            </em></h1>        
        </div> -->
            
            <div id="box-menuLateral">
                <ul>
                     <!--   
                    <li><a href="departamentos.php?id=<?=$id?>">Colaboradores</a></li>
                    -->
                    <?
                    $SQL2 = "SELECT id AS post_id, titulo FROM posts WHERE setores_id = $setor_id ORDER BY titulo";
                    $resultado2 = mysql_query($SQL2);
                    while($linha2 = mysql_fetch_array($resultado2)){
                        extract($linha2);
                        ?>
                            <li><a href="posts.php?id=<?=$post_id?>"><?=$titulo;?></a></li>
                        <?
                        
                    }
                    ?>
                    
                </ul>
            </div><!-- fim div menu-lateral -->
            
            <div id="box-contentDireita">
                <!--
                <ul class="colaboradores">
                    <?
                    $SQL3 = "SELECT u.id AS usuario_id, u.*, s.nome AS setor, c.nome AS cargo FROM usuarios u  INNER JOIN setores s ON u.setores_id = s.id INNER JOIN cargos c ON u.cargos_id = c.id WHERE u.setores_id = $setor_id ORDER BY nome ASC";
                    $resultado3 = mysql_query($SQL3);
                    while($linha3 = mysql_fetch_array($resultado3)){
                        extract($linha3);
                        ?>
                           <li>
                                <? 
                                if($imagem == NULL OR $imagem == ""){
                                    ?>
                                    <a href="colaborador.php?id=<?=$usuario_id?>"><img src="images/topo/avatar.jpg" width="65" height="65" title="<?=$nome?>" /></a>
                                    <?
                                }else{
                                    ?>
                                    <a href="colaborador.php?id=<?=$usuario_id?>"><img src="./adm/usuarios/arquivos/<?=$id?>/<?=$imagem?>" width="65" height="65" title="<?=$nome?>" /></a>
                                    <?
                                }
                                ?>
                                <p><?=$nome?></p>
                                <p><?=$cargo?></p>
								<p>Nome Empresa</p>
                                <p><strong>Ramal:&nbsp;&nbsp;</strong><?=$ramal?></p>
                                <p><a href="mailto:<?=$email?>"><?=$email?></a></p>
                            </li>
                        <?
                        
                    }
                    ?>                    
                </ul>
            -->
            </div><!-- box-contentDireita -->
            
        </div><!-- fim div box-eventos -->

      </div><!--Fim da div conteudo -->
    <?
    include("rodape.php");

}


?> 
  
