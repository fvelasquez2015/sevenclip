<?php
	
	//Muestra la informacion del dia que se hizo click en el calendario

	$id_user  = $_POST["user"];
	$dia   = $_POST["dia" ];
	$mes   = $_POST["mes" ];
	$year  = $_POST["year"];

	$id_user = intval($id_user);
	$fecha = $year.'-'.$mes.'-'.$dia;
	$fecha = date("Y-m-d", strtotime("$fecha"));
	
	include("conex.inc");

	$sql = "SELECT * FROM seven_calendario WHERE fecha_calendario='$fecha' AND id_usuario='$id_user'";

	$resp = mysqli_query($link,$sql);

	if(!$resp){
		echo"Error:".mysql_error($link);
	}

	if(mysqli_num_rows($resp)==0){
		echo "<br><p style='color:black'>Este dia no posee datos </p>";
	}
	else{
		echo "<div id='infEvent'>
			<fieldset>
				<legend>Informacion:</legend><br>";
		echo "<table>";
		echo "<tr style='background:black; color:white;'> 	<td>Descripcion</td> 	<td>Fecha</td> 
					<td>Hora</td> 	</tr>";

		while($fila = mysqli_fetch_row($resp)){
			echo "<tr> 
					<td style='display:none' id='idCal'>$fila[0]</td> 
					<td style='display:none' id='idUser'>$fila[1]</td>
					<td style='width:150px;'>$fila[2]</td> <td style='width:90px;'>$fila[3]</td>
					<td>$fila[4]</td> 
					</tr>";
		}
		echo "</table>
				</fieldset>
				</div>";
	}

	

?>