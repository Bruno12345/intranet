<?

$arquivo = $_GET["arquivo"];
if(isset($arquivo) && file_exists($arquivo)){

	header("Content-Type: octet/stream");
	header("Content-Length: ".filesize($arquivo)); 
	header("Content-Disposition: attachment; filename=".basename($arquivo)); 
	readfile($arquivo);
	exit;

}

?>