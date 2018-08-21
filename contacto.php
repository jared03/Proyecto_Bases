<?php
	require 'incl/db.php';
	session_start();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Mero's Store HN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">	
<!-- Bootstrap style --> 
    <link id="callCss" rel="stylesheet" href="themes/bootshop/bootstrap.min.css" media="screen"/>
    <link href="themes/css/base.css" rel="stylesheet" media="screen"/>
<!-- Bootstrap style responsive -->	
	<link href="themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>
	<link href="themes/css/font-awesome.css" rel="stylesheet" type="text/css">
<!-- Google-code-prettify -->	
	<link href="themes/js/google-code-prettify/prettify.css" rel="stylesheet"/>
<!-- fav and touch icons -->
    <link rel="shortcut icon" href="themes/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="themes/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="themes/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="themes/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="themes/images/ico/apple-touch-icon-57-precomposed.png">
	<style type="text/css" id="enject"></style>
  </head>
<body>
<div id="header">
<div class="container">
<div id="welcomeLine" class="row">
		<?php  
                if(isset($_SESSION['correo']))  
                {  
                ?>  
                <div class="span6">  
                     <strong>Bienvenido! - <?php echo $_SESSION['correo']; ?></strong>
                     <a href="logout.php" name="logout" id="logout">Cerrar Sesion</a>  
                </div>  
                <?php  
                }  
                else  
                {  
                ?>  
                <div class="span6">  
                     <a href="#loginmodal" id="login" role="button" data-toggle="modal" style="padding-right:0"><span class="btn btn-success">Iniciar Sesion</span></a> 
                     <a href="registro.php" id="registrar" role="button" style="padding-right:0"><span class="btn btn-primary">Registrarse</span></a>
                </div> 
                <?php  
                }  
                ?> 
	<div class="span6">
	<div class="pull-right">
		<?php if(isset($_SESSION['correo'])){ ?>
		<a href="carrito.php"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i>
			<?php 
			$shcorreo = $_SESSION['correo'];
			$query = "SELECT * FROM carrito_producto cp 
      				  INNER JOIN carrito c ON cp.carrito_idcarrito = c.idcarrito  
      				  INNER JOIN cliente cl ON c.idcarrito = cl.idcliente
      				  INNER JOIN persona p on cl.idcliente = p.idpersona
      				  WHERE p.correo = :correo";

      		$resultado = oci_parse($conn, $query);
      		oci_bind_by_name($resultado, ':correo', $shcorreo);
      		oci_execute($resultado);
      		$filas =0;
      		while (($row = oci_fetch_array($resultado, OCI_BOTH)) != false) {
              $filas++;
          	}
          	$query2 ="SELECT * FROM producto pro
          	INNER JOIN impuestos i ON pro.impuestos_idimpuesto = i.idimpuesto 
			INNER JOIN carrito_producto c ON pro.idproducto = c.producto_idproducto
			INNER JOIN cliente cl ON c.carrito_idcarrito = cl.idcliente
			INNER JOIN persona p on cl.idcliente = p.idpersona
			WHERE p.correo = :correo";
			$resultado2 = oci_parse($conn, $query2);
			oci_bind_by_name($resultado2, ':correo', $shcorreo);
			oci_execute($resultado2);
		?> [ <?php echo $filas ?> ] Carrito de Compras </span> </a> 
	  <?php }else{?>
	  	<a href="#loginmodal"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> [ 0 ] Carrito de Compras </span> </a> 
	  <?php }?>
	</div>
	</div>  
</div>
<!-- Navbar ================================================== -->
<div id="logoArea" class="navbar">
	<a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</a>
		<div class="navbar-inner">
			<a class="brand" href="index.php"><img src="themes/images/mero.png" alt="Bootsshop"/></a>
			<form class="form-inline navbar-search" method="post" action="products.html" >
		 		<input id="srchFld" class="srchTxt" type="text" />
		  		<!--<select class="srchTxt">
					<option>Todas las Categorias</option>
					<option>Mujeres </option>
					<option>Hombres</option>
					<option>Niños</option>
					<option>Electronicos </option>
					<option>Zapatos </option>
				</select> -->
		 		 <button type="submit" id="submitButton" class="btn btn-primary">Buscar</button>
    		</form>
			<ul id="topMenu" class="nav pull-right">
<!-- Botones		 -->
		 <li class=""><a href="registro.php">Mi Cuenta</a></li>
		 <li class=""><a href="registro.php">Mis Ordenes</a></li>
		 <li class=""><a href="contacto.html">Contactanos</a></li>
		 <li class="">
		 <!--<a href="#loginmodal" role="button" data-toggle="modal" style="padding-right:0"><span class="btn btn-large btn-success">Iniciar Sesion</span></a>-->
		<div id="loginmodal" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3>Iniciar Sesion</h3>
				</div>
				<div class="modal-body">
					<div class="control-group">								
					<input type="text" name="correo" id="correo" placeholder="Correo">
					</div>
					<div class="control-group">
					<input type="password" name="contraseña" id="contraseña" placeholder="Contraseña">
					</div>
					<div class="control-group">
					<div class="controls">
					  <a href="#" style="text-decoration:underline">Olvidaste la contraseña ?</a>
					</div>
				</div>	
				<button type="submit" name="iniciosesion" class="btn btn-success" id="iniciosesion">Iniciar Sesion</button>
				<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
				</div>
		</div>
		</li>
			</ul>
	</div>
</div>
	</div>
</div>

<!-- Final Header====================================================================== -->
<div id="mainBody">
<div class="container">
	<hr class="soften">
	<h1>Mero's Store</h1>
	<hr class="soften"/>	
	<div class="row">
		<div class="span4">
		<h4>Detalles de contacto</h4>
		<p>	<br/> 
			<br/><br/>
			support@merostore.com<br/>
			﻿Tel 9999-9999<br/>
			<br/>
			www.merostore.com
		</p>		
		</div>
			
		<div class="span4">
<<!--		<h4>Opening Hours</h4>
			<h5> Monday - Friday</h5>
			<p>09:00am - 09:00pm<br/><br/></p>
			<h5>Saturday</h5>
			<p>09:00am - 07:00pm<br/><br/></p>
			<h5>Sunday</h5>
			<p>12:30pm - 06:00pm<br/><br/></p>-->
		</div>
		<div class="span4">
		<h4>Contactanos</h4>
		<form class="form-horizontal">
        <fieldset>
          <div class="control-group">
           
              <input type="text" placeholder="Nombre" class="input-xlarge"/>
           
          </div>
		   <div class="control-group">
           
              <input type="text" placeholder="Correo" class="input-xlarge"/>
           
          </div>
		   <div class="control-group">
           
              <input type="text" placeholder="Detalles" class="input-xlarge"/>
          
          </div>
          <div class="control-group">
              <textarea rows="3" id="textarea" class="input-xlarge"></textarea>
           
          </div>

            <button class="btn btn-large" type="submit">Enviar mensaje</button>

        </fieldset>
      </form>
		</div>
	</div>
	<div class="row">
	<div class="span12">
	<iframe style="width:100%; height:300; border: 0px" scrolling="no" src="https://maps.google.co.uk/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=18+California,+Fresno,+CA,+United+States&amp;aq=0&amp;oq=18+California+united+state&amp;sll=39.9589,-120.955336&amp;sspn=0.007114,0.016512&amp;ie=UTF8&amp;hq=&amp;hnear=18,+Fresno,+California+93727,+United+States&amp;t=m&amp;ll=36.732762,-119.695787&amp;spn=0.017197,0.100336&amp;z=14&amp;output=embed"></iframe><br />
	<small><a href="https://maps.google.co.uk/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=18+California,+Fresno,+CA,+United+States&amp;aq=0&amp;oq=18+California+united+state&amp;sll=39.9589,-120.955336&amp;sspn=0.007114,0.016512&amp;ie=UTF8&amp;hq=&amp;hnear=18,+Fresno,+California+93727,+United+States&amp;t=m&amp;ll=36.732762,-119.695787&amp;spn=0.017197,0.100336&amp;z=14" style="color:#0000FF;text-align:left">View Larger Map</a></small>
	</div>
	</div>
</div>
</div>
<!-- MainBody End ============================= -->
<!-- Pie de pagina ================================================================== -->
	<div  id="footerSection">
	<div class="container">
		<div class="row">
			<div class="span3">
				<h5>Cuenta y Configuracion</h5>
				<a href="#">Mi Cuenta</a>
		<!--		<a href="login.html">PERSONAL INFORMATION</a> 
				<a href="login.html">ADDRESSES</a> 
				<a href="login.html">DISCOUNT</a>-->  
				<a href="#">Mis Ordenes</a>
			 </div>
			<div class="span3">
			    <h5>Informacion</h5>
				<a href="contacto.html">Contactanos</a>  
				<a href="registro.php">Registro</a>   
				<a href="tac.html">Condiciones y Terminos</a> 
				<a href="faq.html">Preguntas Frequentes</a>
			 </div>
			<div class="span3">
			 </div>
			<div id="socialMedia" class="span3 pull-right">
				<h5>Redes Sociales </h5>
				<a href="https://www.facebook.com/merostore94/"><img width="60" height="60" src="themes/images/facebook.png" title="facebook" alt="facebook"/></a>
				<a href="https://www.twitter.com/merostorehn/"><img width="60" height="60" src="themes/images/twitter.png" title="twitter" alt="instagram"/></a>
			
			 </div> 
		 </div>
		<p class="pull-right">&copy; Mero Store HN</p>
	</div><!-- Container Final -->
	</div>
<!-- Cargado de Scripts ============================================= -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!--<script src="themes/js/jquery.js" type="text/javascript"></script>-->
	<script src="themes/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="themes/js/google-code-prettify/prettify.js"></script>
<!--<script src="themes/js/validacion_login.js"></script>-->
	<script src="themes/js/bootshop.js"></script>
    <script src="themes/js/jquery.lightbox-0.5.js"></script>
<!--<script>  
 $(document).ready(function(){  
      $('#iniciosesion').click(function(){  
           var vcorreo = $('#correo').val();  
           var vcontraseña = $('#contraseña').val();  
           if(vcorreo != '' && vcontraseña != '')  
           {  
                $.ajax({  
                     url:"login.php",  
                     method:"POST",  
                     data: {correo:vcorreo, contraseña:vcontraseña},  
                     success:function(data)  
                     {  
                          //alert(data);  
                          if(data == 'No')  
                          {  
                               alert("Informacion Incorrecta");  
                          }  
                          else if (data == 'Si') 
                          {  
                               $('#loginmodal').hide();  
                               location.reload();  
                          }  
                     }  
                });  
           }  
           else if(vcorreo=='' && vcontraseña!=='')
           	{
           		alert('Correo es necesario');
           	}
           	else if(vcontraseña=='' && vcorreo!==''){
           		alert('Contraseña requerida');
           	}
           	else  
           {  
                alert("Ambos campos requeridos");  
           } 
   
             
      });  
      $('#logout').click(function(){ 
           var accion = "logout";  
           $.ajax({  
                url:"login.php",  
                method:"POST",  
                data:{accion:accion},  
                success:function()  
                {  
                     location.reload();  
                }  
           });  
      });  
 });  
 </script>-->
 <script>
$(document).ready(function(){
	$("#iniciosesion").click(function(){
		var vcorreo = $("#correo").val();
		var vcontraseña = $("#contraseña").val();
		if(vcorreo=='' && vcontraseña=='')
		{
			alert("Correo y Contraseña requeridos");
		}
		else if(vcorreo=='' && vcontraseña!==''){alert('Correo es necesario')}
		else if(vcontraseña=='' && vcorreo!==''){alert('Contraseña es necesaria')}
		else{
			$.post("login.php", //pagina de acciones
			{ 
				correo:vcorreo,
				contraseña:vcontraseña
			},
			function(response){ // Funcion que trae la respuesta de login.php
         		if(response == 'No')  
        		{  
           			alert("Correo o Contraseña incorrectos");  
        		}  
        		else if (response == 'Si') 
        		{  
           			$('#loginmodal').hide();  
           			location.reload();  
        		}
			});
			}
	});
});
</script>
<span id="themesBtn"></span>
</body>
</html>
