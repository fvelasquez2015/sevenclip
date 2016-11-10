<?php
  include("conex.inc");
  include("revisaSesion.php");
  $correo = $_SESSION['logear_usuario'];
  $sql = mysqli_query($link,"SELECT nombres FROM seven_usuario WHERE correo = '$correo'");
  $row = mysqli_fetch_array($sql);
  $nombre = $row[0];
  if($_SERVER["REQUEST_METHOD"] == "POST") {
     $sql1 = mysqli_query($link,"SELECT id_usuario FROM seven_usuario WHERE correo = '$correo'");
     $row = mysqli_fetch_array($sql1);
     $iduser = $row[0];
     $edit  = $_POST["cEdit"];
     $nombrec = $_POST["nombrec"];  //recibimos cada uno de los datos pasados por POST
     $profesor = $_POST["profc"];
     $sala = $_POST["salac"];       
     $dia = $_POST["dayc"];
     $hora = $_POST["hourc"];
     $consulta = mysqli_query($link, "UPDATE seven_cursos SET nombre_curso='$nombrec',profesor='$profesor',sala='$sala',dia='$dia',hora='$hora' WHERE id_usuario='$iduser' and 
                                      nombre_curso='$edit'"); //realizamos consulta 
                                               
    if(!$consulta) {      //si no se logra realizar la consulta, pedimos q ingrese datos validos
      echo "<script>alert('Porfavor ingresa datos validos')</script>";
        exit;
    }
    else{
      header("<script>alert('Curso añadido con exito'</script>"); //en otro caso el curso sera añadido con exito
    }
  }
?>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="icon" href="favicon.png">
    <link rel="stylesheet" type="text/css" href="style/estilos.css" >
    <title>SevenClip</title>
    <script src="js/scripts.js"></script>
    <script src="jquery-3.1.1.min.js"></script>
	<script> 
     if (window.XMLHttpRequest) objAjax = new XMLHttpRequest() //para Mozilla
      else if (window.ActiveXObject) objAjax = new ActiveXObject("Microsoft.XMLHTTP")
      function EditarDato(id){    
        objAjax.open("POST", "editar.php");
      	objAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      	objAjax.send("id="+id);
        objAjax.onreadystatechange = MostrarDatos;
      }
      function AgregarDato(id){    
        objAjax.open("POST", "agregarCurso.php"); //abrimos conexión a traves de POST
        objAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        objAjax.send("id="+id); //enviamos por post el usuario o primary key para realizaar la consulta
	objAjax.onreadystatechange = MostrarDatos;
 
      }
	
      function EliminarDato(id){    
        objAjax.open("POST", "eliminar.php"); //abrimos conexión a traves de POST con eliminar.php
        objAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        objAjax.send("id="+id); //enviamos por post el usuario o primary key para realizaar la consulta 
        location.reload();
      }
       function TraerDato(codigo){    //Traemos los datos pasando un CODIGO para validar la conexion con php
        objAjax.open("POST", "mostrar.php");
        objAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        objAjax.send("cod="+codigo);

        objAjax.onreadystatechange = MostrarDatos;
      }
      function MostrarDatos(){      //agregamos los datos al div 
        if(objAjax.readyState == 4){
          document.getElementById("editC").innerHTML = objAjax.responseText;
        }
      }
	</script>
  </head>
  <body>
   <header>
    <div id="headx">
      <a href="usuario.php"><img src="logox.png" alt="logo" /></a>
      <div id="config" onmouseover="Color(this,cnf)" onmouseout="deColor(this,cnf)" onclick="opciones()" ><a id="cnf" href="#"><img src="sets.png" id="fotoconf" alt="config" /></a></div>
      <a href="#"><div id="perfil" class="divPos" onmouseover="Color(this,pS)" onmouseout="deColor(this,pS)"><span id="pS" class="midOpc">MI PERFIL</span></div></a>
      <a href="calificaciones.php"><div id="nota" class="divPos" onmouseover="Color(this,nS)" onmouseout="deColor(this,nS)"><span id="nS" class="midOpc">CALIFICACIONES</span></div></a>
      <a href="cursos.php"><div id="curso" class="divPos" onmouseover="Color(this,cS)" onmouseout="deColor(this,cS)"><span id="cS" class="midOpc">CURSOS</span></div></a>
      <a href="calendario.html"><div id="calen" class="divPos" onmouseover="Color(this,clS)" onmouseout="deColor(this,clS)"><span id="clS" class="midOpc">CALENDARIO</span></div></a>
      <a href="horario.php"><div id="hora" class="divPos" onmouseover="Color(this,hS)" onmouseout="deColor(this,hS)"><span id="hS" class="midOpc">HORARIO</span></div></a>
    </div>
    <h1 id="h1">Revisa tu horario <?php echo $nombre;?>!</h1>
      <div id="opc" class="opt">
        <ul>
          <li><a href="#">Información</a></li>
          <li><a href="#">Configurar perfil</a></li>
          <li><a href="#">Ayuda</a></li>
          <li><a href="cerrarsesion.php">Cerrar sesión</a></li>
        </ul>
        <img src="subir.png" onclick="quitaropciones()" id="up"/>
      </div>
    </header>
    <br/>
    <br/>
    <div id="conHorario" style="height:auto;width:auto;position:relative;margin:auto"> 
      <table>           
        <tr><th>Lunes</th>  
            <th>Martes</th> 
            <th>Miercoles</th>
            <th>Jueves</th>
            <th>Viernes</th> 
            <th>Sabado</th>
            <th>Domingo</th>
        </tr>
        <tr>
          <td>
             <?php
              $sql1 = mysqli_query($link,"SELECT id_usuario FROM seven_usuario WHERE correo = '$correo'");
              $row = mysqli_fetch_array($sql1);
              $iduser = $row[0];
              $sql = "SELECT id_curso,nombre_curso,profesor,sala,hora FROM seven_cursos WHERE id_usuario='$iduser' AND dia='Lunes' ORDER BY hora ASC";
              $resultado = mysqli_query($link,$sql);
              if (mysqli_num_rows($resultado)>0) 
              { 
                echo "<ul style='list-style-type: none;'>";
                while($lista = mysqli_fetch_array($resultado)) 
                {
                  echo "<li id='id_curso".   $lista['id_curso']."'>";
                  echo "Hora: ".   $lista['hora'];
                  echo "<li>";echo "<li>";echo "Curso: ".  $lista['nombre_curso'];
                  echo "<li>";echo "Profe: ".  $lista['profesor'];
                  echo "<li>";echo "Sala: ". $lista['sala'];
                  echo "<br/>";
                  echo "</ul>";
                  echo "<ul style='list-style-type: none;'>";
           
            
                }
                echo "</ul>";
              }
              else
              {
                echo "No hay datos";
              }
            ?>
          </td>
          <td>
             <?php
              $sql1 = mysqli_query($link,"SELECT id_usuario FROM seven_usuario WHERE correo = '$correo'");
              $row = mysqli_fetch_array($sql1);
              $iduser = $row[0];
              $sql = "SELECT id_curso,nombre_curso,profesor,sala,hora FROM seven_cursos WHERE id_usuario='$iduser' AND dia='Martes' ORDER BY hora ASC";
              $resultado = mysqli_query($link,$sql);
              if (mysqli_num_rows($resultado)>0) 
              { 
                echo "<ul style='list-style-type: none;'>";
                while($lista = mysqli_fetch_array($resultado)) 
                {
                  echo "<li id='id_curso".   $lista['id_curso']."'>";
                  echo "Hora: ".   $lista['hora'];
                  echo "<li>";echo "Curso: ".  $lista['nombre_curso'];
                  echo "<li>";echo "Profe: ".  $lista['profesor'];
                  echo "<li>";echo "Sala: ". $lista['sala'];
                  echo "</ul>";
                  echo "<ul style='list-style-type: none;'>";
           
            
                }
                echo "</ul>";
              }
              else
              {
                echo "No hay datos";
              }
            ?>
          </td>
          <td>
             <?php
              $sql1 = mysqli_query($link,"SELECT id_usuario FROM seven_usuario WHERE correo = '$correo'");
              $row = mysqli_fetch_array($sql1);
              $iduser = $row[0];
              $sql = "SELECT id_curso,nombre_curso,profesor,sala,hora FROM seven_cursos WHERE id_usuario='$iduser' AND dia='Miercoles' ORDER BY hora ASC";
              $resultado = mysqli_query($link,$sql);
              if (mysqli_num_rows($resultado)>0) 
              { 
                echo "<ul style='list-style-type: none;'>";
                while($lista = mysqli_fetch_array($resultado)) 
                {
                  echo "<li id='id_curso".   $lista['id_curso']."'>";
                  echo "Hora: ".   $lista['hora'];
                  echo "<li>";echo "Curso: ".  $lista['nombre_curso'];
                  echo "<li>";echo "Profe: ".  $lista['profesor'];
                  echo "<li>";echo "Sala: ". $lista['sala'];
                  echo "</ul>";
                  echo "<ul style='list-style-type: none;'>";
           
            
                }
                echo "</ul>";
              }
              else
              {
                echo "No hay datos";
              }
            ?>
          </td>
          <td>
             <?php
              $sql1 = mysqli_query($link,"SELECT id_usuario FROM seven_usuario WHERE correo = '$correo'");
              $row = mysqli_fetch_array($sql1);
              $iduser = $row[0];
              $sql = "SELECT id_curso,nombre_curso,profesor,sala,hora FROM seven_cursos WHERE id_usuario='$iduser' AND dia='Jueves' ORDER BY hora ASC";
              $resultado = mysqli_query($link,$sql);
              if (mysqli_num_rows($resultado)>0) 
              { 
                echo "<ul style='list-style-type: none;'>";
                while($lista = mysqli_fetch_array($resultado)) 
                {
                  echo "<li id='id_curso".   $lista['id_curso']."'>";
                  echo "Hora: ".   $lista['hora'];
                  echo "<li>";echo "Curso: ".  $lista['nombre_curso'];
                  echo "<li>";echo "Profe: ".  $lista['profesor'];
                  echo "<li>";echo "Sala: ". $lista['sala'];
                  echo "</ul>";
                  echo "<ul style='list-style-type: none;'>";
           
            
                }
                echo "</ul>";
              }
              else
              {
                echo "No hay datos";
              }
            ?>
          </td>
          <td>
             <?php
              $sql1 = mysqli_query($link,"SELECT id_usuario FROM seven_usuario WHERE correo = '$correo'");
              $row = mysqli_fetch_array($sql1);
              $iduser = $row[0];
              $sql = "SELECT id_curso,nombre_curso,profesor,sala,hora FROM seven_cursos WHERE id_usuario='$iduser' AND dia='Viernes' ORDER BY hora ASC";
              $resultado = mysqli_query($link,$sql);
              if (mysqli_num_rows($resultado)>0) 
              { 
                echo "<ul style='list-style-type: none;'>";
                while($lista = mysqli_fetch_array($resultado)) 
                {
                  echo "<li id='id_curso".   $lista['id_curso']."'>";
                  echo "Hora: ".   $lista['hora'];
                  echo "<li>";echo "Curso: ".  $lista['nombre_curso'];
                  echo "<li>";echo "Profe: ".  $lista['profesor'];
                  echo "<li>";echo "Sala: ". $lista['sala'];
                  echo "</ul>";
                  echo "<ul style='list-style-type: none;'>";
           
            
                }
                echo "</ul>";
              }
              else
              {
                echo "No hay datos";
              }
            ?>
          </td>
          <td>
             <?php
              $sql1 = mysqli_query($link,"SELECT id_usuario FROM seven_usuario WHERE correo = '$correo'");
              $row = mysqli_fetch_array($sql1);
              $iduser = $row[0];
              $sql = "SELECT id_curso,nombre_curso,profesor,sala,hora FROM seven_cursos WHERE id_usuario='$iduser' AND dia='Sabado' ORDER BY hora ASC";
              $resultado = mysqli_query($link,$sql);
              if (mysqli_num_rows($resultado)>0) 
              { 
                echo "<ul style='list-style-type: none;'>";
                while($lista = mysqli_fetch_array($resultado)) 
                {
                  echo "<li id='id_curso".   $lista['id_curso']."'>";
                  echo "Hora: ".   $lista['hora'];
                  echo "<li>";echo "Curso: ".  $lista['nombre_curso'];
                  echo "<li>";echo "Profe: ".  $lista['profesor'];
                  echo "<li>";echo "Sala: ". $lista['sala'];
                  echo "</ul>";
                  echo "<ul style='list-style-type: none;'>";
           
            
                }
                echo "</ul>";
              }
              else
              {
                echo "No hay datos";
              }
            ?>
          </td>
          <td>
             <?php
              $sql1 = mysqli_query($link,"SELECT id_usuario FROM seven_usuario WHERE correo = '$correo'");
              $row = mysqli_fetch_array($sql1);
              $iduser = $row[0];
              $sql = "SELECT id_curso,nombre_curso,profesor,sala,hora FROM seven_cursos WHERE id_usuario='$iduser' AND dia='Domingo' ORDER BY hora ASC";
              $resultado = mysqli_query($link,$sql);
              if (mysqli_num_rows($resultado)>0) 
              { 
                echo "<ul style='list-style-type: none;'>";
                while($lista = mysqli_fetch_array($resultado)) 
                {
                  echo "<li id='id_curso".   $lista['id_curso']."'>";
                  echo "Hora: ".   $lista['hora'];
                  echo "<li>";echo "Curso: ".  $lista['nombre_curso'];
                  echo "<li>";echo "Profe: ".  $lista['profesor'];
                  echo "<li>";echo "Sala: ". $lista['sala'];
                  echo "</ul>";
                  echo "<ul style='list-style-type: none;'>";
           
            
                }
                echo "</ul>";
              }
              else
              {
                echo "No hay datos";
              }
            ?>
          </td>
      </table>
      <br/>
      <div id="showCursosHorario">
      </div>
      </div>
      <br/>
      <div id="sData"><button id="showData" onclick="AgregarDato('01')"  style="text-align:center" >Agregar Cursos</button></div>
      <br/>
      <div id="sData"><button id="showData" onclick="TraerDato('01')"  style="text-align:center" >Eliminar Cursos</button></div>
      <br/>
      <div id="sData"><button id="showData" onclick="EditarDato('01')"  style="text-align:center" >Editar Cursos</button></div>
      <br/>
      <div id="editC" style="height:auto;width:auto">
      </div>
      <br/>
      <br/>
  </body>
</html>