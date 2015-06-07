<?php
	require_once("../constantes.php");
	if(isset($_POST['usuario']) && isset($_POST['email']) && 
			isset($_POST['nif']) && isset($_POST['password']) && 
			isset($_POST['nombre_empresa'])){
		require_once("../conexion.php");
		$usuario = mysqli_real_escape_string($con, $_POST['usuario']);
		$email = mysqli_real_escape_string($con, $_POST['email']);
		$password = mysqli_real_escape_string($con, $_POST['password']);
		$nombre_empresa = mysqli_real_escape_string($con, $_POST['nombre_empresa']);
		$nif = mysqli_real_escape_string($con, $_POST['nif']);
		
		$q = "INSERT INTO usuario(usuario, nif, email, password, nombre_empresa)
			  VALUES ('".$usuario."', '".$nif."', '".$email."', '".$password."', '".$nombre_empresa."')";
		
		require_once('resultadoPost.php');
	} else {
		echo FALTAN_PARAMETROS;
	}
?>