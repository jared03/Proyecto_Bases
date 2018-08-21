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
			<form class="form-inline navbar-search" method="post" action="productos.php" >
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
					<div class="controls">
					  <a href="reset.php" style="text-decoration:underline">Olvidaste la contraseña ?</a>
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
<div id="carouselBlk">
	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner">
		  <div class="item active">
		  <div class="container">
			<a href="registro.php"><img style="width:100%" src="themes/images/carousel/1.png" alt="special offers"/></a>
			<div class="carousel-caption">
				</div>
		  </div>
		  </div>
		  <div class="item">
		  <div class="container">
			<a href="registro.php"><img style="width:100%" src="themes/images/carousel/2.png" alt=""/></a>
				<div class="carousel-caption">
				</div>
		  </div>
		  </div>
		  <div class="item">
		  <div class="container">
			<a href="registro.php"><img src="themes/images/carousel/3.png" alt=""/></a>
			<div class="carousel-caption">
				</div>
			
		  </div>
		  </div>
		   <div class="item">
		   <div class="container">
			<a href="registro.php"><img src="themes/images/carousel/4.png" alt=""/></a>
			<div class="carousel-caption">
				</div>
		   
		  </div>
		  </div>
		   <div class="item">
		   <div class="container">
			<a href="registro.php"><img src="themes/images/carousel/5.png" alt=""/></a>
			<div class="carousel-caption">
			</div>
		  </div>
		  </div>
		   <div class="item">
		   <div class="container">
			<a href="registro.php"><img src="themes/images/carousel/6.png" alt=""/></a>
			<div class="carousel-caption">
				</div>
		  </div>
		  </div>
		</div>
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
	  </div> 
</div>
<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Barra Lateral ================================================== -->
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
<!-- Barra lateral Final=============================================== -->
		<div class="span9">		
			<div class="well well-small">
			<h4>Productos destacados <small class="pull-right">20+ Productos</small></h4>
			<div class="row-fluid">
			<div id="featured" class="carousel slide">
			<div class="carousel-inner">
			  <div class="item active">
			  <ul class="thumbnails">
				<li class="span3">
				  <div class="thumbnail">
				  <i class="tag"></i>
					<a href="product_details.html"><img src="themes/images/products/leon.jpg" alt=""></a>
					<div class="caption">
					  <h5>Pulsera Leon.</h5>
					  <h4><a class="btn" href="product_details.html">Añadir</a> <span class="pull-right">L 200.00</span></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
				  <i class="tag"></i>
					<a href="product_details.html"><img src="themes/images/products/gladeador.jpg" alt=""></a>
					<div class="caption">
					  <h5>Pulsera Gladiator</h5>
					  <h4><a class="btn" href="product_details.html">Añadir</a> <span class="pull-right">L 250.00</span></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
				  <i class="tag"></i>
					<a href="product_details.html"><img width="200" height="200" src="themes/images/products/king.jpg" alt=""></a>
					<div class="caption">
					  <h5>Pulsera king plata.</h5>
					   <h4><a class="btn" href="product_details.html">Añadir</a> <span class="pull-right">L 300.00</span></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
				  <i class="tag"></i>
					<a href="product_details.html"><img src="themes/images/products/king2.jpg" alt=""></a>
					<div class="caption">
					  <h5>Pulsera king oro</h5>
					   <h4><a class="btn" href="product_details.html">Añadir</a> <span class="pull-right">L 300.00</span></h4>
					</div>
				  </div>
				</li>
			  </ul>
			  </div>
			   <div class="item">
			  <ul class="thumbnails">
				<li class="span3">
				  <div class="thumbnail">
				  <i class="tag"></i>
					<a href="product_details.html"><img width="700" height="700" src="themes/images/products/DELL.jpeg" alt=""></a>
					<div class="caption">
					  <h5>Computadora DELL i7</h5>
					  <h4><a class="btn" href="product_details.html">Añadir</a> <span class="pull-right">L 12000.00</span></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
				  <i class="tag"></i>
					<a href="product_details.html"><img width="1000" height="1000" src="themes/images/products/hp.png" alt=""></a>
					<div class="caption">
					  <h5>Computadora HP</h5>
					  <h4><a class="btn" href="product_details.html">Añadir</a> <span class="pull-right">L 12000.00</span></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
					<a href="product_details.html"><img width="1000" height="1000" src="themes/images/products/s92.png" alt=""></a>
					<div class="caption">
					  <h5>Samsung S9</h5>
					   <h4><a class="btn" href="product_details.html">Añadir</a> <span class="pull-right">L 12000.00</span></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
						<a href="product_details.html"><img src="themes/images/products/gladeador.jpg" alt=""></a>
					<div class="caption">
					  <h5>Pulsera Gladiator</h5>
					   <h4><a class="btn" href="product_details.html">Añadir</a> <span class="pull-right">L 300.00</span></h4>
					</div>
				  </div>
				</li>
			  </ul>
			  </div>
			   <div class="item">
			  <ul class="thumbnails">
				<li class="span3">
				  <div class="thumbnail">
					<a href="product_details.html"><img src="themes/images/products/camisa.png" alt=""></a>
					<div class="caption">
					  <h5>Camisa Polo</h5>
					  <h4><a class="btn" href="product_details.html">Añadir</a> <span class="pull-right">L 700.00</span></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
					<a href="product_details.html"><img src="themes/images/products/niño.jpg" alt=""></a>
					<div class="caption">
					  <h5>Camisa niño</h5>
					  <h4><a class="btn" href="product_details.html">Añadir</a> <span class="pull-right">L 400.00</span></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
					<a href="product_details.html"><img src="themes/images/products/vestido.png" alt=""></a>
					<div class="caption">
					  <h5>Vestido de gala</h5>
					   <h4><a class="btn" href="product_details.html">Añadir</a> <span class="pull-right">L 600.00</span></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
					<a href="product_details.html"><img width="800" height="800" src="themes/images/products/adidas.jpg" alt=""></a>
					<div class="caption">
					  <h5>Tennis adidas</h5>
					   <h4><a class="btn" href="product_details.html">Añadir</a> <span class="pull-right">L 1000.00</span></h4>
					</div>
				  </div>
				</li>
			  </ul>
			  </div>
			   <div class="item">
			  <ul class="thumbnails">
				<li class="span3">
				  <div class="thumbnail">
					<a href="product_details.html"><img width="800" height="800" src="themes/images/products/Guess.jpg" alt=""></a>
					<div class="caption">
					  <h5>Lentes Guess.</h5>
					  <h4><a class="btn" href="product_details.html">Añadir</a> <span class="pull-right">L 2500.00</span></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
					<a href="product_details.html"><img src="themes/images/products/gucci.jpg" alt=""></a>
					<div class="caption">
					  <h5>Lentes Gucci.</h5>
					  <h4><a class="btn" href="product_details.html">Añadir</a> <span class="pull-right">L 2500.00</span></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
					<a href="product_details.html"><img width="500" height="500" src="themes/images/products/VOGUE2.jpg" alt=""></a>
					<div class="caption">
					  <h5>Lentes Vogue.</h5>
					   <h4><a class="btn" href="product_details.html">Añadir</a> <span class="pull-right">L 2600.00</span></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
					<a href="product_details.html"><img width="100" src="themes/images/products/rayban.png" alt=""></a>
					<div class="caption">
					  <h5>Lentes Ray-ban.</h5>
					   <h4><a class="btn" href="product_details.html">Añadir</a> <span class="pull-right">L 2900.00</span></h4>
					</div>
				  </div>
				</li>
			  </ul>
			  </div>
			  </div>
			  <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
			  <a class="right carousel-control" href="#featured" data-slide="next">›</a>
			  </div>
			  </div>
		</div>
		<h4>Ultimos productos </h4>
			  <ul class="thumbnails">
				<li class="span3">
				  <div class="thumbnail">
					<a  href="product_details.html"><img width="240" height="230" src="themes/images/products/televisor.png" alt=""/></a>
					<div class="caption">
					  <h5>LG</h5>
					  <p> 
						Televisor de 42 pulgadas. 
					  </p>
					 
					  <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Añadir <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">L 9000.00</a></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
					<a  href="product_details.html"><img width="150" height="170" src="themes/images/products/Pantalon.png" alt=""/></a>
					<div class="caption">
					  <h5>Pantalon slim</h5>
					  <p> 
						Pantalon talla 32.
					  </p>
					 <h4 style="text-align:center"><a class="btn" href="index.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Añadir <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">L 600.00</a></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
					<a  href="product_details.html"><img width="160" src="themes/images/products/nike.jpg" alt=""/></a>
					<div class="caption">
					  <h5>Nike</h5>
					  <p> 
						Tenis talla 10. 
					  </p>
					   <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Añadir <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">L 1000.00</a></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
					<a  href="product_details.html"><img  src="themes/images/products/Lacoste.jpg" alt=""/></a>
					<div class="caption">
					  <h5>Lacoste</h5>
					  <p> 
						Lentes unisex.
					  </p>
					  <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Añadir <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">L 2500.00</a></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
					<a  href="product_details.html"><img width="180" height="180" src="themes/images/products/hp.png" alt=""/></a>
					<div class="caption">
					  <h5>HP pavilion g6</h5>
					  <p> 
						Computadora portatil. 
					  </p>
					  <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Añadir <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">L12000.00</a></h4>
					</div>
				  </div>
				</li>
				<li class="span3">
				  <div class="thumbnail">
					<a  href="product_details.html"><img width="250" height="200" src="themes/images/products/Buho.jpg" alt=""/></a>
					<div class="caption">
					  <h5>Buho</h5>
					  <p> 
						Pulsera. 
					  </p>
					   <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Añadir<i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">L 2500.00</a></h4>
					</div>
				  </div>
				</li>
			  </ul>	

		</div>
		</div>
	</div>
</div>
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
