<?php
	require_once("../constantes.php");
	session_start();
	if(!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
  		echo SESION_EXPIRADA;
  		exit();
	} else {
		if(isset($_POST['id_localidad'])){
			require_once("../conexion.php");
			$id_localidad = mysqli_real_escape_string($con, $_POST['id_localidad']);

			$q = "DELETE FROM localidad
				  WHERE id_localidad=".$id_localidad;
			require_once('resultadoDelete.php');
		} else {
			echo FALTAN_PARAMETROS;
		}
	}
?>