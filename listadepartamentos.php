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
    	<h1>Departamentos</h1>        
    </div><!-- fim div titulo categoria -->
    
    <div id="box-categoriasDois">
    	<div id="box-menuLateral">
            <ul>
            <?
            $SQL2 = "SELECT id, nome FROM setores  WHERE visivel = 1 ORDER BY nome";
            $resultado2 = mysql_query($SQL2);
            while($linha2 = mysql_fetch_array($resultado2)){
                extract($linha2);
                ?><li><a href="departamentos.php?id=<?=$id?>"><?=$nome;?></a></li><?               
            }
            ?>            
            </ul>
        	
        </div><!-- fim div menu-lateral -->
        
        <div id="box-contentDireita">
        
        	
        </div><!-- box-contentDireita -->
    	
    </div><!-- fim div box-eventos -->

  </div><!--Fim da div conteudo -->
<?
include("rodape.php");
?>