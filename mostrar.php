<?php
 include("conex.inc");  
 include("revisaSesion.php");
 $correo = $_SESSION['logear_usuario'];
 $sql = mysqli_query($link,"SELECT id_usuario FROM seven_usuario WHERE correo = '$correo'");
 $row = mysqli_fetch_array($sql);
 $iduser = $row[0];
 $cod = $_POST["cod"];  //recibimos el check para comenzar con la consulta
 if($cod=="01") {
  $query = "SELECT * FROM seven_cursos where id_usuario='$iduser' ";    //realizamos consulta para seleccionar todos los DATOS de la tabla
  $consulta = mysqli_query($link, $query);

  echo "<table>";             //creamos la tabla que se visualizara en el index gracias a ajax
  echo "<tr><th>Curso</th>  
        <th>Profesor</th> 
      <th>Sala</th>
      <th>Dia</th>
      <th>Hora</th> 
    <th></td></th>";
  while($fila = mysqli_fetch_row($consulta)){   //obtenemos los resultados de la fila y se guarda en el array FILA
  echo "<tr> 
    <td>$fila[2]</td> 
    <td>$fila[3]</td>
    <td>$fila[4]</td>
    <td>$fila[5]</td>
    <td>$fila[6]</td>
    <td><button id='$fila[0]' onclick='EliminarDato(id)' style='background-color:#e74c3c;color:white;border:1px solid black;border-radius
    :4px'>ELIMINAR</button></td> 
    </tr>";   //guardamos la id del boton como fila[0] ya que es la primary key asi podemos borrar el dato facilmente de la base de datos         
  }
  echo "</table>";
 }
                                               
?>