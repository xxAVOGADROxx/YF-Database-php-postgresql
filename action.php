<?php
session_start();

$ip_add = getenv("REMOTE_ADDR");
include "db.php";
if(isset($_POST["category"])){
	$category_query = "SELECT * FROM categories";
	$run_query = pg_query($con,$category_query) or die("Error de conexion.". pg_error());
	echo "
		<div class='nav nav-pills nav-stacked'>
			<li class='active'><a href='#'><h5>Categorias</h5></a></li>
	";
	if(pg_num_rows($run_query) > 0){
		while($row = pg_fetch_array($run_query)){
			$cid = $row["cat_id"];
			$cat_name = $row["cat_title"];
			echo "
					<li><a href='#' class='category' cid='$cid'>$cat_name</a></li>
			";
		}
		echo "</div>";
	}
}
if(isset($_POST["brand"])){
	$prov_query = "SELECT * FROM providers";
	$run_query = pg_query($con,$prov_query);
	echo "
		<div class='nav nav-pills nav-stacked'>
			<li class='active'><a href='#'><h5>Proveedores</h5></a></li>
	";
	if(pg_num_rows($run_query) > 0){
		while($row = pg_fetch_array($run_query)){
			$bid = $row["prov_id"];
			$brand_name = $row["prov_title"];
			echo "
					<li><a href='#' class='selectBrand' bid='$bid'>$brand_name</a></li>
			";
		}
		echo "</div>";
	}
}
if(isset($_POST["page"])){
	$sql = "SELECT * FROM products";
	$run_query = pg_query($con,$sql);
	$count = pg_num_rows($run_query);
	$pageno = ceil($count/9);
	for($i=1;$i<=$pageno;$i++){
		echo "
			<li><a href='#' page='$i' id='page'>$i</a></li>
		";
	}
}




if(isset($_POST["getProduct"])){
	$limit = 9;
	if(isset($_POST["setPage"])){
		$pageno = $_POST["pageNumber"];
		$start = ($pageno * $limit) - $limit;
	}else{
		$start = 0;
	}
	$product_query = "SELECT * FROM products LIMIT $limit OFFSET $start";
	$run_query = pg_query($con,$product_query);
	if(pg_num_rows($run_query) > 0){
		while($row = pg_fetch_array($run_query)){
				$pro_id    = $row['product_id'];
				$pro_cat   = $row['product_cat'];
				$pro_brand = $row['product_prov'];
				$pro_title = $row['product_title'];
				$pro_price = $row['product_price'];
				$pro_desc = $row['product_desc'];
				$pro_image = $row['product_image'];
				$pro_user_id = $row['user_id'];	
				$pro_stock = $row['stock'];	
				$user_query = "SELECT first_name ||' '|| last_name as full_name from user_info where $pro_user_id = user_id";	
				$run_user_query = pg_query($con,$user_query);	
				$result = pg_fetch_array($run_user_query );
				
				
				echo "
					<div class='col-md-4'>
								<div class='panel panel-info'>
									<div class='panel-heading'>$pro_title</div>
									<div class='panel-body'>
										<center>
										<img src='product_images/$pro_image' style='width:160px; height:160px;'/>
										</center>
									</div>
									<div class='panel-body'>
										<center>
										<button  style='float:none;' class='btn1 btn-danger1 btn-xs1'>$result[full_name]</button>
										<button  style='float:none;' class='btn1 btn-danger1 btn-xs1''>Stock: $pro_stock</button>
										</center>
										<hr />
										<p>$pro_desc</p>
									</div>
									<div class='panel-heading'>$  $pro_price
										<button pid='$pro_id' style='float:right;' id='product' class='btn btn-danger btn-xs'>Añadir</button>
									</div>
								</div>
							</div>
				";
			}

		}
	}

if(isset($_POST["get_seleted_Category"]) || isset($_POST["selectBrand"]) || isset($_POST["search"])){
	if(isset($_POST["get_seleted_Category"])){
		$id = $_POST["cat_id"];
		$sql = "SELECT * FROM products WHERE product_cat = '$id'";
	}else if(isset($_POST["selectBrand"])){
		$id = $_POST["brand_id"];
		$sql = "SELECT * FROM products WHERE product_prov = '$id'";
	}else {
		$keyword = $_POST["keyword"];
		$sql = "SELECT * FROM products WHERE product_keywords LIKE '%$keyword%'";
	}

	$run_query = pg_query($con,$sql);
	while($row=pg_fetch_array($run_query)){
			$pro_id    = $row['product_id'];
			$pro_cat   = $row['product_cat'];
			$pro_brand = $row['product_prov'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_desc = $row['product_desc'];
			$pro_image = $row['product_image'];
			$pro_user_id = $row['user_id'];	
			$pro_stock = $row['stock'];	
			$user_query = "SELECT first_name ||' '|| last_name as full_name from user_info where $pro_user_id = user_id";	
			$run_user_query = pg_query($con,$user_query);	

			$result = pg_fetch_array($run_user_query );
			echo "
				<div class='col-md-4'>
							<div class='panel panel-info'>
								<div class='panel-heading'>$pro_title</div>
								<div class='panel-body'>
									<center>
									<img src='product_images/$pro_image' style='width:160px; height:160px;'/>
									</center>
								</div>
								<div class='panel-body'>
									<center>
									<button  style='float:none;' class='btn1 btn-danger1 btn-xs1'>$result[full_name]</button>
									<button  style='float:none;' class='btn1 btn-danger1 btn-xs1''>Stock: $pro_stock</button>
									</center>
									<hr />
									<p>$pro_desc</p>
								</div>
								<div class='panel-heading'>$  $pro_price
									<button pid='$pro_id' style='float:right;' id='product' class='btn btn-danger btn-xs'>Añadir</button>
								</div>
							</div>
				</div>
			";
		}
	}

	if(isset($_POST["addToCart"])){

		$p_id = $_POST["proId"];

		if(isset($_SESSION["uid"])){
		$user_id = $_SESSION["uid"];
		$sql = "SELECT * FROM cart WHERE p_id = '$p_id' AND user_id = '$user_id'";
		$run_query = pg_query($con,$sql);
		$count = pg_num_rows($run_query);
		if($count > 0){
			echo "
				<div class='alert alert-warning'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Ya has añadido este producto!</b>
				</div>
			";//not in video
		} else {
			$sql = "INSERT INTO cart
			(p_id, ip_add, user_id, qty)
			VALUES ('$p_id','$ip_add','$user_id','1')";
			if(pg_query($con,$sql)){
				echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Producto esta añadido!</b>
					</div>
				";
			}
		}
		}else{
			$sql = "SELECT id FROM cart WHERE ip_add = '$ip_add' AND p_id = '$p_id' AND user_id = -1";
			$query = pg_query($con,$sql);
			if (pg_num_rows($query) > 0) {
				echo "
					<div class='alert alert-warning'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<b>Ya has a�adido este producto!</b>
					</div>";
					exit();
			}
			$sql = "INSERT INTO cart
			(p_id, ip_add, user_id, qty)
			VALUES ('$p_id','$ip_add','-1','1')";
			if (pg_query($con,$sql)) {
				echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Producto Añadido correctamente!</b>
					</div>
				";
				exit();
			}

		}




	}
//Count User cart item
if (isset($_POST["count_item"])) {
	//When user is logged in then we will count number of item in cart by using user session id
	if (isset($_SESSION["uid"])) {
		$sql = "SELECT COUNT(*) AS count_item FROM cart WHERE user_id = $_SESSION[uid]";
	}else{
		//When user is not logged in then we will count number of item in cart by using users unique ip address
		$sql = "SELECT COUNT(*) AS count_item FROM cart WHERE ip_add = '$ip_add' AND user_id < 0";
	}

	$query = pg_query($con,$sql);
	$row = pg_fetch_array($query);
	echo $row["count_item"];
	exit();
}
//Count User cart item
//Get Cart Item From Database to Dropdown menu
if (isset($_POST["Common"])) {
	if (isset($_SESSION["uid"])) {
		//When user is logged in this query will execute
		$sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.user_id='$_SESSION[uid]'";
	}else{
		//When user is not logged in this query will execute
		$sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.ip_add='$ip_add' AND b.user_id < 0";
	}
	$query = pg_query($con,$sql);
	if (isset($_POST["getCartItem"])) {
		//display cart item in dropdown menu
		if (pg_num_rows($query) > 0) {
			$n=0;
			while ($row=pg_fetch_array($query)) {
				$n++;
				$product_id = $row["product_id"];
				$product_title = $row["product_title"];
				$product_price = $row["product_price"];
				$product_image = $row["product_image"];
				$cart_item_id = $row["id"];
				$qty = $row["qty"];
				echo '
					<div class="row">
						<div class="col-md-3">'.$n.'</div>
						<div class="col-md-3"><img class="img-responsive" src="product_images/'.$product_image.'" /></div>
						<div class="col-md-3">'.$product_title.'</div>
						<div class="col-md-3">$'.$product_price.'</div>
					</div>';

			}
			?>
				<a style="float:right;" href="cart.php" class="btn btn-warning">Editar&nbsp;&nbsp;<span class="glyphicon glyphicon-edit"></span></a>
			<?php
			exit();
		}
	}
	if (isset($_POST["checkOutDetails"])) {
		if (pg_num_rows($query) > 0) {
			//display user cart item with "Ready to checkout" button if user is not login
			echo "<form method='post' action='login_form.php'>";
				$n=0;
				while ($row=pg_fetch_array($query)) {
					$n++;
					$product_id = $row["product_id"];
					$product_title = $row["product_title"];
					$product_price = $row["product_price"];
					$product_image = $row["product_image"];
					$cart_item_id = $row["id"];
					$qty = $row["qty"];
					echo
						'<div class="row">
								<div class="col-md-2">
									<div class="btn-group">
										<a href="#" remove_id="'.$product_id.'" class="btn btn-danger remove"><span class="glyphicon glyphicon-trash"></span></a>
										<a href="#" update_id="'.$product_id.'" class="btn btn-primary update"><span class="glyphicon glyphicon-ok-sign"></span></a>
									</div>
								</div>
								<input type="hidden" name="product_id[]" value="'.$product_id.'"/>
								<input type="hidden" name="" value="'.$cart_item_id.'"/>
								<div class="col-md-2"><img class="img-responsive" src="product_images/'.$product_image.'"></div>
								<div class="col-md-2">'.$product_title.'</div>
								<div class="col-md-2"><input type="text" class="form-control qty" value="'.$qty.'" ></div>
								<div class="col-md-2"><input type="text" class="form-control price" value="'.$product_price.'" readonly="readonly"></div>
								<div class="col-md-2"><input type="text" class="form-control total" value="'.$product_price.'" readonly="readonly"></div>
						</div>';
				}

				echo 	'<div class="row">
							<hr />
							<div class="col-md-8"></div>
							<div class="col-md-4"><b class="net_total" style="font-size:20px;"> </b>
	
						</div>';
				if (!isset($_SESSION["uid"])) {
					echo '<input type="submit" style="float:right;" name="login_user_with_product" class="btn btn-info btn-lg" value="Comprar" >
							</form>';

				}else if(isset($_SESSION["uid"])){
					//Here i am adding the functionality to perform the order
					echo '<div class="row">
						<div class="col-md-8">
						</div>
						<div class="col-md-2">
						<a href="payment_success.php"><img src="icons_and_more/button_buy.png" width=130px></a>
						</div>
						</div>';
					
				}
			}
	}


}
//Remove Item From cart
if (isset($_POST["removeItemFromCart"])) {
	$remove_id = $_POST["rid"];
	if (isset($_SESSION["uid"])) {
		$sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND user_id = '$_SESSION[uid]'";
	}else{
		$sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND ip_add = '$ip_add'";
	}
	if(pg_query($con,$sql)){
		echo "<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>El producto es removido del carrito de compras.</b>
				</div>";
		exit();
	}
}
//Update Item From cart
if (isset($_POST["updateCartItem"])) {
	$update_id = $_POST["update_id"];
	$qty = $_POST["qty"];
	if (isset($_SESSION["uid"])) {
		$sql = "UPDATE cart SET qty='$qty' WHERE p_id = '$update_id' AND user_id = '$_SESSION[uid]'";
	}else{
		$sql = "UPDATE cart SET qty='$qty' WHERE p_id = '$update_id' AND ip_add = '$ip_add'";
	}
	if(pg_query($con,$sql)){
		echo "<div class='alert alert-info'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>El producto ha sido actualizado</b>
				</div>";
		exit();
	}
}

// Desde aqui empieza la funcionalidad para vender producto JS
//functions to the seller profile
if(isset($_POST["sellprofile"])){
 	$id_session = (int)pg_escape_string($_SESSION["uid"]);
	$category_query = "SELECT * FROM categories WHERE cat_id IN (SELECT product_cat FROM products WHERE user_id = '$id_session')";
	$run_query = pg_query($con,$category_query) or die("Error de conexion.". pg_error());
	echo "
		<div class='nav nav-pills nav-stacked'>
			<li class='active'><a href='#'><h4>Categorias</h4></a></li>
	";
	if(pg_num_rows($run_query) > 0){
		while($row = pg_fetch_array($run_query)){
			$cid = $row["cat_id"];
			$cat_name = $row["cat_title"];
			echo "
					<li><a href='#' class='category' cid='$cid'>$cat_name</a></li>
			";
		}
		echo "</div>";
	}
}

//Proveedores	
if(isset($_POST["get_sell_brand"])){	
	$id_session = (int)pg_escape_string($_SESSION["uid"]);	
	$prov_query = "SELECT * FROM providers WHERE prov_id IN(SELECT product_prov FROM products WHERE user_id = '$id_session')";	
	$run_query = pg_query($con,$prov_query);	
	echo "	
			<div class='nav nav-pills nav-stacked'>	
				<li class='active'><a href='#'><h5>Organizaciones</h5></a></li>	
		";	
	if(pg_num_rows($run_query) > 0){	
		while($row = pg_fetch_array($run_query)){	
			$bid = $row["prov_id"];	
			$brand_name = $row["prov_title"];	
				echo "	
					<li><a href='#' class='selectBrand_sellprofile' bid='$bid'>$brand_name</a></li>	
				 ";	 		
			 }	 		
			 echo "</div>";	 	
		 }	 	
	 }





//product
if(isset($_POST["get_product_sellprofile"])){
	$user_id = $_SESSION["uid"];
	$limit = 9;
	if(isset($_POST["setPage_sellprofile"])){
		$pageno = $_POST["pageNumber_sellprofile"];
		$start = ($pageno * $limit) - $limit;
	}else{
		$start = 0;
	}
	$product_query = "SELECT * FROM products WHERE user_id = $user_id LIMIT $limit OFFSET $start";
	$run_query = pg_query($con,$product_query);
	if(pg_num_rows($run_query) > 0){
		while($row = pg_fetch_array($run_query)){
			$pro_id    = $row['product_id'];
			$pro_cat   = $row['product_cat'];
			$pro_brand = $row['product_prov'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_desc = $row['product_desc'];
			$pro_image = $row['product_image'];
			$pro_user_id = $row['user_id'];	
			$pro_stock = $row['stock'];	
			$user_query = "SELECT first_name ||' '|| last_name as full_name from user_info where $pro_user_id = user_id";	
			$run_user_query = pg_query($con,$user_query);	
			$result = pg_fetch_array($run_user_query );
			echo "
			<div class='col-md-4'>
						<div class='panel panel-info'>
							<div class='panel-heading'>$pro_title</div>
							<div class='panel-body'>
								<center>
								<img src='product_images/$pro_image' style='width:160px; height:160px;'/>
								</center>
							</div>
							<div class='panel-body'>
								<center>
								<center>
									<button  style='float:none;' class='btn1 btn-danger1 btn-xs1''>Stock: $pro_stock</button>
								</center>
								<hr />
									<p>$pro_desc</p>
							</div>
							<div class='panel-heading'>$  $pro_price
								<button pid='$pro_id' style='float:none;' id='product' class='btn btn-danger btn-xs'>Añadir</button>
								<button pid='$pro_id' style='float:none;' id='product_update' class='btn btn-danger btn-xs'>Actualizar</button>	
								<button pid='$pro_id' style='float:right;' id='product_delete' class='btn btn-danger btn-xs'>Eliminar</button>
							</div>
						</div>
					</div>
			";
		}
	}
}



//barra de busqueda en page_sellprofile // desactivada hasta arreglarla
// descomentar en sellprofile.php
if(isset($_POST["page_sellprofile"])){
	$user_id = $_SESSION["uid"];
	$sql = "SELECT * FROM products WHERE user_id = '$user_id'";
	$run_query = pg_query($con,$sql);
	$count = pg_num_rows($run_query);
	$pageno = ceil($count/9);
	for($i=1;$i<=$pageno;$i++){
		echo "
			<li><a href='#' page='$i' id='page'>$i</a></li>
		";
	}
}
// hasta aqui va la barra


if(isset($_POST["get_seleted_Category_sellprofile"])  || isset($_POST["selectBrand_sellprofile"]) || isset($_POST["search_sellprofile"])){
	$user_id = $_SESSION["uid"];
	if(isset($_POST["get_seleted_Category_sellprofile"])){
		$id = $_POST["cat_id"];
		$sql = "SELECT * FROM products WHERE product_cat = '$id' and user_id = '$user_id' ";
	}else if(isset($_POST["selectBrand_sellprofile"])){
		$id = $_POST["brand_id"];
		$sql = "SELECT * FROM products WHERE product_prov = '$id'and user_id = '$user_id' ";
	}else {
		$keyword = $_POST["keyword"];
		$sql = "SELECT * FROM products WHERE product_keywords LIKE '%$keyword%'";
	}
	$run_query = pg_query($con,$sql);
	while($row=pg_fetch_array($run_query)){
			$pro_id    = $row['product_id'];
			$pro_cat   = $row['product_cat'];
			$pro_brand = $row['product_prov'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_desc = $row['product_desc'];
			$pro_image = $row['product_image'];
			$pro_user_id = $row['user_id'];
			$pro_stock = $row['stock'];
			$user_query = "SELECT first_name ||' '|| last_name as full_name from user_info where $pro_user_id = user_id";
			$run_user_query = pg_query($con,$user_query);
			$result = pg_fetch_array($run_user_query );
			echo "
				<div class='col-md-4'>
							<div class='panel panel-info'>
								<div class='panel-heading'>$pro_title</div>
								<div class='panel-body'>
									<center>
									<img src='product_images/$pro_image' style='width:160px; height:160px;'/>
									</center>
								</div>
								<div class='panel-body'>
									<center>
									<button  style='float:none;' class='btn1 btn-danger1 btn-xs1''> Stock: $pro_stock</button>
									</center>
									<hr />
									<p>$pro_desc</p>
								</div>
								<div class='panel-heading'>$  $pro_price
									<button pid='$pro_id' style='float:right;' id='product' class='btn btn-danger btn-xs'>Añadir</button>
								</div>
							</div>
				</div>
			";
		}
}

?>

