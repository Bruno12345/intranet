<?
error_reporting(0);
session_start();
require_once("./engine/conexao.php");
include_once("./engine/funcoes.php");
logado();
 
include("topo.php");


    $SQL = "SELECT e.*, DAY(e.data_inicio) AS diaI, MONTH(e.data_inicio) AS mesI, DAY(e.data_fim) AS diaF, MONTH(e.data_fim) AS mesF, p.nome AS empresa FROM eventos e INNER JOIN empresa p ON e.empresa_id = p.id WHERE e.data_inicio >= CURDATE() ORDER BY e.data_inicio ASC ";
    $resultado = mysql_query($SQL.paginate());

 ?>
 <script type="text/javascript" src="./engine/js/jquery-1.7.2.min.js"></script>
 <script type="text/javascript">
<!--
    $(document).ready(function(){
        $("select[name=eventEmpresas]").change(function(){
            document.location = $(this).val();            
        });
    });

-->
</script>
  <div id="conteudo">
  	<div id="titulo-categoria">
    	<h1>Eventos</h1>
        <div class="float_direita">
        <form action="#" method="get" name="filtro-eventos"> 
        	<label>Filtrar por Empresa </label>       
        	<select name="eventEmpresas" id="eventEmpresas" >
            <option value ="#">Selecione uma opção</option>
        	  <option value ="eventos.php">Todos</option>
              <?
                  $SQL2 = "SELECT * FROM empresa ORDER BY nome ASC";
                  $resultado2 = mysql_query($SQL2);
                  while($linha2 = mysql_fetch_array($resultado2)){
                      extract($linha2);
                      ?>
                      <option value ="eventosEmp.php?id=<?=$id?>"><?=$nome?></option>                          
                      <?                        
                  }
                ?>              
      	  </select>
        </form>
        </div>
    </div><!-- fim div titulo categoria -->
	<div id="box-categorias">

        <?

            while($linha = mysql_fetch_array($resultado)){
                extract($linha);
                ?>
                <div class="item-lista-categoria">
                 <div class="img-evento">
                    <img src="./adm/eventos/arquivos/<?=$id?>/<?=$imagem?>" width="200" height="150" title="<?=$titulo?>"/>                    
                 </div><!-- aqui carrega imagem/logo do evento -->
                 <div class="content-resumo">
                     <h3><?=$titulo?></h3>
                     <h5><?=$empresa?></h5>
					 <div class="resumo"><?=$resumo?></div>
					 <br />
                     <p><strong>Site do Evento:&nbsp;&nbsp;</strong><a href="http://<?=$site?>" target="_blank"><?=$site?></a></p>
                 </div>
                 <div class="data-evento">
                    <?
                        if(strlen($diaI) == 1){
                            $diaI = "0".$diaI;    
                        }

                        if(strlen($diaF) == 1){
                            $diaF = "0".$diaF;                                           
                        }

                        ?>    
                     <?
                      if($mesI == $mesF){
                          
                          if($diaI == $diaF){

                             ?>
                             <p class="data-inifim"><?=$diaI?></p>
                             <p class="a-mes"><?=exibeMes($mesI)?></p>
                             <p class="data-inifim"></p>
                             <p class="a-mes"></p> 
                             <?


                          }else{

                             ?>
                             <p class="data-inifim"><?=$diaI?></p>
                             <p class="a-mes"> - </p>
                             <p class="data-inifim"><?=$diaF?></p>
                             <p class="a-mes"><?=exibeMes($mesI)?></p> 
                             <?


                          }
                         
                      }else{
                          ?>
                             <p class="data-inifim"><?=$diaI?></p>
                             <p class="a-mes"><?=exibeMes($mesI)?></p>
                             <p class="data-inifim"><?=$diaF?></p>
                             <p class="a-mes"><?=exibeMes($mesF)?></p> 
                          <?    
                      }
                      ?>
                    
                 </div>
                </div><!-- fim div item-lista-evento -->

                <?
            }

        ?>   
    	
        
        <div id="paginacao">
            <?=paginateTable($SQL,'eventos.php')?>        	
        </div>
    	
    </div><!-- fim div box-eventos -->

  </div><!--Fim da div conteudo -->
<? 


include("rodape.php");

?>