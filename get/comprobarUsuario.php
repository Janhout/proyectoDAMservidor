<?php
	require_once("../constantes.php");
	if(isset($_GET['usuario']) && isset($_GET['nombre_empresa'])){
		require_once("../conexion.php");
		$usuario = mysqli_real_escape_string($con, $_GET['usuario']);
		$nombre_empresa = mysqli_real_escape_string($con, $_GET['nombre_empresa']);
		$q = "SELECT *
			  FROM usuario
			  WHERE usuario='".$usuario."' OR nombre_empresa='".$nombre_empresa."'";

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
?>