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
		<title>Yachay Food</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<script src="js/jquery2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="main.js"></script>
		<style>
			table tr td {padding:10px;}
		</style>


		<script type="text/javascript">
		
		$(document).ready(function(){
			$('.button').click(function(){
				var clickBtnValue = $(this).val();
				var ajaxurl = 'del_product.php',
				data =  {'action': clickBtnValue};
				$.post(ajaxurl, data, function (response) {
					// Response div goes here.
					alert("Accion realizada correctamente");
					location.reload(true);
					
				});
			});

		});
				
		</script>

		

	
	</head>
<body>
	
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">	
			<div class="navbar-header">
				<a href="#" class="navbar-brand"> Yachay Market </a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Inicio </a></li>
				<li><a href="index.php"><span class="glyphicon glyphicon-modal-window"></span>Productos </a></li>
			</ul>
		</div>
	</div>
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">
	
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading"></div>
					<div class="panel-body">
						<h4>Elimine el producto que desee:    </h4>
						<hr/>
						<?php
							include_once("db.php");
							$user_id = $_SESSION["uid"];
							$orders_list = "SELECT p.product_id,p.product_title,p.product_price,p.product_image FROM products p WHERE p.user_id='$user_id'";
							$query = pg_query($con,$orders_list);
							if (pg_num_rows($query) > 0) {
								while ($row=pg_fetch_array($query)) {
									?>
										<div class="row">
											<div class="col-md-4">
												<img style="float:right;" src="product_images/<?php echo $row['product_image']; ?>" class="img-responsive img-thumbnail" width="300" height="200"/>
											</div>
											<div class="col-md-4">
												<table>
													<tr><td>ID: </td><td><b><?php echo $row["product_id"]; ?></b> </td></tr>
													<tr><td>Nombre: </td><td><b><?php echo $row["product_title"]; ?></b> </td></tr>
													<tr><td>Precio: </td><td><b><?php echo "$ ".$row["product_price"]; ?></b></td></tr>
													
												</table>
											</div>
											<div class="col-md-2">
											<!-- aqui escribir codigo para algo :v -->
												<input type="image" src="icons_and_more/deleteb.png" width=130px class="button" alt="submit" name="action" value=<?php echo $row["product_id"]; ?> />
											</div>
										</div>
										<hr>
									<?php
								}
							}
						?>
						
					</div>
					<div class="panel-footer"></div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>

   <!-- Aqui va el codigo para eliminar los productos -->
	<?php
		if (isset($_POST['action'])) {
			$id_prod = intval($_POST['action']);
			$sql = "DELETE FROM products WHERE product_id = $id_prod";
			pg_query($con,$sql);
			exit;
		}
	?>
</body>
</html>





