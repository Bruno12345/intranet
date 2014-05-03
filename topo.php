<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" /><!-- meta que renderiza no IE como google chrome -->

<title>GL events Brasil | Intranet</title>

<link href="./css/style.css" rel="stylesheet" type="text/css" media="screen" />


</head>

<body>
<div id="container">
  <div id="topo">
  	<div id="logo">
    	<a href="principal.php"><img src="./images/topo/logo_gl.png" alt="GL events" title="GL events Brasil" width="300" height="80"  /></a>
    </div><!-- fim da div logo -->
    <div id="logUsuario">
    	 <div id="avatar">
            <?
                $SQL = "SELECT COUNT(imagem) FROM usuarios WHERE id = ".$_SESSION['user_id'].";";
                $qtd = mysql_result(mysql_query($SQL),0);
                
                if($qtd ==0 ){
                    ?><img src="./images/topo/avatar.jpg" width="75" height="75" /><?
                }else{
                    
                    $SQL2 = "SELECT imagem FROM usuarios WHERE id = ".$_SESSION['user_id'].";";
                    $imagem = mysql_result(mysql_query($SQL2),0);                       
                    ?><img src="./adm/usuarios/arquivos/<?=$_SESSION['user_id']?>/<?=$imagem?>" width="75" height="75" /><?
                }

            ?>
        	
         </div><!-- fim div avatar --> 
            <h5>Seja bem vindo(a) <?=$_SESSION['user_nome']?></h5>
            <ul id="menuLog">
              <li><a href="http://www.glbrintranet.com.br/posts.php?id=11"><img src="images/topo/portalrh.png" title="Portal RH" />
              </a></li>
              <?
                $SQL = "SELECT email FROM usuarios WHERE id = ".$_SESSION['user_id'].";";
                $email = mysql_result(mysql_query($SQL),0);
                $idUsers = $_SESSION['user_id'];

              ?>
              <li><a href="<? redEmail($email); ?>" target="_blank"><img src="./images/topo/webmail.png" /></a></li>
              <li><a href="perfil.php?id=<?=$idUsers?>"><img src="./images/topo/editarperfil.png" title="Editar Perfil" /></a></li>
              <li><a href="logout.php"><img src="./images/topo/sair.png" title="Sair" /></a></li>
        	</ul>
    </div><!-- fim da div logUsuario -->
    
    <ul id="menu">
    	<li class="red"><a href="principal.php">Home</a></li>
        <li class="ave"><a href="#">Institucional</a>
        	<ul class="submenu">
            	<li><a href="empresa.php?id=1">Conheça o Grupo GL events</a></li>
                <li><a href="http://intranet.gl-events.com/" target="_blank">Intranet Internacional</a></li>
                <li><a href="ramais.php?id=31">Lista de Ramais</a></li>
                <li><a href="sites.php">Sites</a></li>
                <li><a href="projetos.php">Projetos</a></li>
             </ul>
        </li>		
        <li class="blu"><a href="#">Mídia Center</a>
            <ul class="submenu">
                <li><a href="apresentacaoDet.php?id=7">Apresentações</a></li>
                <li><a href="imagensDet.php?id=6">Banco de Imagens</a></li>
                <li><a href="logosDet.php?id=12">Logomarcas</a></li>
                <li><a href="midiaDet.php?id=12">Documentos</a></li>
                <li><a href="noticias.php">Notícias</a></li>
                <li><a href="fotosDet.php?id=8">Galeria de Fotos</a></li>
            </ul>
        </li>
        <li class="lar"><a href="#">Departamentos</a>
            <ul class="submenu">
                <?
                    $SQL = "SELECT * FROM setores WHERE visivel = 1 ORDER BY  nome ASC";
                    $resultado = mysql_query($SQL);
                    while($linha = mysql_fetch_array($resultado)){
                        extract($linha);

                        $SQL2 = "SELECT id AS post_id FROM posts WHERE setores_id = $id ORDER BY titulo LIMIT 1";
                        $resultado2 = mysql_query($SQL2);
                        while($linha2 = mysql_fetch_array($resultado2)){
                            extract($linha2);
                            ?>
                                <li><a href="posts.php?id=<?=$post_id?>"><?=$nome;?></a></li>
                            <?                            
                        }
                                    
                    }
                ?>  
                <!--<li><a href="listadepartamentos.php">Todos</a></li>-->        	                
            </ul>
        </li>                
        <li class="azu"><a href="#">Sistemas</a>
        	<ul class="submenu">
            	<li><a href="#" target="_blank">Helpdesk</a></li>
                 <?
                    $SQL = "SELECT * FROM sistemas WHERE visivel = 1 ORDER BY nome ASC";
                    $resultado = mysql_query($SQL);
                    while($linha = mysql_fetch_array($resultado)){
                        extract($linha);
                        ?>
                            <li><a href="http://<?=$link?>" target="_blank"><?=$nome?></a></li>
                        <?                        
                    }
                ?> 
                <?
                    if($_SESSION['admin'] == 1){
                        ?><li><a href="./adm/" target="_blank" >Administração</a></li><?                        
                    }
                ?>                 
            </ul>
        </li>
        
		<li class="rox"><a href="eventos.php">Eventos</a>
        	<ul class="submenu">
                 <?
                    $SQL = "SELECT e.id, e.nome FROM empresa e WHERE  (SELECT COUNT(*) FROM eventos WHERE empresa_id = e.id) > 0  ORDER BY  e.nome ASC";
                    $resultado = mysql_query($SQL);
                    while($linha = mysql_fetch_array($resultado)){
                        extract($linha);
                        ?>
                            <li><a href="eventosEmp.php?id=<?=$id?>"><?=$nome?></a></li>
                        <?                        
                    }
                ?> 
            </ul>
        </li>
		<li style="margin-left:25px; width:24px;"><a href="https://www.facebook.com/GLeventsBrasil?fref=ts" target="_blank"><img src="./images/topo/icone_facebook.png" title="Facebook" /></a></li>
		<li style="margin-left:5px; width:24px;"><a href="https://twitter.com/GLeventsBrasil" target="_blank"><img src="./images/topo/icone_twitter.png" title="Twitter" /></a></li>
		<li style="margin-left:5px; width:24px;"><a href="http://www.linkedin.com/company/2813085?trk=tyah" target="_blank"><img src="./images/topo/icone_linkedin.png" title="Linkedin" /></a></li>
    </ul><!--fim do menu principal -->
    <div id="search">
   		<form action="search.php" method="post" id="busca" name="busca">
        	<table align="right" cellpadding="2" cellspacing="2">
            	<tr>
                	<td><input type="text" id="pesquisar" name="q" size="30"  /></td>
                    <td class="buscar"><input type="submit" id="buscar" name="buscar "value="OK" /></td>
                </tr>
            </table>
    </form>
    </div><!-- fim da div search -->
  </div> <!--fim do topo-->
