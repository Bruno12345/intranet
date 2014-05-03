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

            $SQL = "SELECT *, DATE_FORMAT(data,'%d/%m/%Y') AS dataFormatada FROM noticias WHERE id = $id;";
            $resultado = mysql_query($SQL);
            while($linha = mysql_fetch_array($resultado)){
            extract($linha);
            ?>
            <div id="box-contentDireita-noticia">
                <h1><?=$titulo;?></h1>
                <p class="dataFonte"><?=$dataFormatada;?>&nbsp;|&nbsp;<?=$fonte;?>&nbsp;|&nbsp;<?=$autor;?></p>
                <div id="img250">
                 <img src="./adm/noticias/arquivos/<?=$id;?>/<?=$imagem;?>" width="250" height="188" title="<?=$titulo;?>"  />
                </div>
                <p class="textoCompleto"><?=$texto?></p>
				<p class="btns-listas"><a href="noticias.php" class="voltar">Veja todas as Notícias</a></p>
								
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
  
        
        
  