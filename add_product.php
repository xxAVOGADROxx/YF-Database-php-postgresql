<?php
include "db.php";

session_start();

#Login script is begin here
#If user given credential matches successfully with the data available in database then we will echo string login_success
#login_success string will go back to called Anonymous funtion $("#login").click()
if(isset($_POST["title_prod"]) &&
   isset($_POST["description_prod"])&&
   isset($_POST["keywords_prod"])&&
   isset($_POST["stock_prod"])&&
   isset($_POST["price_prod"])&&
   isset($_POST["limit_date_prod"])&&
   isset($_POST["image_prod"]) &&
   isset($_POST["catego_prod"])
 ){
  $title = pg_escape_string($con,$_POST["title_prod"]);
  $description = pg_escape_string($con,$_POST["description_prod"]);
  $stock=(int)$stock_str = pg_escape_string($con,$_POST["stock_prod"]);
  $price =(int)$price_str = pg_escape_string($con,$_POST["price_prod"]);
  $limitdate = pg_escape_string($con,$_POST["limit_date_prod"]);
  $keywords = pg_escape_string($con,$_POST["keywords_prod"]);
  $image = pg_escape_string($con,$_POST["image_prod"]);
  $id_session=(int)pg_escape_string($_SESSION["uid"]);
  $catego= pg_escape_string($con,$_POST["catego_prod"]);

  $sql = "INSERT INTO products (user_id, product_desc, stock, limit_date, register_date, product_cat, product_prov, product_title, product_price,
     product_image, product_keywords) values
  ('$id_session', '$description', '$stock', '$limitdate', now(), '$catego', isProveedor('$id_session'), '$title', '$price', '$image', '$keywords' )";
	$run_query = pg_query($con,$sql);
  echo "add_success";
  exit();
}


?>
