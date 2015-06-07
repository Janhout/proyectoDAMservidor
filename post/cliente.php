<?php
	require_once("../constantes.php");
	session_start();
	if(!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
  		echo SESION_EXPIRADA;
  		exit();
	} else {
		if(isset($_POST['nombre_comercial']) && isset($_POST['nif'])){
			require_once("../conexion.php");
			$nombre_comercial = mysqli_real_escape_string($con, $_POST['nombre_comercial']);
			$nif = mysqli_real_escape_string($con, $_POST['nif']);
			$telefono1 = "";
			$telefono2 = "";
			$direccion = "";
			$email = "";

			if(isset($_POST['telefono01'])){
				$telefono1 = mysqli_real_escape_string($con, $_POST['telefono01']);
			}
			if(isset($_POST['telefono02'])){
				$telefono2 = mysqli_real_escape_string($con, $_POST['telefono02']);
			}
			if(isset($_POST['direccion'])){
				$direccion = mysqli_real_escape_string($con, $_POST['direccion']);
			}
			if(isset($_POST['email'])){
				$email = mysqli_real_escape_string($con, $_POST['email']);
			}
			$q = "INSERT INTO cliente(id_usuario, nombre_comercial, nif, telefono01, telefono02, direccion, email)
				  VALUES (".$_SESSION['id_usuario'].", '".$nombre_comercial."', '".$nif."', '".$telefono1."', '".$telefono2."', '".$direccion."', '".$email."')";
			
			require_once('resultadoPost.php');
		} else {
			echo FALTAN_PARAMETROS;
		}		
	}
?>