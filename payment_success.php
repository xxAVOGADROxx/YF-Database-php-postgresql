<?php

session_start();
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}else{
	if (isset($_SESSION["uid"])) {
		include_once("db.php");
		$user_id = $_SESSION["uid"];
		$trx_id = 'Yachafood'.$user_id.'_'.rand(1,999);
		$order_date = date("Y-m-d");
		$sql = "SELECT p_id,qty FROM cart WHERE user_id = $user_id";
		$query = pg_query($con,$sql);
		if (pg_num_rows($query) > 0) {
			# code...
			while ($row=pg_fetch_array($query)) {
			$product_id[] = $row["p_id"];
			$qty[] = $row["qty"];
			$p_st = 'Completed';
			}
			
			for ($i=0; $i < count($product_id); $i++) { 
				$sql = "INSERT INTO orders (user_id,product_id,qty,trx_id,p_status,order_date) VALUES ('$user_id','".$product_id[$i]."','".$qty[$i]."','$trx_id','$p_st','$order_date')";
				pg_query($con,$sql);
			}

			$sql = "DELETE FROM cart WHERE user_id = '$user_id'";
			if (pg_query($con,$sql)) {
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
									<a href="#" class="navbar-brand"Yachay Food</a>
								</div>
								<ul class="nav navbar-nav">
									<li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
									<li><a href="profile.php"><span class="glyphicon glyphicon-modal-window"></span> Productos</a></li>
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
											<h3>Gracias por tu compra!</h3>
											<hr/>
											<p>Hola <?php echo "<b>".$_SESSION["name"]."</b>"; ?>, tu compra ha
											sido registrada en el sistema 
											exitosamente. El ID de tu transacción es: <b><?php echo $trx_id; ?></b>   <br/>
											¿Seguir comprando?<br/></p>
											<a href="index.php" class="btn btn-success btn-lg">Ir a productos</a>
										</div>
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
		}else{
			header("location:index.php");
		}
		
	}
}



?>

