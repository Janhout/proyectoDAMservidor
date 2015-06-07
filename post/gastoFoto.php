<?php
	require_once("../constantes.php");
	session_start();
	if(!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
  		echo SESION_EXPIRADA;
  		exit();
	} else {
		$error = false;
		$path = RUTA_GASTOS.$_SESSION['id_usuario'];
	    
	    $file_path = $path."/".basename($_FILES['fichero']['name']);
		if (!is_dir($path)) {
	    	mkdir($path, 0777, true);
		}
		require_once("../conexion.php");
	    $id_gasto = substr($_FILES['fichero']['name'], 0,  strlen($_FILES['fichero']['name'])-4);
	    if(move_uploaded_file($_FILES['fichero']['tmp_name'], $file_path)) {
	        @unlink($_FILES['foto']['tmp_name']);
	        
	        $q = "UPDATE gasto 
				   SET foto='".$file_path."'
				   WHERE id_usuario=".$_SESSION['id_usuario']." AND id_gasto=".$id_gasto;

			$result = mysqli_query($con, $q);
			$editadas = mysqli_affected_rows($con);

			if($result && $editadas>0){
				echo PETICION_CORRECTA;
			} else {
				echo ERROR_FOTO;
				$error = true;
			}
			
	    } else{
	        echo ERROR_FOTO;
	        $error = true;
	    }

	    if($error == true){
	    	$q = "DELETE
	    		  FROM gasto
				  WHERE id_usuario=".$_SESSION['id_usuario']." AND id_gasto=".$id_gasto;
	    }
	    mysqli_close($con);
	}
 ?>