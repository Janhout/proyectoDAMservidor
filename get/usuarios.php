<?php
	require_once("../constantes.php");
	session_start();
	if(!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
  		echo SESION_EXPIRADA;
  		exit();
	} else {
		require_once("../conexion.php");

		$q = "SELECT * FROM usuario WHERE id_usuario=".$_SESSION['id_usuario'];
		
		require_once('resultadoConsulta.php');
	}
?>