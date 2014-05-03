<?
error_reporting(0);
session_start();
require_once("./engine/conexao.php");
include_once("./engine/funcoes.php");
logado();
include("topo.php");

 ?>

 <link href="./css/smoothness/jquery-ui-1.9.2.custom.css" rel="stylesheet" type="text/css" media="screen" />
 <script type="text/javascript" src="./js/jquery.js"></script>
 <script type="text/javascript" src="./js/jquery-ui-1.9.2.custom.min.js"></script>
 
 <script type="text/javascript" src="./js/jcarousellite_1.0.1.min.js"></script>
 <script type="text/javascript">
 <!--
    $(function() {
        $("#tabs").tabs();

      /*  
        $(".dialogo").dialog({
            autoOpen: false,
            width: 500,
            modal: true,
            minHeight: 250,
        });

        $("#boxCarosellogos ul li").click(function(){
            var id = $(this).attr("id").substring(1);
            $("#d"+id).dialog("open");
        });
     */
        

        $("#dialog-message").dialog({
            modal: true,
            width: 500,
            resizable: false,
            minHeight: 250,
            buttons: {
                "fechar comunicado": function(){
                    $.ajax({
                        type: 'POST',
                        data: {'id': <?=$_SESSION['user_id']?>},
                        url:'lido.php',
                        success: function(retorno){
                            
                        }
                    });
                    $(this).dialog("close");
                }
            }         
        });

        $("#comunicado").click(function( event ) {
            $("#dialog-message").dialog("open");
	    //event.preventDefault();
        }); 

        $("#box-agenda").jCarouselLite({
            btnPrev: '.prev',
            btnNext: '.next',
            speed  : 2000 ,
            visible: 1 ,
        })  

        $("#boxCarosellogos").jCarouselLite({
            auto   : 10000,
            btnPrev: '.anterior',
            btnNext: '.proximo',
            speed  : 2000 ,
            visible: 4  
        })  

        
    });
-->
 </script>
  <div id="conteudo">
  	<div id="tvs">
    	<h1 class="titulo-box">GL EVENTS TV</h1>
        <div id="box-player">
        	
                <div id="tabs">
                    <ul>
                        <li><a href="#tabs-1">TV Mundo</a></li>
                        <li><a href="#tabs-2">TV Riocentro</a></li>
                        <li><a href="#tabs-3">TV HSBC Arena</a></li>
                        <li><a href="#tabs-4">TV Fagga</a></li>
                    </ul>
                    <?
                        $SQL3 = "SELECT * FROM  tvs;";
                        $linhas3 = mysql_fetch_array(mysql_query($SQL3));
                        extract($linhas3);    

                        $tvfagga = corrigeFrame($tvfagga);
                        $tvriocentro = corrigeFrame($tvriocentro);
                        $tvmundo = corrigeFrame($tvmundo);
                        $tvhsbc = corrigeFrame($tvhsbc);

                    ?>
                    <div id="tabs-1">
                        <?=$tvmundo;?>
                    </div>
                    <div id="tabs-2">
                        <?=$tvriocentro;?>
                    </div>
                    <div id="tabs-3">
                        <?=$tvhsbc;?>
                    </div>
                    <div id="tabs-4">
                        <?=$tvfagga;?>
                    </div>
                </div>          
        </div>

  	</div><!-- div TV GL -->
    <div id="agenda">
        <h1 class="titulo-box">AGENDA</h1>
        	<a href="#" class="prev"><img src="./images/left_arrow_exhibition_black_off.jpg" width="26" height="26" /></a>
            <a href="#" class="next"><img src="./images/right_arrow_exhibition_black_off.jpg" width="26" height="26" /></a>
        <div id="box-agenda">        
        	<ul>
                <? 

                    $SQL = "SELECT COUNT(*) FROM  eventos WHERE data_inicio >= CURDATE();";
                    $total = mysql_result(mysql_query($SQL),0);
                    $totalDivs =  ceil($total/6);

                    $offset = 0;

                    for($i = 1; $i<= $totalDivs; $i++){
                       ?>
                          <li class="seisAnuncios">  
                        <? 

                        $SQL = "SELECT *, DAY(data_inicio) AS diaI, MONTH(data_inicio) AS mesI, DAY(data_fim) AS diaF, MONTH(data_fim) AS mesF FROM  eventos WHERE data_inicio >= CURDATE() OR data_fim >= CURDATE() ORDER BY data_inicio ASC LIMIT 6 OFFSET $offset;";
                        $resultado = mysql_query($SQL);
                        while($linha = mysql_fetch_array($resultado) ){
                            extract($linha);
                            ?>
                                <div class="eventoAgenda">
                                    <a href="http://<?=$site?>" target="_blank">
                                    <div class="imagemEvento">
                                      <img src="./adm/eventos/arquivos/<?=$id?>/logo/<?=$imagem_logo?>" title="<?=$titulo?>"/>
										<div class="msgNota">
                                            <p class="nota"><?=$titulo?></p>
                                        </div><!-- div aparece com hover -->
									</div><!-- carrega a imgem da logo do evento 113x 113px -->
                                        
                                    
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
                                           <p class="dia"><?=$diaI?></p>
                                           <p class="mes"><?=exibeMes($mesI)?></p>
                                           <p class="dia"></p>
                                           <p class="mes"></p> 
                                           <?


                                        }else{

                                           ?>
                                           <p class="dia"><?=$diaI?></p>
                                           <p class="aa"> - </p>
                                           <p class="dia"><?=$diaF?></p>
                                           <p class="mes"><?=exibeMes($mesI)?></p> 
                                           <?


                                        }
                                       
                                    }else{
                                        ?>
                                           <p class="dia"><?=$diaI?></p>
                                           <p class="aa"><?=exibeMes($mesI)?></p>
                                           <p class="dia"><?=$diaF?></p>
                                           <p class="aa"><?=exibeMes($mesF)?></p> 
                                        <?    
                                    }
                                    ?>
                                    </a>
                                </div><!-- essa div é item de lista que repitirá 6 vezes -->

                            <?
                        }

                        ?>
                           </li> <!-- essa <li> se repetira a cada carga de 6 anuncios dentro com seu proprio conteudo -->  
                        <?
                        $offset = $offset + 6;
                    }
                ?>                 
            </ul> 
        </div><!-- fim da box-agenda onde sera carregado a lista dos eventos com img,data e titulo -->
    </div><!-- div id agenda -->
    
    <div id="empresas">
        
        <div id="boxContentcarosel">
        		<a href="#" class="anterior"><img src="./images/left_arrow_exhibition_black_off.jpg" width="26" height="26" /></a>
            	<a href="#" class="proximo"><img src="./images/right_arrow_exhibition_black_off.jpg" width="26" height="26" /></a>
        	<div id="boxCarosellogos">
                <ul>
                    <?
                    $SQL2 = "SELECT id, imagem, resumo FROM empresa ORDER BY nome";
                    $resultado2 = mysql_query($SQL2);
                    while($linha2 = mysql_fetch_array($resultado2)){
                        extract($linha2);
                        ?>
                        <li id="i<?=$id?>"><a href="empresa.php?id=<?=$id?>"><img src="./adm/empresas/arquivos/<?=$id?>/<?=$imagem?>" style="width:184px; height:59px;" /></a></li>
                        <?               
                    }
                    ?>            
                </ul>           	
            </div><!-- fim div boxCarosellogs -->        
        </div><!-- div boxContentcarosel que engloba todo o carrossel das logos -->
        
    </div><!-- fim da div empresas -->
    
    <div id="noticias">
        <h1 class="titulo-box">NOTÍCIAS</h1>
        <div id="box-contentNoticias">
        	<ul>
                 <? 
                    $SQL = "SELECT *, DATE_FORMAT(data,'%d/%m') AS dataFormatada FROM  noticias ORDER BY data DESC LIMIT 2";
                    $resultado = mysql_query($SQL);
                    while($linha = mysql_fetch_array($resultado)){
                        extract($linha);
                        ?>
                        <li>
                            <a href="noticia.php?id=<?=$id?>">
                            <div><img src="./adm/noticias/arquivos/<?=$id?>/<?=$imagem?>" title="<?=$titulo?>" width="92" height="69"  /></div>
                            <p class="titulo-boxNoticia"><span><?=$dataFormatada?>&nbsp;&nbsp;|</span>&nbsp;&nbsp;<?=$titulo?></p>
                            <div class="text-boxNoticia"><?=substr($texto,0,120);?>...</div>
                            </a>
                </li>
                        <?
                    }
                ?>                         	
            </ul>
            <div id="maisNoticias">
            <p class="titulo-boxNoticia"><a href="noticias.php">Todas as Notícias</a></p>
            <p class="titulo-boxNoticia"><a href="comunicado.php" id="comunicado">Último comunicado</a></p>
            </div>
        </div><!-- fim da box-contentNoticias que carrega as noticias cadastradas -->
    </div><!-- fim da div noticias -->
    
    <div id="projetos">
        <h1 class="titulo-box">PROJETOS</h1>
        <div id="box-contentProjetos" class="scrollorido">
        	<ul>
             <? 
                $SQL = "SELECT * FROM  projetos ORDER BY id DESC";
                $resultado = mysql_query($SQL);
                while($linha = mysql_fetch_array($resultado)){
                    extract($linha);
                    ?>
                    <li>
                        <a href="projeto.php?id=<?=$id?>" title="<?=$nome?>">
                        <div><img src="./adm/projetos/arquivos/<?=$id?>/<?=$imagem?>" width="43" height="32" /></div>
                        <p><?=$nome?></p>
                        </a>
                    </li>
                    <?
                }
            ?>               
            </ul>
        </div><!-- fim da div box-contentProjetos que vai carregar a lista de projetos cadastrados -->
    </div>
    <div id="aniversarios">
        <h1 class="titulo-box">ANIVERSARIANTES DO MÊS</h1>
        <div id="box-contentAniver" class="scrollorido">
        <?
            $SQL = "SELECT id  AS niverId, nome, CONCAT(nascimento_dia ,'/', nascimento_mes) AS dataN FROM usuarios WHERE nascimento_mes = MONTH(CURDATE()) ORDER BY nascimento_dia";
            $resultado = mysql_query($SQL);
            while($linha = mysql_fetch_array($resultado) ){
                extract($linha);
                ?>
                <div class="niver">
                <div class="nomeNiver"><a href="colaborador.php?id=<?=$niverId?>" title="Perfil do Aniversariante"><p><?=$nome?></p></a></div>
                <div class="dataNiver"><p><?=$dataN;?></p></div>
                </div><!-- fim da div niver que é item de lista -->
            

                <?
            }
        ?>        	
        	
        </div><!-- fim da div box-contetAniver -->
    </div><!-- fim da div aniversariantes -->
  </div><!--Fim da div conteudo -->
  <? 

    $SQL = "SELECT recado FROM usuarios WHERE id = ".$_SESSION['user_id'].";";
    $resposta = mysql_result(mysql_query($SQL),0);

    if($resposta == 0){

        $SQL = "SELECT *, DATE_FORMAT(data,'%d/%m/%Y') AS dataFormatada FROM comunicados WHERE data >= CURDATE() ORDER BY data DESC LIMIT 1";
        $resultado = mysql_query($SQL);
        while($linha = mysql_fetch_array($resultado)){
        extract($linha);
            ?>
            <div id="dialog-message" title="COMUNICADO">
				<div id="conteudo-messagem">
					<h3><?=$titulo?></h3>
					<p class="dataComunic"><?=$dataFormatada?></p>
					<p><?=$texto?></p>
				</div>
            </div>
            <?
        }

    }
        
    ?>
<? include("rodape.php");?>
