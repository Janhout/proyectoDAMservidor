<?php
	require_once("../constantes.php");
	session_start();
	if(!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
  		echo SESION_EXPIRADA;
  		exit();
	} else {
		if(isset($_POST['id_tipoDireccion'])){
			require_once("../conexion.php");
			$id_tipo_direccion = mysqli_real_escape_string($con, $_POST['id_tipo_direccion']);

			$q = "DELETE FROM tipoDireccion
				  WHERE AND id_tipo_direccion=".$id_tipo_direccion;
			require_once('resultadoDelete.php');
		} else {
			echo FALTAN_PARAMETROS;
		}
	}
?>