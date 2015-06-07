<?php
	require_once("../constantes.php");
	session_start();
	if(!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
  		echo SESION_EXPIRADA;
  		exit();
	} else {
		if(isset($_POST['id_cliente']) && isset($_POST['fecha'])
				&& isset($_POST['fecha_vencimiento'])){
			require_once("../conexion.php");
			$id_cliente = mysqli_real_escape_string($con, $_POST['id_cliente']);
			$numero = "#".$id_cliente.date('jnyGis');
			$fecha = mysqli_real_escape_string($con, $_POST['fecha']);
			$fecha_vencimiento = mysqli_real_escape_string($con, $_POST['fecha_vencimiento']);
			$notas = "";

			if(isset($_POST['notas'])){
				$notas = mysqli_real_escape_string($con, $_POST['notas']);
			}

			$fecha_temp = date_create_from_format('d/m/Y', $fecha);
			$fecha = date_format($fecha_temp, 'Y-m-d');

			$fecha_temp = date_create_from_format('d/m/Y', $fecha_vencimiento);
			$fecha_vencimiento = date_format($fecha_temp, 'Y-m-d');

			$q = "INSERT INTO factura(id_cliente, numero, fecha, fecha_vencimiento, notas)
				  VALUES (".$id_cliente.", '".$numero."', '".$fecha."', '".$fecha_vencimiento."', '".$notas."')";
			
			mysqli_autocommit($con, FALSE);

			$result = mysqli_query($con, $q);
	
			if($result){
				$id_factura = mysqli_insert_id($con);
				if(isset($_POST['productos'])){
					$productos = mysqli_real_escape_string($con, $_POST['productos']);

					$temp = substr($productos, 2, strlen($productos)-4);
					$temp = explode("],[", $temp);

					foreach ($temp as $valor) {
						$temp2 = explode(",", $valor);
						$id_producto = $temp2[0];
						$cantidad = $temp2[1];

						$q = "INSERT INTO productoFactura(id_factura, id_producto, cantidad)
					  	VALUES (".$id_factura.", ".$id_producto.", ".$cantidad.")";

					  	$result2 = mysqli_query($con, $q);
	
						if(!$result2){
							echo $q;
							echo "ERROR_INSERTAR_PRODUCTO";
							mysqli_rollback($con);
							mysqli_close($con);	
							exit();
						}
					}

					$sub = "SELECT SUM(producto.precio_venta * productoFactura.cantidad*(1+(producto.tipo_iva/100))) 
						  FROM productoFactura INNER JOIN producto
						  ON productoFactura.id_producto=producto.id_producto
						  WHERE productoFactura.id_factura=".$id_factura;

					$q = "UPDATE factura
						  SET pendiente=(".$sub.")
						  WHERE id_factura=".$id_factura;
					
					$result3 = mysqli_query($con, $q);
					if($result3){
						echo CORRECTO;
						mysqli_commit($con);
					} else{
						echo ERROR_INSERTAR_ENTRADA;
						mysqli_rollback($con);
					}
				} else {
					echo CORRECTO;
					mysqli_commit($con);
				}
			} else {
				echo ERROR_INSERTAR_ENTRADA;
				mysqli_rollback($con);
			}
			mysqli_close($con);	
		} else {
			echo FALTAN_PARAMETROS;
		}	
	}
?>