<?php
	require_once("../constantes.php");
	session_start();
	if(!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
  		echo SESION_EXPIRADA;
  		exit();
	} else {
		if(isset($_POST['pass'])){
			require_once("../conexion.php");
			$pass= mysqli_real_escape_string($con, $_POST['pass']);

			$q = "DELETE FROM usuario
				  WHERE id_usuario=".$_SESSION['id_usuario']." AND password='".$pass."'";
			require_once('resultadoDelete.php');
		} else {
			echo FALTAN_PARAMETROS;
		}	
	}
?>