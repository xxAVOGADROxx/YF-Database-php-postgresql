<?php
if (isset($_GET["register"])) {

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
	</head>
<body>
<div class="wait overlay">
	<div class="loader"></div>
</div>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="#" class="navbar-brand">Sistema de Requerimientos - Área Tecnológica</a>
                <a href="index.php" style="text-decoration:none; color:white;" class="btn btn-sucess btn-lg" >Regresar</a>
			</div>
		</div>
	</div>
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8" id="signup_msg">
				<!--Alert from signup form-->
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-primary">
					<div class="panel-heading">Formato de Registro - Sistema de Requerimientos Tecnológicos</div>
					<div class="panel-body">

					<form id="signup_form_home" onsubmit="return false">
						<div class="row">
							<div class="col-md-3">
								<label for="f_name">Primer Nombre</label>
								<input type="text" id="f_name" name="f_name" class="form-control">
							</div>
							<div class="col-md-3">
								<label for="f_name">Primer Apellido</label>
								<input type="text" id="l_name1" name="l_name1"class="form-control">
							</div>
                            <div class="col-md-3">
                               <label for="f_name">Segundo Apellido</label>
                               <input type="text" id="l_name2" name="l_name2"class="form-control">
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-md-12">
                               <label for="dependence">Dependencia</label>
                               <input type="text" id="dependence" name="dependence" class="form-control">
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-md-12">
                                 <label for="email">Email Institucional (nombre.apellido@aviacioncivil.gob.ec)</label>
								<input type="text" id="email" name="email"class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="password">Contraseña</label>
								<input type="password" id="password" name="password"class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="repassword">Repita la Contraseña</label>
								<input type="password" id="repassword" name="repassword"class="form-control">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
                                <label for="mobile">Número telefónico de contacto</label>
								<input type="text" id="mobile" name="mobile"class="form-control">
							</div>
						</div>
						<p><br/></p>
						<div class="row">
							<div class="col-md-12">
								<input style="width:100%;" value="Registrar" type="submit" name="signup_button"class="btn btn-success btn-lg">
							</div>
						</div>

					</div>
					</form>
					<div class="panel-footer"></div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</body>
</html>
	<?php
}



?>
