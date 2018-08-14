<?php
session_start();
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>REQUERIMIENTOS DGAC </title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<script src="js/jquery2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="main.js"></script>
		<style>
			@media screen and (max-width:480px){
				#search{width:80%;}
				#search_btn{width:30%;float:right;margin-top:-32px;margin-right:10px;}
			}

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
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
					<span class="sr-only"> navigation toggle</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
                      <a href="#" class="navbar-brand">Sistema de Requerimientos - Área Tecnológica</a>
			</div>
		<div class="collapse navbar-collapse" id="collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><?php echo " Cuenta actual: ".$_SESSION["name"]; ?></a>
					<ul class="dropdown-menu">
						<li><a href="sells.php" style="text-decoration:none; color:white;">Requerimientos Pendientes</a></li>
						<li class="divider"></li>
						<li><a href="logout.php" style="text-decoration:none; color:white;">Requerimientos Contestados</a></li>
                        <li class="divider"></li>
                        <li><a href="logout.php" style="text-decoration:none; color:white;">Cerrar Sesión</a></li>
                    </ul>
				</li>

			</ul>
		</div>
	</div>
	</div>
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
         <img src="images_web_page/logo_header.png" alt="DGAC_logo" style="width:300px;height:100px;" class="center">
	<div class="container-fluid">
     <h3 align="center" class="font-weight-bold">Bienvenido al Sistema de Registro de Requerimientos del Área Tecnológica</h3>
       <p><br/></p>
            <p align="center" style="color:white; font-size:18px"><strong>Si realizará varios requerimientos, asegurese de llenar un campo por cada requerimiento. Puede añadir más campos usando el botón "Añadir Requerimiento".  </p>
              <div class="row">
                        <div class="col-md-12 col-md-offset-5">
                            <label for="requerimiento">REQUERIMIENTOS:</label>
                        </div>
              </div>
            <p><br/></p>

	            <form onsubmit="return false" id="add_product" enctype="multipart/fom-data">
            		<label for="title_req1"> Escriba aquí su primer requerimiento </label>
								<input type="title_req1" class="form-control" name= "title_req1" id="title_req1" >

								<label for="title_req2"> Escriba aquí su segundo requerimiento </label>
								<input type="title_req2" class="form-control" name= "title_req2" id="title_req2" >

								<label for="title_req3"> Escriba aquí su tercer requerimiento </label>
								<input type="title_req3" class="form-control" name= "title_req3" id="title_req3" >

								<label for="title_req4"> Escriba aquí su cuarto requerimiento </label>
								<input type="title_req4" class="form-control" name= "title_req4" id="title_req4" >

								<label for="title_req5"> Escriba aquí su quinto requerimiento </label>
								<input type="title_req5" class="form-control" name= "title_req5" id="title_req5">

								<p><br/></p>
								<a href="profile.php" class="btn btn-success" style="float:left">Cancel</a>
								<input type="submit" class="btn btn-success"  name="add_product" style="float:right;" Value="Enviar">
            </form>
					</div>
		</div>
	</div>
</body>
</html>
