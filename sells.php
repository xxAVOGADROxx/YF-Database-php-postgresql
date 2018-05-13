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
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading"></div>
					<div class="panel-body">
						<h4>Mis ventas</h4>
						<hr/>
						<?php
							include_once("db.php");
							$user_id = $_SESSION["uid"];
							$orders_list = "SELECT o.order_id,o.user_id,o.product_id,o.qty,o.trx_id,o.p_status,o.order_date,p.product_title,p.product_price,p.product_image FROM orders o INNER JOIN products p ON p.user_id='$user_id' AND o.product_id=p.product_id";

							$query = pg_query($con,$orders_list);
							if (pg_num_rows($query) > 0) {
								while ($row=pg_fetch_array($query)) {
									?>
										<div class="row">
											<div class="col-md-6">
												<img style="float:right;" src="product_images/<?php echo $row['product_image']; ?>" class="img-responsive img-thumbnail" width="300" height="200"/>
											</div>
											<div class="col-md-6">
											<?php
											$nameus=$row["user_id"];
											$seller_q = "SELECT u.first_name||' '||u.last_name  as ncomp FROM user_info u INNER JOIN orders o ON u.user_id=$nameus";
											$query_u = pg_query($con,$seller_q);
											$comprador=pg_fetch_array($query_u) 
											?>
												<table>
													<tr><td>Nombre del Comprador: </td><td><b><?php echo $comprador["ncomp"]; ?></b> </td></tr>	
													<tr><td>Nombre del Producto: </td><td><b><?php echo $row["product_title"]; ?></b> </td></tr>
													<tr><td>Cantidad</td><td><b><?php echo $row["qty"]; ?></b></td></tr>
													<tr><td>ID de transacción:</td><td><b><?php echo $row["trx_id"]; ?></b></td></tr>
													<tr><td>Estado de orden: </td><td><b><?php echo $row["p_status"]; ?></b> </td></tr>	
													<tr><td>Fecha de orden:</td><td><b><?php echo $row["order_date"]; ?></b></td></tr>	
												</table>
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
</body>
</html>