<?php
	require_once("../constantes.php");
	session_start();
	if(!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
  		echo SESION_EXPIRADA;
  		exit();
	} else {
		require_once("../conexion.php");
		$q = "SELECT * FROM localidad";
		if(isset($_GET['id_provincia'])){
			$id = mysqli_real_escape_string($con, $_GET['id_provincia']);
			$q = $q." WHERE id_provincia=".$id;
		}
		require_once('resultadoConsulta.php');
	}
?>