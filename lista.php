<?php
	$cod = $_POST["cod"];
	$dat = $_POST["dat"];

	include("conex.inc");

	if($cod == 1){
		$sql = "SELECT * FROM seven_horario";
	}

	if($cod == 2){
		$sql = "DELETE FROM seven_horario WHERE id = $dat";
		$resp = mysqli_query($link,$sql);
		if(!$resp){
			echo"Error:".mysql_error($link);
			exit;
		}
		$sql = "SELECT * FROM seven_horario";
	}
	
	$resp = mysqli_query($link,$sql);

	if(!$resp){
		echo"Error:".mysql_error($link);
		exit;
	}

	if(mysqli_num_rows($resp)==0){
		echo "Aun no has inscrito ninguna asignatura";
		exit;
	}

	echo "<table>";
	echo "<tr> 	<td>id</td> 	<td>Asignatura</td> 
				<td></td></tr>";

	$i = 0;
	while($fila = mysqli_fetch_row($resp)){
		echo "<tr> 
				<td id='us$i'>$fila[0]
				<td>$fila[1]</td>
				<td><button onclick='EliminaDato(2,$i)'>ELIMINAR</button></td> </tr>";
		$i = $i +1;
	}
	echo "</table>";

?>