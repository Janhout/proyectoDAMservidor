<?php
	require_once("../constantes.php");
	session_start();
	if(!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
  		echo SESION_EXPIRADA;
  		exit();
	} else {
		if(isset($_POST['tipo']) && isset($_POST['titulo'])){
			require_once("../conexion.php");
			$tipo = mysqli_real_escape_string($con, $_POST['tipo']);
			$titulo = mysqli_real_escape_string($con, $_POST['titulo']);

			$q = "INSERT INTO tipoDireccion(tipo, titulo)
				  VALUES ('".$tipo."', '".$titulo."')";
			
			require_once('resultadoPost.php');
		} else {
			echo FALTAN_PARAMETROS;
		}		
	}
?>