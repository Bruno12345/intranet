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
<script type="text/javascript" src="./js/jquery.js"></script>
<script type="text/javascript" src="./engine/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="./engine/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="./engine/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
$(document).ready(function() {
 
   $(".fotos").fancybox();

   $("#box-menuLateral ul li a").each(function() {

        if($(this).attr("href") == "<?=end(explode('/',$_SERVER ['REQUEST_URI']))?>"){
            $(this).addClass("selecionado");
        }                 

   }); 

});
</script>
 
  <div id="conteudo">
  	<div id="titulo-categoria">
        <?
            $SQL2 = "SELECT  nome AS titulo FROM categoria_imagens WHERE id = $id;";
            $titulo = mysql_result(mysql_query($SQL2),0);
        ?>
    	<h1><?=$titulo?></h1>        
    </div><!-- fim div titulo categoria -->
    
           
    	<div id="box-menuLateral">
            <ul>
            <?
            $SQL2 = "SELECT id AS catId, nome AS nomeCat FROM categoria_imagens ORDER BY nome";
            $resultado2 = mysql_query($SQL2);
            while($linha2 = mysql_fetch_array($resultado2)){
                extract($linha2);
                ?><li><a href="imagensDet.php?id=<?=$catId?>"><?=$nomeCat;?></a></li><?               
            }
            ?>            
            </ul>            
        </div><!-- fim div menu-lateral -->
        
        <div id="box-contentDireita">

            <?
                $SQL2 = "SELECT * FROM imagens WHERE categoria_imagens_id = $id;";
                $resultado2 = mysql_query($SQL2);
                while($linha2 = mysql_fetch_array($resultado2)){
                    extract($linha2);
                    ?>
                     <div class="fotos-albuns">
                        <a href="./adm/imagens/arquivos/<?=$id?>/<?=$imagem?>" class="fotos"><img src="./adm/imagens/arquivos/<?=$id?>/<?=$imagem?>" width="112" height="84" /></a>
                        <a href="./adm/imagens/arquivos/<?=$id?>/<?=$imagem?>" title="Download" target="_blank"><img src="images/arrow_down.png" width="8" height="10" />Download</a>
                    </div><!-- fim div fotos-albuns -->
                    <?               
                }
            ?>
           
            
        </div><!-- box-contentDireita -->
    	
   
  </div><!--Fim da div conteudo -->
<?
}

include("rodape.php");
?>
 
