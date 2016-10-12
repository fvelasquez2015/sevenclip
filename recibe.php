<html>
<head>
<meta charset="UTF-8">
<link rel="icon" href="favicon.png">
<link rel="stylesheet" type="text/css" href="estilos.css" >
<title>SevenClip</title>
<script src="scripts.js"></script>
</head>
<body> 
 <header>
 <div id="headx">
 	  <img id="headLogo" src="logo.png"/>
 	  <img src="7clip2.png" alt="logo" id="headPhrase" />  
      <div id="config" onmouseover="Color(this,cnf)" onmouseout="deColor(this,cnf)" onclick="opciones()" ><a id="cnf" href="#"><img src="config.png" alt="config" id="fotoconf"/></a></div>
      <a href="reg.html" style="text-decoration:none"><div id="regDiv" class="divPos" onmouseover="Color(this,regSp)" onmouseout="deColor(this,regSp)"><span id="regSp"class="midOpc">REGISTRARSE</span></div></a>
      <a href="sesion.html" style="text-decoration:none"><div id="logDiv" class="divPos" onmouseover="Color(this,logSp)" onmouseout="deColor(this,logSp)"><span id="logSp" class="midOpc">INICIAR SESION</span></div></a>
       <div id="opc" class="opt">
        <ul>
          <li><a href="#">Información</a></li>
          <li><a href="#">Ayuda</a></li>
        </ul>
        <img src="subir.png" onclick="quitaropciones()" id="up"/>
      </div>
    </div>
</div>
</header>
<div id="h1"><h1> ¡Has completado tu registro!</h1></div>
<div id="showInfo">
<?php
	//Recibir los datos del formulario
	//(vienen en un array llamado _GET)
	
	$rut = $_POST["rut"];
	$name = $_POST["name"];
	$lname = $_POST["lname"];
	$carr = $_POST["carr"];
	$mail = $_POST["mail"];
	$pass = $_POST["pass"];
	$year = $_POST["year"];
	if (isset($_POST['notif'])) {
		$notif="Si";
	} else{
	 	$notif="No";
	}
?>

<p><?php  echo "Bienvenido a SevenClip <b>$name $lname</b> te agradecemos querer formar <br/>
		  parte de este nuevo proyecto para ayudarte en tu organización diaria.<br/>
		  <br/>
		  A continuación dejaremos tus datos con los que te has registrado.<br/>
		  <br/>
		  Rut: <b>$rut</b><br/>
		  Nombre: <b>$name</b><br/>
		  Apellido: <b>$lname</b><br/>
		  Carrera: <b>$carr</b><br/>
		  Correo: <b>$mail</b><br/>
		  Clave: <b>$pass</b><br/>
		  Notificaciones: <b>$notif</b><br/>
		  Año actual carrera: <b>$year</b><br/>
		  <br/>
		  Recuerda revisar tu mail, recibiras un correo con tus datos 
			de todas maneras.
			!Gracias por registrarte!
		  <br/>
		  <br/>
		  SevenClip."
?></p>
</div>
</body>
</html>