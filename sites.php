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
    	<h1>Sites</h1>        
    </div><!-- fim div titulo categoria -->
    
    <div id="box-categoriasDois">
    	        
        <div id="box-contentDireita" style="width:950px;">
            <table width="910" id="lista-ramais" style="text-align:center;">
                <th width="455" style="padding:8px 20px; text-align:left;">Empresa</th>
                <th width="455" style="padding:8px 20px; text-align:left;">Site</th>
                <?
                $SQL2 = "SELECT nome, site FROM empresa ORDER BY id";
                $resultado2 = mysql_query($SQL2);
                while($linha2 = mysql_fetch_array($resultado2)){
                    extract($linha2);
                    ?>
                        <tr style="font-size:15px;">
                            <td style="padding:8px 20px; text-align:left;"><?=$nome?></td>
                            <td style="padding:8px 20px; text-align:left;"><a href="http://<?=$site?>" style="text-decoration:none; color:#FFF;"><?=$site?></a></td>
                        </tr><!-- repetir essa linha -->
                    <?                    
                }
                ?>
            </table>  
        	
        </div><!-- box-contentDireita -->
    	
    </div><!-- fim div box-eventos -->

  </div><!--Fim da div conteudo -->
<?
include("rodape.php");
?>