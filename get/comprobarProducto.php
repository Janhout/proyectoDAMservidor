<?php
	require_once("../constantes.php");
	session_start();
	if(!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
  		echo SESION_EXPIRADA;
  		exit();
	} else {
		if(isset($_GET['referencia_producto'])){
			require_once("../conexion.php");
			$referencia_producto = mysqli_real_escape_string($con, $_GET['referencia_producto']);
			$q = "SELECT *
				  FROM producto
				  WHERE id_usuario=".$_SESSION['id_usuario']." AND referencia_producto='".$referencia_producto."'";

			$result = mysqli_query($con, $q);

			if($result){
				if(mysqli_num_rows($result)<1){
					echo PETICION_CORRECTA;
				} else {
					echo PRODUCTO_EXISTENTE;
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