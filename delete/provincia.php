<?php
	require_once("../constantes.php");
	session_start();
	if(!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
  		echo SESION_EXPIRADA;
  		exit();
	} else {
		if(isset($_POST['id_provincia'])){
			require_once("../conexion.php");
			$id_provincia = mysqli_real_escape_string($con, $_POST['id_provincia']);

			$q = "DELETE FROM provincia
				  WHERE id_provincia=".$id_provincia;
			require_once('resultadoDelete.php');
		} else {
			echo FALTAN_PARAMETROS;
		}
	}
?>