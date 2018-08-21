<?php
    require 'incl/db.php';
    //session_start();
   

     // $query = '  
      //SELECT * FROM Persona';
      //oci_bind_by_name($query, ':correo', $correo);  
      //oci_bind_by_name($query, ':contraseña', $contraseña); 
     // $query = 'SELECT correo, contraseña FROM persona';
      //oci_bind_by_name($query, ':correo', $correo);  
      //oci_bind_by_name($query, ':contraseña', $contraseña); 
      /*$resultado = oci_parse($conn,'SELECT * FROM persona'); 
      oci_execute($resultado);
      oci_fetch($resultado);
      echo oci_num_rows($resultado);*/
      //$query = 'SELECT * FROM persona WHERE correo = :correo AND contraseña = $contraseña';
      //oci_bind_by_name($query, ':correo', $correo);  
      //oci_bind_by_name($query, ':contraseña', $contraseña); 
      /*$resultado = oci_parse($conn, 'SELECT * FROM persona'); 
      oci_bind_by_name($query, ':correo', $correo);  
      oci_bind_by_name($query, ':contraseña', $contraseña); 
      oci_execute($resultado);*/
      $correo = 'prueba@gmail.com'; // trayendo los valores
      /*$contraseña = "asdf"; 
      //$query = "SELECT CORREO, CONTRASEÑA FROM persona WHERE CORREO > :correo AND CONTRASEÑA > :contraseña;";
      $query = "SELECT * FROM persona WHERE CORREO = :user_bv and CONTRASENA=:pwd"; 
      //$resultado = oci_parse($conn, "SELECT * FROM persona WHERE CORREO = '".$correo."'"); 
      $resultado = oci_parse($conn, $query);
      oci_bind_by_name($resultado, ":user_bv", $correo);  
      oci_bind_by_name($resultado, ":pwd", $contraseña); 
      oci_execute($resultado);
      oci_fetch($resultado);
      if(oci_num_rows($resultado) > 0)  
      {  
           //$_SESSION['correo'] = $_POST['correo'];  
           echo 'Si';  
      }  
      else  
      {  
           echo 'No';  
      } */ 

      /*$query = "SELECT * FROM carrito_producto cp 
      INNER JOIN carrito c ON cp.carrito_idcarrito = c.idcarrito  
      INNER JOIN cliente cl ON c.idcarrito = cl.idcliente
      INNER JOIN persona p on cl.idcliente = p.idpersona
      WHERE p.correo = :correo";

      $resultado = oci_parse($conn, $query);
      oci_bind_by_name($resultado, ':correo', $correo);
      oci_execute($resultado);
      $filas =0;
      while (($row = oci_fetch_array($resultado, OCI_BOTH)) != false) {
              $filas++;
          }
      echo "shopping cart ";
      echo $filas;
      if($filas > 0){
        echo ' se ejecuto 3';
        die();
      }*/
$resultado = oci_parse($conn, 'begin :r := FN_USUARIO_EXISTE(:p); end;');
    oci_bind_by_name($resultado, ':r', $r, 40);
    oci_bind_by_name($resultado, ':p', $correo);
    oci_execute($resultado);
      echo $r;
      /*$resultado3 = oci_parse($conn, "SELECT c.descripcion from categoria c");
      oci_execute($resultado3);
      while (($fila = oci_fetch_array($resultado3,OCI_BOTH)) != false) {
        echo $fila['DESCRIPCION'];
      }*/
?>