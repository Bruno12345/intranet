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
    	<h1>Projetos</h1>
    </div><!-- fim div titulo categoria -->
	<div id="box-categorias">

         <? 
            $SQL = "SELECT * FROM  projetos";
            $resultado = mysql_query($SQL);
            while($linha = mysql_fetch_array($resultado)){
                extract($linha);
                ?>
                <div class="item-lista-categoria">
                 <div class="img-evento">
                    <img src="./adm/projetos/arquivos/<?=$id?>/<?=$imagem?>" width="200" height="150" title="<?=$titulo?>" />
                 </div><!-- aqui carrega imagem/logo do evento -->
                 <div class="content-resumo">
                     <h3><?=$nome?></h3>
                     <div class="resumo"><?=substr($descricao, 0, 345);?> ...</div> 
                     <p class="btns-listas"><a href="projeto.php?id=<?=$id?>" class="leia">Leia Mais</a></p>                  
                 </div>         
                </div><!-- fim div item-lista -->  
			
                <?
            }
        ?>          
    </div><!-- fim div categorias -->
	
	</div>

 
  
<? 

include("rodape.php");

?>