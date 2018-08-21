<?php
	require 'incl/db.php';
	session_start();
	$correo = htmlentities($_POST['correo']); // trayendo los valores
  $contraseña = htmlentities($_POST['contraseña']); 

    if(isset($_POST['correo']))  
 {    $query = "SELECT * FROM persona WHERE CORREO = :correo and CONTRASENA = :contr";
      $resultado = oci_parse($conn, $query); 
      oci_bind_by_name($resultado, ':correo', $correo);  
      oci_bind_by_name($resultado, ':contr', $contraseña); 
      oci_execute($resultado);
      oci_fetch($resultado); 
      if(oci_num_rows($resultado) > 0)  
      {  
		   $_SESSION['correo'] = $_POST['correo'];  
           echo 'Si';
      }  
      else  
      {  
           echo 'No';  
      }  
 }
 else {
 	echo 'No se envio ningun campo';
 }    
?>