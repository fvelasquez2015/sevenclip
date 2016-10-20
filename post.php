<?php

	$desc = $_POST["Desc"];
	$fecha = $_POST["Fecha"];
	$hora = $_POST["Hora"];
	$tipo = $_POST["Tipo"];
	
	include('conex.inc');

	$sql = "INSERT INTO datos_calendario (id_usuario, desc_calendario, fecha_calendario, tipo_calendario)";
	$sql.= "VALUES('01','$desc','$fecha/$hora','$tipo')";

	$insertar = mysqli_query($link,$sql);

	//Chequeamos que la consulta fue bien ejecutada (esto es para eldesarrllador)
  	if(!$insertar) {
      	echo "Error: ".mysqli_error($link);
      	exit;
  	}
  	else{
  		header('Location: calendario.html');
  	}


  ?>