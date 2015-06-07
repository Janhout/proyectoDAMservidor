<?php
	require_once("../constantes.php");
	session_start();
	if(!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
  		echo SESION_EXPIRADA;
  		exit();
	} else {
		if(isset($_POST['id_gasto'])){
			require_once("../conexion.php");
			$id_gasto = mysqli_real_escape_string($con, $_POST['id_gasto']);

			$q = "DELETE FROM gasto
				  WHERE id_usuario=".$_SESSION['id_usuario']." AND id_gasto=".$id_gasto;
			require_once('resultadoDelete.php');
		} else {
			echo FALTAN_PARAMETROS;
		}
	}
?>