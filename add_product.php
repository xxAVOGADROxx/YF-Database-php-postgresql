<?php
include "db.php";
session_start();
#Login script is begin here
#If user given credential matches successfully with the data available in database then we will echo string login_success
#login_success string will go back to called Anonymous funtion $("#login").click()
if(isset($_POST["title_prod"])){
  $c_title1 = $_POST["title_req1"];
  $c_title2 = $_POST["title_req2"];
  $c_title3 = $_POST["title_req3"];
  $c_title4 = $_POST["title_req4"];
  $c_title5 = $_POST["title_req5"];


  if(empty($c_title1) && empty($c_title2) && empty($c_title3) && empty($c_title4) && empty($c_title5) ){
  		echo "
  			<div class='alert alert-warning'>
  				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Debe haber al menos un campo lleno. </b>
  			</div>
  		";
  		exit();
  	}else {

  $id_session=(int)pg_escape_string($_SESSION["uid"]);

 //buscar al dependencia de la personas
 $dep_person = "SELECT dependence FROM user_info WHERE user_id = '$id_session'";
 $run_query_dependence = pg_query($con,$dep_person);

  $sql_order = "INSERT INTO orders (user_id, dependence, date_order) VALUES ('$id_session', '$run_query_dependence', now())";
  //$sql = "INSERT INTO requirements (user_id, requirements _id, order_id, requirement, date_solution,  solution, equipment, type_of_atten, observations) values
  //('$id_session', '$description', '$stock', '$limitdate', now(), '$catego', isProveedor('$id_session'), '$title', '$price', '$image', '$keywords')";
	//$run_query = pg_query($con,$sql);
  echo "add_success";
  exit();
}
}

?>
