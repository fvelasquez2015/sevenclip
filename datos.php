<?php

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
		echo "<a href='javascript:cierraVent02()'' id='btnX'>X</a>
		<br>Este dia no posee datos ";
	}
	else{
		echo "<div id='form01'>";
		echo "<a href='javascript:cierraVent02()'' id='btnX'>X</a>
			<fieldset>
				<legend>Informacion:</legend>";
		echo "<table>";
		echo "<tr style='background:black; color:white;'> 	<td>Descripcion</td> 	<td>Fecha</td> 
					<td>Hora</td> 	<td>Tipo</td> 
					<td></td></tr>";

		while($fila = mysqli_fetch_row($resp)){
			echo "<tr> 
					<td style='display:none' id='idCal'>$fila[0]</td> 
					<td style='display:none' id='idUser'>$fila[1]</td>
					<td>$fila[2]</td> <td>$fila[3]</td>
					<td>$fila[4]</td> <td>$fila[5]</td>
					<td><button onclick='EliminaDato(2,$fila[0])'>Eliminar</button></td> </tr>";
		}
		echo "</table>
				</fieldset>
				</div>";
	}

	

?>