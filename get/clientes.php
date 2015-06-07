<?php
	require_once("../constantes.php");
	session_start();
	if(!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
  		echo SESION_EXPIRADA;
  		exit();
	} else {
		require_once("../conexion.php");
		$q = "";
		if(isset($_GET['id'])){
			$id = mysqli_real_escape_string($con, $_GET['id']);
			$q = "SELECT id_cliente AS cliente, nombre_comercial, direccion, numero_cuenta, nif, telefono01, telefono02, email, favorito
				  FROM cliente
				  WHERE id_usuario=".$_SESSION['id_usuario']." AND id_cliente=".$id;
		} else{
			$paginador = "";
			if(isset($_GET['page']) && isset($_GET['limit'])) {
				$page = mysqli_real_escape_string($con, $_GET['page']);
				$limit = mysqli_real_escape_string($con, $_GET['limit']);
				$paginador = " LIMIT ".($page*$limit).",".$limit;
			}
			$filtro = "";
			if(isset($_GET['q'])){
				$query = mysqli_real_escape_string($con, $_GET['q']);
				$filtro = " AND (nombre_comercial LIKE '%".$query.
				"%' OR nif LIKE '%".$query."%')";
			}
			$favoritos = "";
			if(isset($_GET['favoritos'])){
				$fav = mysqli_real_escape_string($con, $_GET['favoritos']);
				if(strcmp("true", $fav)==0){
					$favoritos = " AND favorito=1";
				}
			}

			$q = "SELECT id_cliente AS cliente, nombre_comercial, direccion, numero_cuenta, nif, telefono01, telefono02, email, favorito
				  FROM cliente
				  WHERE id_usuario=".$_SESSION['id_usuario'].$favoritos.$filtro.$paginador;
		}
		require_once('resultadoConsulta.php');
	}
?>