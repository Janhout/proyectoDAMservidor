<?php
	require_once("../constantes.php");
	session_start();
	if(!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
  		echo SESION_EXPIRADA;
  		exit();
	} else {
		if(isset($_POST['concepto']) && isset($_POST['importe'])){
			require_once("../conexion.php");
			$importe = mysqli_real_escape_string($con, $_POST['importe']);
			$concepto = mysqli_real_escape_string($con, $_POST['concepto']);
			$detalles = "";
			$tipo_iva = "";
			$fecha = date('Y-m-d');

			if(isset($_POST['detalles'])){
				$detalles = mysqli_real_escape_string($con, $_POST['detalles']);
			}
			if(isset($_POST['tipo_iva'])){
				$tipo_iva = mysqli_real_escape_string($con, $_POST['tipo_iva']);
			}

			$q = "INSERT INTO gasto(id_usuario, importe, fecha, detalles, concepto, tipo_iva) 
				  VALUES (".$_SESSION['id_usuario'].", ".$importe.", '".$fecha."', '".$detalles."', '".$concepto."', ".$tipo_iva.")";

			require_once("resultadoPost.php");
		} else {
			echo FALTAN_PARAMETROS;
		}		
	}
?>