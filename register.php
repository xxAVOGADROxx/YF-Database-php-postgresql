<?php
session_start();
include "db.php";
if (isset($_POST["f_name"])) {

	$f_name = $_POST["f_name"];
	$l_name1 = $_POST["l_name1"];
    $l_name2 = $_POST["l_name2"];
    $dependence = $_POST['dependence'];
    $email = $_POST['email'];
	$password = $_POST['password'];
	$repassword = $_POST['repassword'];
	$mobile = $_POST['mobile'];
	$name = "/^[a-zA-Z ]+$/";
	$emailValidation = "/^[a-zA-Z0-9_.+-]+@(?:(?:[a-zA-Z0-9-]+\.)?[a-zA-Z]+\.)?(aviacioncivil.gob)\.ec$/";
    $number = "/^[0-9]+$/";



    if(empty($f_name) || empty($l_name1) || empty($l_name2)||empty($dependence) || empty($email) || empty($password) || empty($repassword) || empty($mobile) ){

		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Por favor llena todos los campos</b>
			</div>
		";
		exit();
	} else {
		if(!preg_match($name,$f_name)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b> $f_name No es valido!</b>
			</div>
		";
		exit();
	}
	if(!preg_match($name,$l_name1)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b> $l_name1 no es valido!</b>
			</div>
		";
		exit();
	}
    if(!preg_match($name,$l_name2)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b> $l_name2 no es valido!</b>
			</div>
		";
		exit();
	}
    if(!preg_match($name,$dependence)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b> $dependence no es valido!</b>
			</div>
		";
		exit();
	}
	if(!preg_match($emailValidation,$email)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b> $email no es valido!</b>
			</div>
		";
		exit();
	}
	if(strlen($password) < 9 ){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>La contraseña es muy débil]</b>
			</div>
		";
		exit();
	}
	if(strlen($repassword) < 9 ){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>La contraseña es muy débil</b>
			</div>
		";
		exit();
	}
	if($password != $repassword){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>La contraseña no es la misma</b>
			</div>
		";
	}
	if(!preg_match($number,$mobile)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>El número  $mobile  no es valido</b>
			</div>
		";
		exit();
	}
	if(strlen($mobile) > 10){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>El teléfono de contacto es superior a 10 dígitos</b>
			</div>
		";
		exit();
	}
	//existing email address in our database
	$sql = "SELECT user_id FROM user_info WHERE email = '$email' LIMIT 1" ;
	$check_query = pg_query($con,$sql);
	$count_email = pg_num_rows($check_query);
	if($count_email > 0){
		echo "
			<div class='alert alert-danger'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>El correo ya se ecuentra en uso en nuestro sistema, intentalo con uno nuevo</b>
			</div>
		";
		exit();
	} else {
		$password = md5($password);


		$sql = "INSERT INTO user_info
		(first_name, last_name1, last_name2, dependence, email,
		password, contact_number)
		VALUES ( '$f_name','$l_name1','$l_name2','$dependence', '$email','$password','$mobile') RETURNING user_id";
		$run_query = pg_query($con,$sql);
		$insert_row = pg_fetch_row($run_query);

		$_SESSION["uid"] = $insert_row[0];

		//Esta funcion no tiene actualmente analogo en Postgress
		// $_SESSION["uid"] = mysqli_insert_id($con);

		$_SESSION["name"] = $f_name;
		$ip_add = getenv("REMOTE_ADDR");
		$sql = "UPDATE cart SET user_id = '$_SESSION[uid]' WHERE ip_add='$ip_add' AND user_id = -1";
		if(pg_query($con,$sql)){
			echo "register_success";
			exit();
		}
    }
    }
}
?>
