<?php
	require_once("../constantes.php");
	session_start();
	if(!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
  		echo SESION_EXPIRADA;
  		exit();
	} else {
		if(isset($_GET['nif']) && isset($_GET['nombre_comercial'])){
			require_once("../conexion.php");
			$nif = mysqli_real_escape_string($con, $_GET['nif']);
			$nombre_comercial = mysqli_real_escape_string($con, $_GET['nombre_comercial']);
			$q = "SELECT *
				  FROM cliente
				  WHERE id_usuario=".$_SESSION['id_usuario']." AND nif='".$nif."' AND nombre_comercial='".$nombre_comercial."'";

			$result = mysqli_query($con, $q);

			if($result){
				if(mysqli_num_rows($result)<1){
					echo PETICION_CORRECTA;
				} else {
					echo CLIENTE_EXISTENTE;
				}
			} else {
				echo ERROR_CONSULTA;
			}
			mysqli_close($con);
		} else{
			echo FALTAN_PARAMETROS;
		}
	}
?>