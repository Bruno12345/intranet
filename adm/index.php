<?
error_reporting(0);
session_start();
require_once("../engine/conexao.php");
include_once("../engine/funcoes.php");
logadoAdmin();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

<!-- Apple iOS and Android stuff (do not remove) -->
<meta name="apple-mobile-web-app-capable" content="no" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />

<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no,maximum-scale=1" />

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="../engine/css/reset.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../engine/css/text.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../engine/css/fonts/ptsans/stylesheet.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../engine/css/fluid.css" media="screen" />

<link rel="stylesheet" type="text/css" href="../engine/css/mws.style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../engine/css/icons/16x16.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../engine/css/icons/24x24.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../engine/css/icons/32x32.css" media="screen" />

<!-- Demo and Plugin Stylesheets -->
<link rel="stylesheet" type="text/css" href="../engine/css/demo.css" media="screen" />

<link rel="stylesheet" type="text/css" href="../engine/plugins/colorpicker/colorpicker.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../engine/plugins/imgareaselect/css/imgareaselect-default.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../engine/plugins/fullcalendar/fullcalendar.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../engine/plugins/fullcalendar/fullcalendar.print.css" media="print" />
<link rel="stylesheet" type="text/css" href="../engine/plugins/chosen/chosen.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../engine/plugins/prettyphoto/css/prettyPhoto.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../engine/plugins/tipsy/tipsy.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../engine/plugins/sourcerer/Sourcerer-1.2.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../engine/plugins/jgrowl/jquery.jgrowl.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../engine/plugins/spinner/ui.spinner.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../engine/jui/css/jquery.ui.all.css" media="screen" />

<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="../engine/css/mws.theme.css" media="screen" />

<!-- JavaScript Plugins -->
<script type="text/javascript" src="../engine/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../engine/js/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="../engine/js/jquery.placeholder.js"></script>
<script type="text/javascript" src="../engine/js/jquery.fileinput.js"></script>

<!-- jQuery-UI Dependent Scripts -->
<script type="text/javascript" src="../engine/jui/js/jquery-ui.js"></script>
<script type="text/javascript" src="../engine/jui/js/jquery.ui.timepicker.js"></script>
<script type="text/javascript" src="../engine/jui/js/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="../engine/plugins/spinner/ui.spinner.min.js"></script>

<!-- Plugin Scripts -->
<script type="text/javascript" src="../engine/plugins/imgareaselect/jquery.imgareaselect.min.js"></script>
<script type="text/javascript" src="../engine/plugins/duallistbox/jquery.dualListBox-1.3.min.js"></script>
<script type="text/javascript" src="../engine/plugins/jgrowl/jquery.jgrowl-min.js"></script>
<script type="text/javascript" src="../engine/plugins/fullcalendar/fullcalendar.min.js"></script>
<script type="text/javascript" src="../engine/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../engine/plugins/chosen/chosen.jquery.min.js"></script>
<script type="text/javascript" src="../engine/plugins/prettyphoto/js/jquery.prettyPhoto.min.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="../engine/plugins/flot/excanvas.min.js"></script>
<![endif]-->
<script type="text/javascript" src="../engine/plugins/flot/jquery.flot.min.js"></script>
<script type="text/javascript" src="../engine/plugins/flot/jquery.flot.pie.min.js"></script>
<script type="text/javascript" src="../engine/plugins/flot/jquery.flot.stack.min.js"></script>
<script type="text/javascript" src="../engine/plugins/flot/jquery.flot.resize.min.js"></script>
<script type="text/javascript" src="../engine/plugins/colorpicker/colorpicker-min.js"></script>
<script type="text/javascript" src="../engine/plugins/tipsy/jquery.tipsy-min.js"></script>
<script type="text/javascript" src="../engine/plugins/sourcerer/Sourcerer-1.2-min.js"></script>
<script type="text/javascript" src="../engine/plugins/smartwizard/js/jquery.smartWizard-2.0.js"></script>
<script type="text/javascript" src="../engine/plugins/validate/jquery.validate-min.js"></script>

<!-- Core Script -->
<script type="text/javascript" src="../engine/js/core/mws.js"></script>

<!-- Themer Script (Remove if not needed) -->
<title>Painel | GL events Brasil</title>

</head>

<body>
	<!-- Header -->
	<div id="mws-header" class="clearfix">

    	<!-- Logo Container -->
    	<div id="mws-logo-container">

        	<!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
        	<div id="mws-logo-wrap">
                   <h1 class="tit-topo">GL events</h1>
                    <!--
            	<img src="images/mws-logo.png" alt="mws admin" />
		-->
			</div>
        </div>

        <!-- User Tools (notifications, logout, profile, change password) -->
        <div id="mws-user-tools" class="clearfix">

            <!-- User Information and functions section -->
            <div id="mws-user-info" class="mws-inset">

            	<!-- User Photo
            	<div id="mws-user-photo">
                	<img src="example/profile.jpg" alt="User Photo" />
                </div>
                -->
                <!-- Username and Functions -->
                <div id="mws-user-functions">
                    <div id="mws-username">
                        Bem Vindo, <?=$_SESSION['user_nome'];?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Main Wrapper -->
    <div id="mws-wrapper">

    	<!-- Necessary markup, do not remove -->
		<div id="mws-sidebar-stitch"></div>
		<div id="mws-sidebar-bg"></div>

          <div id="mws-sidebar">


            <!-- Main Navigation -->
            <div id="mws-navigation">
                    <ul>
                        <li><a href="./cargos/" class="mws-i-24 i-tag">Cargos</a></li>
                        <li><a href="./comunicados/" class="mws-i-24 i-speech-bubbles-1">Comunicados</a></li>
                        <li><a href="./empresas/" class="mws-i-24 i-tag">Empresas</a></li>
                        <li><a href="./eventos/" class="mws-i-24 i-tag">Eventos</a></li>
                        <li><a href="./noticias/" class="mws-i-24 i-tag">Noticias</a></li>
                        <li><a href="./posts/" class="mws-i-24 i-tag">Politicas</a></li>
                        <li><a href="./tvs/" class="mws-i-24 i-television">TVS</a></li>
                        <li><a href="./projetos/" class="mws-i-24 i-paperclip">Projetos</a></li>
                        <li><a href="./setores/" class="mws-i-24 i-tag">Setores</a></li>
                        <li><a href="./sistemas/" class="mws-i-24 i-money">Sistemas</a></li>
                        <li><a href="./fotos/" class="mws-i-24 i-image-2">Album de Fotos</a></li>
                        <li><a href="./media/" class="mws-i-24 i-tag">Documentos</a></li>
                        <li><a href="./imagens/" class="mws-i-24 i-image">Banco de imagens</a></li>
                        <li><a href="./logos/" class="mws-i-24 i-tag">Logomarcas</a></li>
                        <li><a href="./downloads/" class="mws-i-24 i-tag">Apresenta&ccedil;&atilde;o</a></li>
                        <li><a href="./usuarios/" class="mws-i-24 i-user">Usu&aacute;rios</a></li>
                    </ul>
               </div>
        </div>
        <div id="mws-container" class="clearfix">
        	<!-- Inner Container Start -->
            <div class="container">
           </div>
  </div>
<div class="mws-panel grid_8">
    </div>
        <!-- Footer -->
            <div id="mws-footer">
            	GL Events Brasil 2012. Todos os direitos reservados.
            </div>

        </div>
        <!-- Main Container End -->
</body>
</html>


