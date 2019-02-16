<?php
	
	//Elimina un dato

	$id_user  = $_POST["id_user"];
	$id_event = $_POST["id_event"];

	include("conex.inc");

	$sql = "DELETE FROM seven_calendario WHERE id_usuario=$id_user AND id_calendario=$id_event";

	$resp = mysqli_query($link,$sql);

	if(!$resp){
		echo"Error:".mysql_error($link);
	}
?>