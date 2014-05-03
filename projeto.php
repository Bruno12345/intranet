<? 
error_reporting(0);
session_start();
require_once("./engine/conexao.php");
include_once("./engine/funcoes.php");
logado();
include("topo.php");
if($_GET){
    extract($_GET);
    
    ?>
    <div id="conteudo">
        <div id="box-categoriasDois">
            <?

            $SQL = "SELECT *  FROM projetos WHERE id = $id;";
            $resultado = mysql_query($SQL);
            while($linha = mysql_fetch_array($resultado)){
            extract($linha);
            ?>
            <div id="box-contentDireita-noticia">
                <h1><?=$nome;?></h1>
                <div id="img250">
                   <img src="./adm/projetos/arquivos/<?=$id;?>/<?=$imagem;?>" width="250" height="188" title="<?=$nome;?>"  />
                </div>
                <div class="textoCompleto"><?=$descricao?></div>
				<div id="box-fotos-projetos">
                     <?
                        if($foto1 != ""){
                            ?>
                            <div class="fotos-projetos">
                                <img src="./adm/projetos/arquivos/<?=$id;?>/imagens/<?=$foto1;?>" width="465" height="349" />
                            </div><!-- essa div vai ser carregada com 1 foto, e aparecerá no maximo 2 vezes, se não tiver imagem não aparecer nada -->
                            <?
                        }

                    ?>
                     <?
                        if($foto2 != ""){
                            ?>
                            <div class="fotos-projetos">
                                <img src="./adm/projetos/arquivos/<?=$id;?>/imagens/<?=$foto2;?>" width="465" height="349" />
                            </div><!-- essa div vai ser carregada com 1 foto, e aparecerá no maximo 2 vezes, se não tiver imagem não aparecer nada -->
                            <?
                        }

                    ?>				
				</div>
				
				<p class="btns-listas limpar"><a href="projetos.php" class="voltar">Veja todos os Projetos</a></p>	
            </div><!-- box-contentDireita-noticia -->
            <?
            }
            ?>
        </div><!-- fim div box-eventos -->
    </div><!--Fim da div conteudo -->
    <?
}
include("rodape.php");
?>
  
        
        
  