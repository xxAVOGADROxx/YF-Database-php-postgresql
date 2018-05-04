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
		<title>Yachay Food</title>
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
				<a href="#" class="navbar-brand">Khan Store</a>
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
					<div class="panel-heading">Add Product Form</div>
					<div class="panel-body">
						<!--User Login Form-->
						<form onsubmit="return false" id="add_product">
							<label for="title">Title</label>
							<input type="title" class="form-control" name="title_prod" id="title_prod" required/>

							<label for="description">Description</label>
              <input type="description" class="form-control" name="description_prod" id="description_prod" required/>

              <label for="keywords">keywords</label>
							<input type="keywords" class="form-control" name="keywords_prod" id="keywords_prod" required/>

              <label for="stock">Stock</label>
							<input type="stock" class="form-control" name="stock_prod" id="stock_prod" required/>

              <label for="price">Price</label>
							<input type="price" class="form-control" name="price_prod" id="price_prod" required/>

              <label for="limitdate">Limit Date</label>
							<input type="limitdate" class="form-control" name="limit_date_prod" id="limit_date_prod" required/>

              <label for="imageprod">Image</label>
							<input type="imageprod" class="form-control" name="image_prod" id="image_prod" required/>

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
