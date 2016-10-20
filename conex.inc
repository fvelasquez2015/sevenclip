<?php
	$host     = "localhost";
	$user     = "root";
	$passw    = "";
	$basedato = "calendario";

	$link = mysqli_connect($host, $user, $passw, $basedato);
	mysqli_set_charset($link,'utf8');

	//validamos si se conecto con exito 
	if(!$link){
		echo "Error de conexion N°". mysqli_connect_errno()."<br />";
		echo mysqli_connect_error(); // texto detalle de error
		exit;
	}
?>