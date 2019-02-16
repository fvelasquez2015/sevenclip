<?php

	//Muestra todos los datos del calendario segun el usuario

	$id_user  = $_POST["usuario"];
	$id_user  = intval($id_user);

	include("conex.inc");

	$sql = "SELECT * FROM seven_calendario WHERE id_usuario='$id_user' ORDER BY fecha_calendario DESC";

	$resp = mysqli_query($link,$sql);

	if(!$resp){
		echo"Error:".mysql_error($link);
	}

	if(mysqli_num_rows($resp)==0){
		echo "<a href='javascript:cierraVent02()'' id='btnX'>X</a>
		<br><p style='color:black'>No hay datos en el Calendario </p>";
	}
	else{
		echo "<div id='form01'>
			<a href='javascript:cierraVent02()' id='btnX'>X</a>
			<fieldset>
				<legend>Informacion:</legend><br>";
		echo "<table>";
		echo "<tr style='background:black; color:white;'> 	<td style='width:180px;'>Descripcion</td> 	<td style='width:80px;'>Fecha</td> 
					<td style='width:40px;'>Hora</td> 	
					<td></td><td></td></tr>";

		while($fila = mysqli_fetch_row($resp)){
			echo "<tr> 
					<td style='display:none' id='idCal'>$fila[0]</td> 
					<td style='display:none' id='idUser'>$fila[1]</td>
					<td><input id='desc$fila[0]' type='text' value=$fila[2] style='width:180px;'> </td> 
					<td><input id='fecha$fila[0]' class='edit' type='date' value=$fila[3]> </td>
					<td><input id='hora$fila[0]' class='edit' type='time' value=$fila[4] style='width:80px;'> </td> 
					<td><button onclick='UpdateEvent($fila[0])'>Guardar</button></td>
					<td><button id='x' onclick='EliminaEvent($fila[0])'>X</button></td> </tr>";
		}
		echo "</table>
				</fieldset>
				</div>";
	}
?>