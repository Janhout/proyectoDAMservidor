<?php
	require_once("../constantes.php");
	session_start();
	if(!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
  		echo SESION_EXPIRADA;
  		exit();
	} else {
		if(isset($_POST['id_cliente'])){
			require_once("../conexion.php");
			$id_cliente = mysqli_real_escape_string($con, $_POST['id_cliente']);

			$q = "DELETE FROM cliente
				  WHERE id_usuario=".$_SESSION['id_usuario']." AND id_cliente=".$id_cliente;
			require_once('resultadoDelete.php');
		} else {
			echo FALTAN_PARAMETROS;
		}
	}
?>