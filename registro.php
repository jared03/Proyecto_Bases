<?php
	//31928769
	error_reporting(E_ALL ^ E_NOTICE);
	require 'incl/db.php';
	session_start();
	if(isset($_POST['registrar'])){
    
    //traer los datos de la forma
    $vpnombre = htmlentities($_POST['pnombre']);
    $vsnombre = htmlentities($_POST['snombre']);
    $vpapellido = htmlentities($_POST['papellido']);
    $vsapellido = htmlentities($_POST['sapellido']);
    $vcorreo = htmlentities($_POST['correo']);
    $vcontraseña = htmlentities($_POST['contraseña']);
    $vdireccion = htmlentities($_POST['direccion']);
    $vciudad = htmlentities($_POST['ciudad']);
    $vdepartamento = htmlentities($_POST['departamento']);
    $vpais = htmlentities($_POST['pais']);
    $vtelefono = htmlentities($_POST['telefono']);

    if ( empty($vpnombre) ) {
    	echo '<script type="text/javascript">alert("Ingrese su primer nombre");</script>';
    } else {
			if (!preg_match("/^[a-zA-Z ]*$/",$vpnombre)) {
				echo '<script type="text/javascript">alert("Solo letras son permitidas en el primer nombre");</script>';
			}
		}
    if (empty($vsnombre)) {
    	echo '<script type="text/javascript">alert("Ingrese su segundo nombre");</script>';
    }else {
			if (!preg_match("/^[a-zA-Z ]*$/",$vsnombre)) {
				echo '<script type="text/javascript">alert("Solo letras son permitidas en el segundo nombre");</script>';
			}
		}
    if (empty($vpapellido)) {
    	echo '<script type="text/javascript">alert("Ingrese su primer apellido");</script>';
    }else {
			if (!preg_match("/^[a-zA-Z ]*$/",$vpapellido)) {
				echo '<script type="text/javascript">alert("Solo letras son permitidas en el primer apellido");</script>';
			}
		}
    if (empty($vsapellido)) {
    	echo '<script type="text/javascript">alert("Ingrese su segundo apellido");</script>';
    }else {
			if (!preg_match("/^[a-zA-Z ]*$/",$vsapellido)) {
				echo '<script type="text/javascript">alert("Solo letras son permitidas en el segundo apellido");</script>';
			}
		}
    if (empty($vcorreo)) {
    	echo '<script type="text/javascript">alert("Ingrese su correo");</script>';
    }
    else{
    	if (!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/",$vcorreo)) {
			echo '<script type="text/javascript">alert("Porfavor verifique su correo! Correo electronico invalido");</script>';
		}
    }
    if (empty($vcontraseña)) {
    	echo '<script type="text/javascript">alert("Ingrese su contraseña");</script>';
    }else {
			if (strlen($vcontraseña) < 6) {
				echo '<script type="text/javascript">alert("Contraseña debe contener minimo 6 caracteres");</script>';
			}
		}
    if (empty($vdireccion)) {
    	echo '<script type="text/javascript">alert("Ingrese su direccion");</script>';
    }
    if (empty($vciudad)) {
    	echo '<script type="text/javascript">alert("Ingrese su ciudad");</script>';
    }
    if (empty($vdepartamento)) {
    	echo '<script type="text/javascript">alert("Ingrese su departamento");</script>';
    }
    if (empty($vpais)) {
    	echo '<script type="text/javascript">alert("Ingrese su pais");</script>';
    }
    if (empty($vtelefono)) {
    	echo '<script type="text/javascript">alert("Ingrese su telefono");</script>';
    }else {
			if (!preg_match("/^[ 0-9 ]*$/",$vtelefono)) {
				echo '<script type="text/javascript">alert("Solo numeros son permitidos para el telefono");</script>';
			}
	}
    
    //$query = "SELECT * FROM persona WHERE CORREO = :correo";
    $resultado = oci_parse($conn, 'begin :valor := FN_USUARIO_EXISTE(:correo); end;');
    oci_bind_by_name($resultado, ':valor', $valor, 40);
    oci_bind_by_name($resultado, ':correo', $vcorreo);
    oci_execute($resultado);
    
    if($valor > 0){
        echo '<script type="text/javascript">alert("Correo electronico ya en uso, porfavor ingresa otro");</script>';
        die();
    }
		
    
    
    
   
    
}
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
	<div class="span6">  
    </div>
	<div class="span6">
	<div class="pull-right">
		<a href="#"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> [ 0 ] Carrito de Compras </span> </a> 
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
		 <li class=""><a href="#">Mi Cuenta</a></li>
		 <li class=""><a href="#">Mis Ordenes</a></li>
		 <li class=""><a href="contacto.php">Contactanos</a></li>
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
					<label class="checkbox">
					<input type="checkbox"> Recordarme
					</label>
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

<!-- Header End====================================================================== -->

	  </div> 
</div>
<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
<div id="sidebar" class="span3">
	<ul id="sideManu" class="nav nav-tabs nav-stacked">
		<?php
			$resultado3 = oci_parse($conn, "SELECT c.descripcion from categoria c");
      		oci_execute($resultado3);
 		while (($fila = oci_fetch_array($resultado3,OCI_BOTH)) != false) { ?>
		<li class="subMenu open"><a> <?php echo $fila['DESCRIPCION'];?> </a>
			<ul style="display:none">
			<li><a class="active" href="products.html"><i class="icon-chevron-right"></i>Cameras  </a></li>
			<li><a href="products.html"><i class="icon-chevron-right"></i>Computadoras,Tablets</a></li>
			<li><a href="products.html"><i class="icon-chevron-right"></i>Telefonos</a></li>
			<li><a href="products.html"><i class="icon-chevron-right"></i>Televisores</a></li>
			</ul>
		</li><?php }?>
	</ul>
	<br/>
		  <div class="thumbnail">
			<img src="themes/images/products/panasonic.jpg" alt="Bootshop panasonoc New camera"/>
			<div class="caption">
			  <h5>Panasonic</h5>
				<h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Añadir <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">L 3000.00</a></h4>
			</div>
		  </div><br/>
			<div class="thumbnail">
				<img src="themes/images/products/kindle.png" title="Bootshop New Kindel" alt="Bootshop Kindel">
				<div class="caption">
				  <h5>Kindle</h5>
				    <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Añadir <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">L 3000.00</a></h4>
				</div>
			  </div><br/>
			<div class="thumbnail">
				<img src="themes/images/payment_methods.png" title="Bootshop Payment Methods" alt="Payments Methods">
				<div class="caption">
				  <h5>Formas de pago</h5>
				</div>
			  </div>
	</div>
<!-- Sidebar end=============================================== -->
	<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.php">Inicio</a> <span class="divider">/</span></li>
		<li class="active">Registrarse</li>
    </ul>
	<h3> Registrarse</h3>	
	<div class="well">
	<form action="registro.php" method="post" class="form-horizontal" name="registro" id="registro">
		<h4>Informacion personal</h4>
		<div class="control-group">
		</div>
		<div class="control-group">
			<label class="control-label" for="pnombre">Primer nombre: <sup>*</sup></label>
			<div class="controls">
			  <input type="text" id="pnombre" name="pnombre" placeholder="Primer nombre">
			</div>
		 </div>
		 <div class="control-group">
			<label class="control-label" for="snombre">Segundo nombre: <sup>*</sup></label>
			<div class="controls">
			  <input type="text" id="snombre" name="snombre" placeholder="Segundo nombre">
			</div>
		 </div>
		 <div class="control-group">
			<label class="control-label" for="papellido">Primer apellido: <sup>*</sup></label>
			<div class="controls">
			  <input type="text" id="papellido" name="papellido" placeholder="Primer apellido">
			</div>
		 </div>
		 <div class="control-group">
			<label class="control-label" for="sapellido">Segundo apellido: <sup>*</sup></label>
			<div class="controls">
			  <input type="text" id="sapellido" name="sapellido" placeholder="Segundo apellido">
			</div>
		 </div>
		<div class="control-group">
		<label class="control-label" for="correo">Correo: <sup>*</sup></label>
		<div class="controls">
		  <input type="text" id="correo" name="correo" placeholder="Correo">
		</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="contraseña">Contraseña: <sup>*</sup></label>
			<div class="controls">
				<input type="password" id="contraseña" name="contraseña" placeholder="Ingrese su contraseña minimo 6 caracteres">
			</div>
			</div>		  	
		<h4>Direccion	</h4>
		
		<div class="control-group">
			<label class="control-label" for="address">Direccion:<sup>*</sup></label>
			<div class="controls">
			  <input type="text" name="direccion" id="direccion" placeholder="Direccion"/>
			</div>
		</div>
		
	
		<div class="control-group">
			<label class="control-label" for="ciudad">Ciudad:<sup>*</sup></label>
			<div class="controls">
			  <input type="text" id="ciudad" name="ciudad" placeholder="Ciudad"/> 
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="state">Departamento:<sup>*</sup></label>
			<div class="controls">
			  <select id="departamento" name="departamento">
				<option value="">-</option>
				<option value="1">Atlántida</option><option value="2">Colón</option><option value="3">Comayagua</option><option value="4">Copán</option><option value="5">Cortés</option><option value="6">Choluteca</option><option value="7">El Paraíso</option><option value="8">Francisco Morazán</option><option value="53">Gracias a Dios</option><option value="9">Intibucá</option><option value="10">Islas de la Bahía</option><option value="11">La Paz</option><option value="12">Lempira</option><option value="13">Ocotepeque</option><option value="14">Olancho</option><option value="15">Santa Bárbara</option><option value="16">Valle</option><option value="17">Yoro</option></select>
			</div>
		</div>		

		
		<div class="control-group">
			<label class="control-label" for="pais">Pais:<sup>*</sup></label>
			<div class="controls">
			<select id="pais" name="pais" >
				<option value="">-</option>
				<option value="1">Honduras</option>
			</select>
			</div>
		</div>	
	
		<div class="control-group">
			<label class="control-label" for="telefono">Telefono: <sup>*</sup></label>
			<div class="controls">
			  <input type="text"  name="telefono" id="telefono" placeholder="Numero telefonico"/> 
			</div>
		</div>
		
		
	<p><sup>*</sup>Campos requeridos	</p>
	
	<div class="control-group">
			<div class="controls">
				<input name="registrar" id="registrar" class="btn btn-large btn-success" type="submit" value="Registrarse" />
			</div>
		</div>		
	</form>
</div>

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
