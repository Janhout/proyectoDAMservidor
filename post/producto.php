<?php
	require_once("../constantes.php");
	session_start();
	if(!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
  		echo SESION_EXPIRADA;
  		exit();
	} else {
		if(isset($_POST['nombre_producto']) && isset($_POST['referencia_producto']) &&
				isset($_POST['precio_coste']) && isset($_POST['precio_venta']) &&
				isset($_POST['tipo_iva'])){
			require_once("../conexion.php");
			$nombre_producto = mysqli_real_escape_string($con, $_POST['nombre_producto']);
			$referencia_producto = mysqli_real_escape_string($con, $_POST['referencia_producto']);
			$precio_coste = mysqli_real_escape_string($con, $_POST['precio_coste']);
			$precio_venta = mysqli_real_escape_string($con, $_POST['precio_venta']);
			$tipo_iva = mysqli_real_escape_string($con, $_POST['tipo_iva']);
			$descripcion = "";

			if(isset($_POST['descripcion'])){
				$descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);
			}
			
			$q = "INSERT INTO producto(id_usuario, nombre_producto, referencia_producto, precio_coste, precio_venta, tipo_iva, descripcion)
				  VALUES (".$_SESSION['id_usuario'].", '".$nombre_producto."', '".$referencia_producto."', '".$precio_coste."', '".$precio_venta."', '".$tipo_iva."', '".$descripcion."')";
			
			require_once('resultadoPost.php');
		} else {
			echo FALTAN_PARAMETROS;
		}		
	}
?>