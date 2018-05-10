<?php
#this is Login form page , if user is already logged in then we will not allow user to access this page by executing isset($_SESSION["uid"])
#if below statment return true then we will send user to their profile.php page
if (isset($_SESSION["uid"])) {
	header("location:profile.php");
}
//in action.php page if user click on "ready to checkout" button that time we will pass data in a form from action.php page
if (isset($_POST["login_user_with_product"])) {
	//this is product list array
	$product_list = $_POST["product_id"];
	//here we are converting array into json format because array cannot be store in cookie
	$json_e = json_encode($product_list);
	//here we are creating cookie and name of cookie is product_list
	setcookie("product_list",$json_e,strtotime("+1 day"),"/","","",TRUE);

}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Yachay Market</title>
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
				<a href="#" class="navbar-brand">Yachay Market</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="index.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
				<li><a href="index.php"><span class="glyphicon glyphicon-modal-window"></span>Product</a></li>
			</ul>
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
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="panel panel-primary">
					<div class="panel-heading">Forma para añadir un nuevo producto</div>
					<div class="panel-body">
						<!--User Login Form-->
						<form onsubmit="return false" id="add_product">
							<label for="title">Nombre del Producto</label>
							<input type="title" class="form-control" name="title_prod" id="title_prod" required/>

							<label for="">Categoria</label>
							<select type="categoria" class="form-control" name="catego_prod" id="catego_prod" placeholder= "Seleccione una opción" required/>
									<option value="8"> Otros</option>
									<option value="1">Desayunos</option>
									<option value="2">Almuerzos</option>
									<option value="3">Meriendas</option>
									<option value="4">Postres</option>
									<option value="5">Bebidas</option>
									<option value="6">Entradas</option>
									<option value="7">Ensaladas</option>
							</select>

							<label for="description">Descripción</label>
              <input type="description" class="form-control" name="description_prod" id="description_prod" placeholder= "Máximo 255 carácteres" required/>

              <label for="keywords">Palabras Clave</label>
							<input type="keywords" class="form-control" name="keywords_prod" id="keywords_prod" required/>

              <label for="stock">Stock</label>
							<input type="stock" class="form-control" name="stock_prod" id="stock_prod" placeholder= "Items disponibles" required/>

              <label for="price">Precio</label>
							<input type="price" class="form-control" name="price_prod" id="price_prod" placeholder= "ej. 10.00"  required/>

              <label for="limitdate">Fecha límite de publicación</label>
							<input type="limitdate" class="form-control" name="limit_date_prod" id="limit_date_prod" placeholder= "año-mes-día" required/>

              <label for="imageprod">Image</label>
							<input type="imageprod" class="form-control" name="image_prod" id="image_prod" placeholder= "" required/>

							<form action="upload.php" method="post" enctype="multipart/form-data">
    							Select image to upload:
    							<input type="file" name="fileToUpload" id="fileToUpload">
    							<input type="submit" value="Upload Image" name="submit">
							</form>

              <p><br/></p>
              <a href="sellprofile.php" class="btn btn-success" style="float:left">Cancel</a><input type="submit" class="btn btn-success" style="float:right;" Value="Add">
						</form>
				</div>
				<div class="panel-footer"><div id="e_msg"></div></div>
			</div>
		</div>
		<div class="col-md-4"></div>
	</div>
</body>
</html>
