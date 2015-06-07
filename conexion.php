<?php
	$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
	if(!$con){
		die(ERROR_CONEXION_BD);
		exit();
	}
	mysqli_set_charset($con, "utf8")
?>
