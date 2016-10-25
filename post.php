<?php

	$desc = $_POST["Desc"];
	$fecha = $_POST["Fecha"];
	$hora = $_POST["Hora"];
	$tipo = $_POST["Tipo"];
	
	include('conex.inc');

	$sql1 = "INSERT INTO seven_calendario (id_usuario, desc_calendario, fecha_calendario, hora_calendario, tipo_calendario)";
	$sql1.= "VALUES('01','$desc','$fecha','$hora','$tipo')";

	//$sql2 = "INSERT INTO seven_notificaiones (id_usuario, id_calendario, desc_notificacion, tipo_notificacion)"; 
	$insertar = mysqli_query($link,$sql1);

	//Chequeamos que la consulta fue bien ejecutada (esto es para eldesarrllador)
  	if(!$insertar) {
      	echo "Error: ".mysqli_error($link);
      	exit;
  	}
  	else{
  		header('Location: calendario.html');
  	}




  ?>