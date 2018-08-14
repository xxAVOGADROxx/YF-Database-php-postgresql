<?php
include "db.php";
session_start();
#Login script is begin here
#If user given credential matches successfully with the data available in database then we will echo string login_success
#login_success string will go back to called Anonymous funtion $("#login").click()
if(isset($_POST["title_req1"])){
  $c_title1 = $POST["title_req1"];
  $c_title2 = $_POST["title_req2"];
  $c_title3 = $_POST["title_req3"];
  $c_title4 = $_POST["title_req4"];
  $c_title5 = $_POST["title_req5"];


  if(empty($c_title1) && empty($c_title2) && empty($c_title3) && empty($c_title4) && empty($c_title5) ){
  		echo "add_success";
  		exit();
  	}else {
  echo "add_success";
  exit();
}
}
?>
