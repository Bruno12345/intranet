<?php

session_start();
require_once("./engine/conexao.php");
include_once("./engine/funcoes.php");


if($_POST){
    
    extract($_POST);
    include("topo.php");
?>
  
  <div id="conteudo">
  	<div id="titulo-categoria">
    	<h1>Resultados para busca - <?=$q?></h1>
        
    </div><!-- fim div titulo categoria -->
	<div id="box-categorias">

         <?php


    $SQL = "SELECT empresa_id AS id, titulo, 'eventos' AS tipo FROM eventos WHERE titulo LIKE '%$q%' OR resumo LIKE '%$q%'
            UNION
            SELECT id, titulo, 'noticias' FROM noticias WHERE titulo LIKE '%$q%' OR texto LIKE '%$q%'
            UNION
            SELECT id, nome, 'projetos' FROM projetos WHERE nome LIKE '%$q%' OR resumo LIKE '%$q%'
            UNION
            SELECT id, nome, 'usuarios' FROM usuarios WHERE nome LIKE '%$q%';";
            $resultado = mysql_query($SQL) or die(mysql_error());
            $total = mysql_num_rows($resultado);

            if($total > 0){


            

            while($linha = mysql_fetch_array($resultado)){
                extract($linha);
                ?>
                <div class="item-lista-categoria">
                  <div class="content-resumo">
                    <?php
                        if($tipo == 'eventos'){
                            ?><h3><a href="eventosEmp.php?id=<?=$id?>"><?=$titulo?></a></h3><?
                        }
                        
                        if($tipo == 'noticias'){
                            ?><h3><a href="noticia.php?id=<?=$id?>"><?=$titulo?></a></h3><?
                        }
                        
                        if($tipo == 'projetos'){
                            ?><h3><a href="projeto.php?id=<?=$id?>"><?=$titulo?></a></h3><?

                        }

                        if($tipo == 'usuarios'){
                            ?><h3><a href="colaborador.php?id=<?=$id?>"><?=$titulo?></a></h3><?

                        }

                    ?>                                     
                 </div>         
                </div><!-- fim div item-lista -->                
                <?php
            }

          }else{
             ?><h3>Nenhum resultado encontrado para palavra - <?=$q?></h3><?
          }
        ?>          
    	
    </div><!-- fim div categorias -->

  </div><!--Fim da div conteudo -->
  <?php
  include("rodape.php");

}
  ?>