<?php

session_start();


unset ($_SESSION['user_id']);
unset ($_SESSION['user_nome']);
unset ($_SESSION['user_tipo']);
unset ($_SESSION['admin']);
$_SESSION['acesso_guia'] = FALSE;
unset ($_SESSION['acesso_guia']);
header("location: index.php");

?>
