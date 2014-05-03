<?
error_reporting(0);
session_start();
require_once("./engine/conexao.php");
include_once("./engine/funcoes.php");
logado();
 
include("topo.php");


    
    ?>
    <div id="conteudo">
        <div id="box-categoriasDois">
            <?

            $SQL = "SELECT *, DATE_FORMAT(data,'%d/%m/%Y') AS dataFormatada FROM comunicados ORDER BY data LIMIT 1;";
            $resultado = mysql_query($SQL);
            while($linha = mysql_fetch_array($resultado)){
            extract($linha);
            ?>
            <div id="box-contentDireita-noticia">
                <h1><?=$titulo;?></h1>
                <p class="dataFonte"><?=$dataFormatada;?></p>
                <p class="textoCompleto"><?=$texto?></p>								
            </div><!-- box-contentDireita-noticia -->
            <?
            }
            ?>
        </div><!-- fim div box-eventos -->
    </div><!--Fim da div conteudo -->
    <?

include("rodape.php");
?>
  