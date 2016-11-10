<?php

 $nombre = $_POST["nombrecurso"];  //recibimos cada uno de los datos pasados por POST
 $profesor = $_POST["profesor"];
 $sala = $_POST["salacurso"];
 $dia = $_POST["diacurso"];
 $hora = $_POST["hora"];

 $pass = md5($pass);  //encriptamos la clave 
  
 include("conex.inc");

 $query = mysqli_query($link, "INSERT INTO usuarios(usuario,nombre,clave,email) VALUES ('$usuario', '$name', '$pass','$correo')"); //realizamos consulta 
                                               //insertamos datos
 if(!$query) {
    echo "Error: ".mysqli_error($link); 
    echo "<script>alert('Ya existe una cuenta con estos datos')</script>";
    header("Refresh: 1;url= reg.html");
        exit;
    }
    else{
      echo "<h2 style='text-align:center'>¡Datos enviados!</h2>";
    }
?>
