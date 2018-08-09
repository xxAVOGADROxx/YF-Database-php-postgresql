<?php
session_start();
if(isset($_SESSION["uid"])){
	header("location:profile.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>REQUERIMIENTOS DGAC</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<script src="js/jquery2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="main.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css">
		<style>
			.btn1 {
				display: inline-block;
				margin-bottom: 0;
				font-weight: normal;
				text-align: center;
				vertical-align: middle;
				-ms-touch-action: manipulation;
				touch-action: manipulation;
				cursor: pointer;
				background-image: none;
				border: 1px solid transparent;
				white-space: nowrap;
				padding: 8px 12px;
				font-size: 14px;
				line-height: 1.42857143;
				border-radius: 4px;
				-webkit-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
			}

			.btn-xs1, .btn-group-xs1 > .btn1 {
				padding: 1px 5px;
				font-size: 12px;
				line-height: 1.5;
				border-radius: 3px;
			}

			.btn-danger1 {
				color: #ffffff;
				background-color: #C0392B;
				border-color: #FDFEFE;
			}
            .center {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 50%;
            }
		
		</style>
	</head>
<body>
<div class="wait overlay">
	<div class="loader"></div>
</div>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
					<span class="sr-only">navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="#" class="navbar-brand">Sistema de Requerimientos - Área de Tecnología</a>
			</div>
		<div class="collapse navbar-collapse" id="collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>  Entrar al Sistema </a>
					<ul class="dropdown-menu">
						<div style="width:350px;">
							<div class="panel panel-primary">
								<div class="panel-heading">Ingrese sus datos:</div>
								<div class="panel-heading">
									<form onsubmit="return false" id="login">
										<label for="email">Correo</label>
										<input type="email" class="form-control" name="email" id="email" required/>
										<label for="email">Contraseña</label>
										<input type="password" class="form-control" name="password" id="password" required/>
										<p><br/></p>
										<a href="customer_registration_home.php?register=1" style="color:white; list-style:none;">Crear cuenta</a>
										<input type="submit" class="btn btn-success" style="float:right;">
									</form>
								</div>
								<!-- <div class="panel-footer" id="e_msg"></div> -->
							</div>
						</div>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
         <img src="images_web_page/logo_header.png" alt="Girl in a jacket" style="width:300px;height:100px;" class="center"> 
	<div class="container-fluid">
       <h3 align="center" class="font-weight-bold">Bienvenido al Sistema de Registro de Requerimientos del Área Tecnológica</h3>
       <p><br/></p>
            <p align="center" style="color:white; font-size:18px"><strong>Sistema de ayuda soporte al usuario en Tecnología DGAC, este sistema sirve para que usted reporte cualquier necesidad tecnológica, hardware o software. <br>Este sistema no se encuentra asociado a ninguna cuenta de la institución. Por lo cual si es la primera vez que ingresa a esta página debe registrarse.</p>  
       <ul>
            <li style="font-size:30px">Para ingresar al sistema debe crear una cuenta de usuario en el botón "Entrar al Sistema" en la parte superior derecha de la página web y seleccionar "Crear Cuenta". Debe registrarse con su correo institucional (e.j. nombre.apellido@aviacioncivil.gov.ec).</li>
            <li  style="font-size:30px">Si usted ha registrado una cuenta previamente debe ingresar con sus credenciales: correo electrónico y contraseña registradas. Para ingresar sus ceredenciales debe ingresar en el botón de la parte superior de la página web "Entrar al Sistema". </li>
       </ul> 
	</div>
</body>
</html>
