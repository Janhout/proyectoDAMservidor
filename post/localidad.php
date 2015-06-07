<?php
	require_once("../constantes.php");
	session_start();
	if(!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
  		echo SESION_EXPIRADA;
  		exit();
	} else {
		if(isset($_POST['localidad']) && isset($_POST['titulo']) && 
				isset($_POST['codigo_postal']) && isset($_POST['id_provincia'])){
			require_once("../conexion.php");
			$localidad = mysqli_real_escape_string($con, $_POST['localidad']);
			$titulo = mysqli_real_escape_string($con, $_POST['titulo']);
			$codigo_postal = mysqli_real_escape_string($con, $_POST['codigo_postal']);
			$id_provincia = mysqli_real_escape_string($con, $_POST['id_provincia']);

			$q = "INSERT INTO localidad(localidad, id_provincia, titulo, codigo_postal)
				  VALUES ('".$localidad."', ".$id_provincia.", '".$titulo."', '".$codigo_postal."')";
			
			require_once('resultadoPost.php');
		} else {
			echo FALTAN_PARAMETROS;
		}		
	}
?>