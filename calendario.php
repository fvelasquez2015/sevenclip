<?php
  include("conex.inc");
  include("revisaSesion.php");
  $correo = $_SESSION['logear_usuario'];
  $sql = mysqli_query($link,"SELECT id_usuario,nombres FROM seven_usuario WHERE correo = '$correo'");
  $row = mysqli_fetch_array($sql);
  $id_usuario = $row[0];
  $nombre = $row[1];
?>  
<!DOCTYPE html>
<html>
	<head>
		<title>Calendario</title>
		<meta charset="utf-8">
		<link rel="icon" href="favicon.png">
		<script type="text/javascript" src="scripts-calendario.js"></script>
		<script type="text/javascript" src="jquery-3.1.1.js"></script>
    	<link rel="stylesheet" type="text/css" href="estilos-calendario.css" >
    	<script type="text/javascript">
    		$(document).ready(Principal);
    		function Principal(){
    			$('#btnNuevo').click(abreVent01);
    			$('#btnCancelar').click(cierraVent01);
    		}
    		function abreVent01(){
				$("#ventana01").slideDown("fast");	
			}		

			function cierraVent01(){
				$("#ventana01").slideUp("fast");	
			}

			function abreVent02(){
				$("#ventana02").slideDown("fast");	
			}

			function cierraVent02(){
				$("#ventana02").slideUp("fast");	
			}

			if (window.XMLHttpRequest) objAjax = new XMLHttpRequest() //para Mozilla
			else if (window.ActiveXObject) objAjax = new ActiveXObject("Microsoft.XMLHTTP") //Para IExplorer

			function TraerDatos(dia,mes,year,user=<?php echo "$id_usuario" ?>){
				objAjax.open("POST","datos01.php");
				objAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				objAjax.send("user="+user+"&dia="+dia+"&mes="+mes+"&year="+year);
				objAjax.onreadystatechange = MostrarDatos;
			}
			
			function MostrarDatos(){
				if(objAjax.readyState == 4){
					document.getElementById("info").innerHTML = objAjax.responseText;
				}
			}

			function MostrarEvent(user=<?php echo "$id_usuario" ?>){
		        var parametros = {
		                "usuario" : user,
		        };
		        $.ajax({
		                data:  parametros,
		                url:   'datos03.php',
		                type:  'post',
		                beforeSend: function () {
		                        //$("#resultado").html("Procesando, espere por favor...");
		                },
		                success:  function (response) {
		                        $("#ventana02").html(response);
		                        abreVent02();
		                }
		        });
			}

			function EliminaEvent(id_event, id_user=<?php echo "$id_usuario" ?>){
				var mensaje = confirm("Esta Seguro(a) de Eliminar el Dato?");
				if (mensaje) {
					var parametros = {
						"id_user"  : id_user,
			            "id_event" : id_event
			        };
			        $.ajax({
			                data:  parametros,
			                url:   'datos04.php',
			                type:  'post',
			                beforeSend: function () {
			                        //$("#resultado").html("Procesando, espere por favor...");
			                },
			                success:  function (response){
			                		MostrarEvent();
			                }
			        });
			    }
			}

			function UpdateEvent(id_event, id_user=<?php echo "$id_usuario" ?>){
				var parametros = {
						"id_user"  : id_user,
			            "id_event" : id_event,
			            "desc"     : document.getElementById("desc"+id_event).value,
			            "fecha"    : document.getElementById("fecha"+id_event).value,
			            "hora"     : document.getElementById("hora"+id_event).value
			        };
			        $.ajax({
			                data:  parametros,
			                url:   'datos05.php',
			                type:  'post',
			                beforeSend: function () {
			                        //$("#resultado").html("Procesando, espere por favor...");
			                },
			                success:  function (response){
			                		alert(response);
			                		MostrarEvent();
			                }
			        });
			}

			function exDatos(td){
				var dia = td.innerHTML;
				var fecha = document.getElementById('mesYAnno').innerHTML;
				var mes = fecha.split(" ")[0];
				var year = fecha.split(" ")[1];
				if(mes=='Enero')	{mes = 1;}
				if(mes=='Febrero')	{mes = 2;}
				if(mes=='Marzo')	{mes = 3;}
				if(mes=='Abril')	{mes = 4;}
				if(mes=='Mayo')		{mes = 5;}
				if(mes=='Junio')	{mes = 6;}
				if(mes=='Julio')	{mes = 7;}
				if(mes=='Agosto')	{mes = 8;}
				if(mes=='Septiembre'){mes = 9;}
				if(mes=='Octubre')	{mes = 10;}
				if(mes=='Noviembre'){mes = 11;}
				if(mes=='Diciembre'){mes = 12;}
				TraerDatos(dia,mes,year);
			}
			function confirmaDia(nodo, dia, mes, year, user=<?php echo "$id_usuario" ?>){
		        var parametros = {
		                "usuario" : user,
		                "dia"  : dia,
		                "mes"  : mes,
		                "year" : year
		        };
		        $.ajax({
		                data:  parametros,
		                url:   'datos02.php',
		                type:  'post',
		                beforeSend: function () {
		                        //$("#resultado").html("Procesando, espere por favor...");
		                },
		                success:  function (response) {
		                        //$("#resultado").html(response);
		                        if (response == 1){
		                        	nodo.style.borderBottom = "2px solid #FFFF00";
		                        }
		                        if (response == 2){
		                        	nodo.style.borderBottom = "2px solid #FF8000";
		                        }
		                        if (response == 3){
		                        	nodo.style.borderBottom = "3px solid red";
		                        } 
		                }
		        });
		}
		</script>
	</head>
	<body>
		<header>
	    <div id="headx">
	      	<img src="logox.png" alt="logo" id="headPhrase" />   
	      	<div id="config" onmouseover="Color(this,cnf)" onmouseout="deColor(this,cnf)" onclick="opciones()" ><a id="cnf" href="#"><img src="sets.png" alt="config" id="fotoconf"/></a></div>
	      	<a href="#"><div id="perfil" class="divPos" onmouseover="Color(this,pS)" onmouseout="deColor(this,pS)"><span id="pS" class="midOpc">MI PERFIL</span></div></a>
	      	<a href="#"><div id="nota" class="divPos" onmouseover="Color(this,nS)" onmouseout="deColor(this,nS)"><span id="nS" class="midOpc">CALIFICACIONES</span></div></a>
	      	<a href="#"><div id="curso" class="divPos" onmouseover="Color(this,cS)" onmouseout="deColor(this,cS)"><span id="cS" class="midOpc">CURSOS</span></div></a>
	      	<a href="calendario.html"><div id="calen" class="divPos" onmouseover="Color(this,clS)" onmouseout="deColor(this,clS)"><span id="clS" class="midOpc">CALENDARIO</span></div></a>
	      	<a href="#"><div id="hora" class="divPos" onmouseover="Color(this,hS)" onmouseout="deColor(this,hS)"><span id="hS" class="midOpc">HORARIO</span></div></a>
	    </div>
	      	<div id="opc" class="opt">
	        <ul>
	          	<li><a href="#">Información</a></li>
	          	<li><a href="#">Configurar perfil</a></li>
	          	<li><a href="#">Ayuda</a></li>
	          	<li><a href="index.html">Cerrar sesión</a></li>
	        </ul>
	        <img src="subir.png" onclick="quitaropciones()" id="up" alt="subir" />
	      	</div>
	    </header>
	    <div id="ventana01">
	    	<div id="form01" >
				<fieldset>
				<legend>Nuevo Evento:</legend>
				<a href="javascript:cierraVent01()" id="btnX">X</a>
				<form action="datos00.php" method="POST">
				<table>
					<tr>
						<td style="display:none;"><input type="text" value=<?php echo "$id_usuario" ?> name="id_user">		</td>
						<td><label>Descripcion:</label> 			</td>
						<td><input type="text" name="Desc">		    </td>
					</tr>
					<tr>
						<td><label>Fecha:</label> 					</td>
						<td><input type="date" name="Fecha" required="required"></td>
					</tr>
					<tr>
						<td><label>Hora:</label> 					</td>
						<td><input type="time" name="Hora" required="required"></td>
					</tr>
					<tr>
						<td><label>Tipo:</label> 					</td>
						<td>
							<select name="Tipo" style="width:205px; height:25px; border-radius:5px;">
								<option value="0">-Seleccione-</option>
								<option value="01">Normal</option>
								<option value="02">Relevante (notificacion)</option>
								<option value="03">Muy Importante (notificacion)</option>
							</select>							 
						</td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="btnGuardar" id="btnGuardar" value="Guardar"></td>						
					</tr>
				</table>
				</form>
				</fieldset>
			</div>
	    </div>

	    <div id='ventana02'>
	    	
	    </div>

		<br>
		<div id="caja">
			<div style="margin-left:10%;">
				<div style="border-bottom:2px solid #FFFF00; width:80px; font-size:15px; font-family:Arial; float:left;">Normal</div>
				<div style="border-bottom:2px solid #FF8000; width:80px; font-size:15px; font-family:Arial;float:left;">Medio</div>
				<div style="border-bottom:2px solid red; width:80px; font-size:15px; font-family:Arial;float:left;">Importante</div>
			</div><br><br>
			<table id="tablaP">
				<tr>
					<td>
						<table id="tablaC">
						<tr>
							<td colspan="7" id="mesYAnno"></td>
						</tr>
						<tr  id="nDias">
							<td class="nDia"></td><td class="nDia"></td><td class="nDia"></td><td class="nDia"></td><td class="nDia"></td><td class="nDia"></td><td class="nDia"></td>
						</tr>
						<tr>
							<td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td>
						</tr>
						<tr>
							<td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td>
						</tr>
						<tr>
							<td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td>
						</tr>
						<tr>
							<td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td>
						</tr>
						<tr>
							<td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td>
						</tr>
						<tr>
							<td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td><td class="dia" onclick="exDatos(this)"></td> 
						</tr>
						</table>
					</td>
				</tr>
			</table>

			<div id="divBtn">
				<button class="btnS" id="btnNuevo">Nuevo Evento</button>
				<button class="btnS" id="btnMostrar" onclick="MostrarEvent()">Mostrar Eventos</button>
				<div id="info">
					<p>Informacion: Haz click sobre un dia para ver su informacion.</p>
				</div>
			</div>
			

		</div>

		
		
		
		<span id="prueba"></span>
	</body>
</html>