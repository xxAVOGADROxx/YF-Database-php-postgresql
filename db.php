<?php
$cadena="host='localhost' port='5432' dbname='dgac_req' user='jose' password='12345678'";
$con=pg_connect($cadena) or die("Error de conexion.". pg_error());
?>
