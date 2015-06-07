<?php
	require_once("constantes.php");
	if(!isset($_POST['usuario']) || !isset($_POST['pass'])){
		echo FALTAN_PARAMETROS;
	} else{
		require_once("conexion.php");

		$usuario = mysqli_real_escape_string($con, $_POST["usuario"]);   
		$password = mysqli_real_escape_string($con, $_POST["pass"]);

		$q = "SELECT * FROM usuario WHERE usuario='".$usuario."' AND password='".$password."'";
		$result = mysqli_query($con, $q) or die(mysqli_error($con));

		if(mysqli_num_rows($result)==1){
			session_start();
			$row = mysqli_fetch_array($result);
			$_SESSION['usuario'] = $usuario;
			$_SESSION['id_usuario'] = $row['id_usuario'];
			echo LOGIN_CORRECTO;
		} else {
			echo LOGIN_INCORRECTO;
		}
		mysqli_close($con);
		exit(); 
	}
?>