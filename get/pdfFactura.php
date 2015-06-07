<?php
	require_once("../constantes.php");
	session_start();
	if(!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
  		echo SESION_EXPIRADA;
  		exit();
	} else {
		if(isset($_GET['id'])){
			require_once("../conexion.php");
			$sub = "SELECT SUM(producto.precio_venta*productoFactura.cantidad*(1+(producto.tipo_iva/100)))
						  FROM productoFactura INNER JOIN producto
						  ON productoFactura.id_producto=producto.id_producto
						  WHERE productoFactura.id_factura=factura.id_factura";

			$q = "SELECT cliente.nombre_comercial, factura.numero, factura.fecha, factura.fecha_vencimiento, 
						 factura.estado, (".$sub.") AS importe, factura.pendiente
				  FROM factura
				  INNER JOIN cliente
				  ON factura.id_cliente = cliente.id_cliente
				  WHERE cliente.id_usuario=".$_SESSION['id_usuario'];
			$id = mysqli_real_escape_string($con, $_GET['id']);
			$q = $q." AND factura.id_factura=".$id;

			$q2 = "SELECT producto.referencia_producto, producto.nombre_producto, producto.precio_venta, 
						  producto.tipo_iva, productoFactura.cantidad, 
						  producto.precio_venta*productoFactura.cantidad*(1+(producto.tipo_iva/100)) AS total
				   FROM producto INNER JOIN productoFactura
				   ON producto.id_producto = productoFactura.id_producto
				   WHERE productoFactura.id_factura=".$id;

			$result = mysqli_query($con, $q);
			$result2 = mysqli_query($con, $q2);

			if($result AND mysqli_num_rows($result)>0){
				require_once('../fpdf/fpdf.php');
				$pdf=new FPDF('P','mm','A4');
				$pdf->AddPage();
				$pdf->SetFont('Arial','B',14);

				while($row = mysqli_fetch_assoc($result)) {
					foreach($row as $column=>$value) {
						$valor = $value;
						if(strpos($column, "fecha") !== false){
							$fecha_temp = date_create_from_format('Y-m-d', $value);
							$valor = date_format($fecha_temp, 'd/m/Y');
						}
						if(strpos($column, "importe") !== false  || 
								strpos($column, "pendiente") !== false){
							$valor =number_format($value, 2, ',', '.');
						}
      					$cont = "$column:$valor\n";		
						$str = iconv('UTF-8', 'windows-1252', $cont);
						$pdf->MultiCell(0,10,$str);
    				}
				}
				$pdf->MultiCell(0,10,"*********************************************");
				if($result2 AND mysqli_num_rows($result2)>0){
					while($row = mysqli_fetch_assoc($result2)) {
						foreach($row as $column=>$value) {
							$valor = $value;
							if(strpos($column, "precio") !== false ||
									strpos($column, "total") !== false){
								$valor =number_format($value, 2, ',', '.');
							}
	      					$cont = "$column:$valor\n";		
							$str = iconv('UTF-8', 'windows-1252', $cont);
							$pdf->MultiCell(0,10,$str);
	    				}
	    				$pdf->MultiCell(0,10,"___________________________________________");
	    			}
				}
				
				$pdf->Output();
			} else {
				echo ERROR_CONSULTA;
			}
			mysqli_close($con);
		} else{
			echo FALTAN_PARAMETROS;
		}
	}
?> 