<?
error_reporting(0);
session_start();
require_once("./engine/conexao.php");
include_once("./engine/funcoes.php");
logado();

if(!$_GET['id']){
    header("location: principal.php");

}else{

    include("topo.php");

    extract($_GET);
    $SQL = "SELECT * FROM empresa WHERE id =  $id";
    $resultado = mysql_query($SQL);
    $linha = mysql_fetch_array($resultado);
    extract($linha);  

    

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
        <h1><?=$nome?></h1>        
    </div><!-- fim div titulo categoria -->
    <div id="box-categoriasDois">
        <div id="box-menuLateral">
            <ul>
                <?
                $SQL2 = "SELECT id AS empresa_id, nome AS empresa_nome FROM empresa ORDER BY id";
                $resultado2 = mysql_query($SQL2);
                while($linha2 = mysql_fetch_array($resultado2)){
                    extract($linha2);
                    ?><li><a href="empresa.php?id=<?=$empresa_id?>"><?=$empresa_nome;?></a></li><?               
                }
                ?>            
            </ul>
        </div><!-- fim div menu-lateral -->

        <div id="topEmpresa">
			<div id="conteudo-topEmpresa">
				<div id="logoEmpresa">
					<img src="./adm/empresas/arquivos/<?=$id?>/<?=$imagem?>" height="75"  />
				</div>
				<div id="diretorEmpresa">
                    <?
                        //GL Eventos
                        if($id == 1){

                            $SQL = "SELECT u.id as usuario_id, u.nome AS nome_usuario, u.imagem, c.nome AS cargo FROM usuarios u INNER JOIN cargos c ON u.cargos_id = c.id WHERE empresa_id = $id AND cargos_id = 104;";
                            //echo $SQL;  
                            $resultado = mysql_query($SQL);
                            $linha = mysql_fetch_array($resultado);
                            extract($linha);
                            ?>
                                <img src="./adm/usuarios/arquivos/<?=$usuario_id?>/<?=$imagem?>" width="65" height="65" style="padding:3px; border:1px solid #999;" />
                                <h5 style="color:#fff"><?=$nome_usuario?></h5>
								<h5><?=$cargo?></h5>
                            <?



                        }

                        //GL Eventos Brasil
                        if($id == 2){

                            $SQL = "SELECT u.id as usuario_id, u.nome AS nome_usuario, u.imagem, c.nome AS cargo FROM usuarios u INNER JOIN cargos c ON u.cargos_id = c.id WHERE empresa_id = $id AND cargos_id = 104;";
                            //echo $SQL; 
                            $resultado = mysql_query($SQL);
                            $linha = mysql_fetch_array($resultado);
                            extract($linha);
                            ?>
                                <img src="./adm/usuarios/arquivos/<?=$usuario_id?>/<?=$imagem?>" width="65" height="65" style="padding:3px; border:1px solid #999;" />
                                <h5 style="color:#fff"><?=$nome_usuario?></h5>
								<h5><?=$cargo?></h5>
                            <?


                        }

                        // Riocentro
                        if($id == 3){

                            $SQL = "SELECT u.id as usuario_id, u.nome AS nome_usuario, u.imagem, c.nome AS cargo FROM usuarios u INNER JOIN cargos c ON u.cargos_id = c.id WHERE empresa_id = $id AND cargos_id = 64;";
                            //echo $SQL; 
                            $resultado = mysql_query($SQL);
                            $linha = mysql_fetch_array($resultado);
                            extract($linha);
                            ?>
                                <img src="./adm/usuarios/arquivos/<?=$usuario_id?>/<?=$imagem?>" width="65" height="65" style="padding:3px; border:1px solid #999;" />
                                <h5 style="color:#fff"><?=$nome_usuario?></h5>
								<h5><?=$cargo?></h5>
                            <?


                        }
						// HSBC ARENA
                        if($id == 4){

                            $SQL = "SELECT u.id as usuario_id, u.nome AS nome_usuario, u.imagem, c.nome AS cargo FROM usuarios u INNER JOIN cargos c ON u.cargos_id = c.id WHERE empresa_id = $id AND cargos_id = 64;";
                            //echo $SQL; 
                            $resultado = mysql_query($SQL);
                            $linha = mysql_fetch_array($resultado);
                            extract($linha);
                            ?>
                                <img src="./adm/usuarios/arquivos/<?=$usuario_id?>/<?=$imagem?>" width="65" height="65" style="padding:3px; border:1px solid #999;" />
                                <h5 style="color:#fff"><?=$nome_usuario?></h5>
								<h5><?=$cargo?></h5>
                            <?



                        }


                       if($id == 5){

                            $SQL = "SELECT u.id as usuario_id, u.nome AS nome_usuario, u.imagem, c.nome AS cargo FROM usuarios u INNER JOIN cargos c ON u.cargos_id = c.id WHERE empresa_id = $id AND cargos_id = 64;";
                            //echo $SQL; 
                            $resultado = mysql_query($SQL);
                            $linha = mysql_fetch_array($resultado);
                            extract($linha);
                            ?>
                                <img src="./adm/usuarios/arquivos/<?=$usuario_id?>/<?=$imagem?>" width="65" height="65" style="padding:3px; border:1px solid #999;" />
                                <h5 style="color:#fff"><?=$nome_usuario?></h5>
								<h5><?=$cargo?></h5>
                            <?

                        }


                        if($id == 6){

                            $SQL = "SELECT u.id as usuario_id, u.nome AS nome_usuario, u.imagem, c.nome AS cargo FROM usuarios u INNER JOIN cargos c ON u.cargos_id = c.id WHERE u.empresa_id = $id AND u.cargos_id = 64;";
                            //echo $SQL; 
                            $resultado = mysql_query($SQL);
                            $linha = mysql_fetch_array($resultado);
                            extract($linha);
                            ?>
                                <img src="./adm/usuarios/arquivos/<?=$usuario_id?>/<?=$imagem?>" width="65" height="65" style="padding:3px; border:1px solid #999;" />
                                <h5 style="color:#fff"><?=$nome_usuario?></h5>
								<h5><?=$cargo?></h5>
                            <?


                        }

						//TopGourmet
                        if($id == 7){

                            $SQL = "SELECT u.id as usuario_id, u.nome AS nome_usuario, u.imagem, c.nome AS cargo FROM usuarios u INNER JOIN cargos c ON u.cargos_id = c.id WHERE u.empresa_id = $id AND u.cargos_id = 118;";
                            //echo $SQL; 
                            $resultado = mysql_query($SQL);
                            $linha = mysql_fetch_array($resultado);
                            extract($linha);
                            ?>
                                <img src="./adm/usuarios/arquivos/<?=$usuario_id?>/<?=$imagem?>" width="65" height="65" style="padding:3px; border:1px solid #999;" />
                                <h5 style="color:#fff"><?=$nome_usuario?></h5>
								<h5><?=$cargo?></h5>
                            <?   

                        }

						//Gl Services
                        if($id == 8){

                            $SQL = "SELECT u.id as usuario_id, u.nome AS nome_usuario, u.imagem, c.nome AS cargo FROM usuarios u INNER JOIN cargos c ON u.cargos_id = c.id WHERE u.empresa_id = $id AND u.cargos_id = 64;";
                            //echo $SQL; 
                            $resultado = mysql_query($SQL);
                            $linha = mysql_fetch_array($resultado);
                            extract($linha);
                            ?>
                                <img src="./adm/usuarios/arquivos/<?=$usuario_id?>/<?=$imagem?>" width="65" height="65" style="padding:3px; border:1px solid #999;" />
                                <h5 style="color:#fff"><?=$nome_usuario?></h5>
								<h5><?=$cargo?></h5>
                            <?


                        }


                        if($id == 9){
                            $SQL = "SELECT u.id as usuario_id, u.nome AS nome_usuario, u.imagem, c.nome AS cargo FROM usuarios u INNER JOIN cargos c ON u.cargos_id = c.id WHERE u.empresa_id = $id AND u.cargos_id = 60;";
                            //echo $SQL; 
                            $resultado = mysql_query($SQL);
                            $linha = mysql_fetch_array($resultado);
                            extract($linha);
                            ?>
                                <img src="./adm/usuarios/arquivos/<?=$usuario_id?>/<?=$imagem?>" width="65" height="65" style="padding:3px; border:1px solid #999;" />
                                <h5 style="color:#fff"><?=$nome_usuario?></h5>
								<h5><?=$cargo?></h5>
                            <?


                        }


                        if($id == 13){
                            $SQL = "SELECT u.id as usuario_id, u.nome AS nome_usuario, u.imagem, c.nome AS cargo FROM usuarios u INNER JOIN cargos c ON u.cargos_id = c.id WHERE u.empresa_id = $id AND u.cargos_id = 64;";
                            //echo $SQL; 
                            $resultado = mysql_query($SQL);
                            $linha = mysql_fetch_array($resultado);
                            extract($linha);
                            ?>
                                <img src="./adm/usuarios/arquivos/<?=$usuario_id?>/<?=$imagem?>" width="65" height="65" style="padding:3px; border:1px solid #999;" />
                                <h5 style="color:#fff"><?=$nome_usuario?></h5>
								<h5><?=$cargo?></h5>
                            <?

                        }
						
						if($id == 19){
                            $SQL = "SELECT u.id as usuario_id, u.nome AS nome_usuario, u.imagem, c.nome AS cargo FROM usuarios u INNER JOIN cargos c ON u.cargos_id = c.id WHERE u.empresa_id = $id AND u.cargos_id = 156;";
                            //echo $SQL; 
                            $resultado = mysql_query($SQL);
                            $linha = mysql_fetch_array($resultado);
                            extract($linha);
                            ?>
                                <img src="./adm/usuarios/arquivos/<?=$usuario_id?>/<?=$imagem?>" width="65" height="65" style="padding:3px; border:1px solid #999;" />
                                <h5 style="color:#fff"><?=$nome_usuario?></h5>
								<h5><?=$cargo?></h5>
                            <?

                        }


                    ?>

					
				</div><!-- aguardando dados para carregar presidente ou diretor -->
			</div><!-- conteudo-topEmpresa para testar cor de fundos -->
        </div><!-- fim do topEmpresa -->
        <div id="box-contentDireita">
            <!-- <h1><?=$nome?></h1> -->
            <p><?=$descricao?></p>
				<div id="box-fotos-empresa">
                    <?
                        if($foto1 != ""){
                            ?>
                            <div class="foto-empresa">
                                <img src="./adm/empresas/arquivos/<?=$id?>/imagens/<?=$foto1?>" width="330" height="248" />
                            </div><!-- essa div vai carregar 1 foto e se repetirá a cada foto inserida no total de 2 adm -->
                            <?
                        }

                    ?>
                     <?
                        if($foto2 != ""){
                            ?>
                            <div class="foto-empresa">
                                <img src="./adm/empresas/arquivos/<?=$id?>/imagens/<?=$foto2?>" width="330" height="248" />
                            </div><!-- essa div vai carregar 1 foto e se repetirá a cada foto inserida no total de 2 adm --> 
                            <?
                        }

                    ?>					
				</div><!-- fim dqa box-fotos-empresa -->
					
        </div><!-- box-contentDireita -->
    
	</div><!-- box-categoriasDois -->
</div><!--Fim da div conteudo -->
<?
}

include("rodape.php");
?>  
