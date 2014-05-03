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
                   
            <div id="box-menuLateral">
                 <ul>
                <?
                $SQL2 = "SELECT id, nome FROM setores  ORDER BY nome";
                $resultado2 = mysql_query($SQL2);
                while($linha2 = mysql_fetch_array($resultado2)){
                    extract($linha2);
                    ?><li><a href="ramais.php?id=<?=$id?>"><?=$nome;?></a></li><?               
                }
                ?>            
                </ul>
            </div><!-- fim div menu-lateral -->
            
            <div id="box-contentDireita">

            <table width="680" id="lista-ramais" style="text-align:center;">
                <tr>
                    <th width="80">Ramal</th>
                    <th width="300">Colaborador</th>
                    <th width="300">E-mail</th>
                </tr>                  
                <?
                $SQL3 = "SELECT u.id AS usuario_id, u.*, s.nome AS setor, c.nome AS cargo FROM usuarios u  INNER JOIN setores s ON u.setores_id = s.id INNER JOIN cargos c ON u.cargos_id = c.id WHERE u.setores_id = $setor_id ORDER BY nome ASC";
                $resultado3 = mysql_query($SQL3);
                while($linha3 = mysql_fetch_array($resultado3)){
                    extract($linha3);
                    ?>
                    <tr style="font-size:15px;">
                        <td style="padding:8px 0;"><?=$ramal?></td>
                        <td style="padding:8px 0;"><?=$nome?></td>
                        <td style="padding:8px 0;"><?=$email?></td>
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

}


?> 
  
