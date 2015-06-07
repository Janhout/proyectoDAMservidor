<?php
	require_once("../constantes.php");
	session_start();
	if(!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
  		echo SESION_EXPIRADA;
  		exit();
	} else {
		require_once("../conexion.php");
		$paginador = "";
		if(isset($_GET['page']) && isset($_GET['limit'])) {
			$page = mysqli_real_escape_string($con, $_GET['page']);
			$limit = mysqli_real_escape_string($con, $_GET['limit']);
			$paginador = " LIMIT ".($page*$limit).",".$limit;
		}
		$filtro = "";
		if(isset($_GET['q'])){
			$query = mysqli_real_escape_string($con, $_GET['q']);
			$filtro = " AND (nombre_producto LIKE '%".$query.
			"%' OR descripcion LIKE '%".$query."%' OR referencia_producto LIKE '%".$query."%')";
		}

		$q = "SELECT * 
			  FROM producto
			  WHERE id_usuario=".$_SESSION['id_usuario'].$filtro.$paginador;
		
		require_once('resultadoConsulta.php');
	}
?>