<?php
	require_once("../constantes.php");
	session_start();
	if(!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
  		echo SESION_EXPIRADA;
  		exit();
	} else {
		require_once("../conexion.php");

		$sub = "SELECT SUM(producto.precio_venta*productoFactura.cantidad*(1+(producto.tipo_iva/100)))
						  FROM productoFactura INNER JOIN producto
						  ON productoFactura.id_producto=producto.id_producto
						  WHERE productoFactura.id_factura=factura.id_factura";

		$q = "SELECT cliente.nombre_comercial, factura.numero, factura.fecha, factura.id_cliente AS cliente, factura.estado, (".$sub.") AS liquido, factura.pendiente, factura.printed, factura.sent, factura.id_factura AS id_s
			  FROM factura
			  INNER JOIN cliente
			  ON factura.id_cliente = cliente.id_cliente
			  WHERE cliente.id_usuario=".$_SESSION['id_usuario'];

		if(isset($_GET['id'])){
			$id = mysqli_real_escape_string($con, $_GET['id']);
			$q = $q." AND factura.id_factura=".$id;
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
				$filtro = " AND (cliente.nombre_comercial LIKE '%".$query.
				"%' OR cliente.nif LIKE '%".$query."%' OR factura.numero LIKE '%".$query."%')";
			}
			$filtro_estado = "";
			if(isset($_GET['estado'])){
				$estado = mysqli_real_escape_string($con, $_GET['estado']);
				$filtro_estado = " AND (factura.estado='".$estado."')";
			}
			$filtro_cliente = "";
			if(isset($_GET['id_cliente'])){
				$id_cliente = mysqli_real_escape_string($con, $_GET['id_cliente']);
				$filtro_cliente = " AND (factura.id_cliente='".$id_cliente."')";
			}
			$q = $q.$filtro_estado.$filtro_cliente.$filtro.$paginador;
		}
		require_once('resultadoConsulta.php');
	}
?>