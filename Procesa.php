<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="estilos.css" >
<title>Actividad 03</title>
<div id="headx">
  <img src="logofront.png" alt="logo" />
  <a id="login" href="#">Iniciar sesión</a>
  <a id="regist" href="#">Registrarse</a>
</div>
<?php
	//Recibir los datos del formulario
	//(vienen en un array llamado _GET)
	
	$rut = $_POST["rut"];
	$name = $_POST["apel"];
	$lname = $_POST["ciud"];
	$carr = $_POST["sexo"];
	$mail = $_POST["info"];
	$pass = $_POST["rega"];
	if (isset($_POST['notif'])) {
		$notif="Si";
	} else{
	 	$notif="No";
	}

   // Alternate code
	echo "Estimado/a Sr/a <b>$nom $ape</b>: <br/>
		  Agradecemos su confianza en nosotros bla bla bla.<br>
		  Recibira directo en su $ciu una $reg $notif <br/><br/>
		  
		  Atte. ACME Ltda."
?>
</html>