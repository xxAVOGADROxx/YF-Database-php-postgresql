<?php
$cadena="host='localhost' port='5432' dbname='final' user='Henry' password='12345'";
$con=pg_connect($cadena) or die("Error de conexion.". pg_error());
?>