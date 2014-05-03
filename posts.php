<?
error_reporting(0);
session_start();
require_once("./engine/conexao.php");
include_once("./engine/funcoes.php");
logado();

if(!$_GET['id']){
    header("loacation: principal.php");

}else{
    extract($_GET);


    $SQL = "SELECT p.* , s.nome AS setor_nome FROM posts p INNER JOIN setores s ON p.setores_id = s.id WHERE p.id =  $id";
    $resultado = mysql_query($SQL);
    $linha = mysql_fetch_array($resultado);
    extract($linha);  

    include("topo.php");

    
}
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
        <h1><?=$setor_nome?></h1>        
    </div><!-- fim div titulo categoria -->
    
    <div id="box-categoriasDois">
        <!--<div id="diretoriaNomes">
        <h1>Diretoria:&nbsp;&nbsp;<em>Nome do diretor(a) ou Diretores</em></h1>        
		</div> fim div diretoriaNomes -->  	
    
    <div id="box-categoriasDois">
    	 <div id="box-menuLateral">
                <ul>
                    <!--<li><a href="departamentos.php?id=<?=$setores_id?>" >Colaboradores</a></li> -->
                    <?
                    $SQL2 = "SELECT id AS post_id, titulo AS titulo_post  FROM posts WHERE setores_id = $setores_id ORDER BY titulo";
                    $resultado2 = mysql_query($SQL2);
                    while($linha2 = mysql_fetch_array($resultado2)){
                        extract($linha2);
                        ?>
                            <li><a href="posts.php?id=<?=$post_id?>"><?=$titulo_post;?></a></li>
                        <?
                        
                    }
                    ?>
                    
                </ul>
            </div><!-- fim div menu-lateral -->
        
         <div id="box-contentDireita">
        	<h1><?=$titulo?></h1>
            <p><?=$texto?></p>       	
        </div><!-- box-contentDireita -->
    	
    </div><!-- fim div box-eventos -->

  </div><!--Fim da div conteudo -->
  
