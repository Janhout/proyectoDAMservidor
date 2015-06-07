<?php
	require_once("../constantes.php");
	session_start();
	if(!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
  		echo SESION_EXPIRADA;
  		exit();
	} else {
		if(isset($_POST['id_factura'])){
			require_once("../conexion.php");
			$id_factura = mysqli_real_escape_string($con, $_POST['id_factura']);

			$q = "DELETE FROM factura
				  WHERE id_factura=".$id_factura;
			require_once('resultadoDelete.php');
		} else {
			echo FALTAN_PARAMETROS;
		}
	}
?>