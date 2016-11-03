<?php
	
	//Actualiza un dato 

	$id_user  = $_POST["id_user" ];
	$id_event = $_POST["id_event"];
	$desc 	  = $_POST["desc"    ];
	$fecha    = $_POST["fecha"   ];
	$hora     = $_POST["hora"    ];


	include("conex.inc");

	$sql = "UPDATE seven_calendario SET desc_calendario='$desc', fecha_calendario='$fecha', hora_calendario='$hora'  WHERE id_usuario=$id_user AND id_calendario=$id_event";

	$resp = mysqli_query($link,$sql);

	if(!$resp){
		echo"Error:".mysql_error($link);
	}

	echo "$id_user, $id_event, $desc, $fecha, $hora";
?>