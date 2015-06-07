<?php
	require_once("../constantes.php");
	session_start();
	if(!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
  		echo SESION_EXPIRADA;
  		exit();
	} else {
		if(isset($_GET['id'])){
			require_once("../conexion.php");
			$id_cliente = mysqli_real_escape_string($con, $_GET['id']);

			$fav = "cliente.favorito^1";
			if(isset($_GET['fav'])){
				$f = mysqli_real_escape_string($con, $_GET['fav']);
				if(strcmp($f, "true")){
					$fav = "b'1'";
				} else {
					$fav = "b'0'";
				}
			}
			$q = "UPDATE cliente
				  SET favorito=".$fav."
				  WHERE id_usuario=".$_SESSION['id_usuario']." AND id_cliente=".$id_cliente;
				  
			require_once('resultadoSet.php');
		} else {
			echo FALTAN_PARAMETROS;
		}
	}
?>