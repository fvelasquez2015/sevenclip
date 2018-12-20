<?php
  include("conex.inc");  
  include("revisaSesion.php");
  $correo = $_SESSION['logear_usuario'];
  $sql = mysqli_query($link,"SELECT * FROM seven_usuario WHERE correo = '$correo'");
  $row = mysqli_fetch_array($sql);
  $id = $row[0];
  $nombre = $row[2];
?>

<html>
<div id="addCurso">
      <form action="" method="POST">
        <span>Nombre Curso</span><input class="iN" type="text" name="nombrec" id="nombrec" />
        <br/>
        <span>Profesor </span><input class="iN" type="text" name="profc" id="profc" />
        <br/>
        <span>Sala </span><input class="iN"  required="required" type="text" name="salac" id="salac" />
        <br/>
	<span>Día</span><select name='dayc' class="iN"><option value='Lunes'>Lunes</option>  <option value='Martes'>Martes</option>  <option value='Miercoles'>Miercoles</option> 
        <option value='Jueves'>Jueves</option><option value='Viernes'>Viernes</option><option value='Sabado'>Sabado</option><option value='Domingo'>Domingo</option><select />        
        <br/>
        <span>Hora</span> <input class="iN" required="required" type="text" name="hourc" id="hourc" />
        <br/>
        <input type="submit" onclick="reload()" value="Añadir curso" id="botCurso" />
      </form>
    </div>
</html>
