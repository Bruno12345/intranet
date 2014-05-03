<?
error_reporting(0);
session_start();
require_once("./engine/conexao.php");
include_once("./engine/funcoes.php");
logado();
include("topo.php");
?>
  
  <div id="conteudo">
  	<div id="titulo-categoria">
    	<h1>Notícias</h1>
        
    </div><!-- fim div titulo categoria -->
	<div id="box-categorias">

         <? 
            $SQL = "SELECT *, DATE_FORMAT(data,'%d/%m/%Y') AS dataFormatada FROM  noticias ORDER BY data DESC";
            $resultado = mysql_query($SQL.paginate());
            while($linha = mysql_fetch_array($resultado)){
                extract($linha);
                ?>
                <div class="item-lista-categoria">
					<div class="img-evento">
					<img src="./adm/noticias/arquivos/<?=$id?>/<?=$imagem?>" width="200" height="150" title="<?=$titulo?>" />
					</div><!-- aqui carrega imagem/logo do evento -->
					
					<div class="content-resumo">
						<h3><?=$titulo?></h3>
						<h5><?=$dataFormatada?></h5>
					 <div class="resumo"><?=substr($texto, 0, 300);?> ...</div>
						<p class="btns-listas"><a href="noticia.php?id=<?=$id?>" class="leia">Leia Mais</a></p>				 
					</div><!-- content-resumo -->
				</div><!-- fim item-lista-categoria -->	
				
                <?
            }
        ?>          
    <div id="paginacao">
            <?=paginateTable($SQL,'noticias.php')?>          
        </div><!-- fim paginacao -->
    </div><!-- fim div box-categorias -->                
		

   
  </div><!--Fim da div conteudo -->
 <? 
 include("rodape.php");
 ?>
