<?php
	require_once("../constantes.php");
	session_start();
	if(!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
  		echo SESION_EXPIRADA;
  		exit();
	} else {
		if(isset($_POST['provincia']) && isset($_POST['titulo'])){
			require_once("../conexion.php");
			$provincia = mysqli_real_escape_string($con, $_POST['provincia']);
			$titulo = mysqli_real_escape_string($con, $_POST['titulo']);

			$q = "INSERT INTO provincia(provincia, titulo)
				  VALUES ('".$provincia."', '".$titulo."')";
			
			require_once('resultadoPost.php');
		} else {
			echo FALTAN_PARAMETROS;
		}		
	}
?>