<?php
	
	//Se encarga de buscar los eventos del calendario para graficar una linea bajo el dia

	$id_user  = $_POST["usuario"];
	$dia   	  = $_POST["dia" ];
	$mes      = $_POST["mes" ];
	$year     = $_POST["year"];

	$id_user = intval($id_user);

	if ($mes == 'Enero')		{$mes = 1;}
	if ($mes == 'Febrero')		{$mes = 2;}
	if ($mes == 'Marzo')		{$mes = 3;}
	if ($mes == 'Abril')		{$mes = 4;}
	if ($mes == 'Mayo')			{$mes = 5;}
	if ($mes == 'Junio')		{$mes = 6;}
	if ($mes == 'Julio')		{$mes = 7;}
	if ($mes == 'Agosto')		{$mes = 8;}
	if ($mes == 'Septiembre')	{$mes = 9;}
	if ($mes == 'Octubre')		{$mes = 10;}
	if ($mes == 'Noviembre')	{$mes = 11;}
	if ($mes == 'Diciembre')	{$mes = 12;}
	

	$fecha = $year.'-'.$mes.'-'.$dia;
	//$fecha = date("Y-m-d", strtotime("$fecha"));

	include("conex.inc");

	$sql = "SELECT tipo_calendario FROM seven_calendario WHERE fecha_calendario='$fecha' AND id_usuario='$id_user'";

	$resp = mysqli_query($link,$sql);

	if(!$resp){
		echo"Error:".mysql_error($link);
	}

	$i=0;
	if(mysqli_num_rows($resp)==0){
		echo "$fecha";
	}
	else{
		while($fila = mysqli_fetch_row($resp)){
			if($fila[0]>$i){
				$i = $fila[0];
			}
		}
		echo "$i";
	}
?>