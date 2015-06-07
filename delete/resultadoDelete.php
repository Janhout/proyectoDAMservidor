<?php
	$result = mysqli_query($con, $q);
	$borradas = mysqli_affected_rows($con);
	if($result && $borradas>0){
		echo ENTRADA_BORRADA;
	} else if ($result && $borradas<1){
		echo NADA_QUE_BORRAR;
	} else {
		echo ERROR_BORRAR_ENTRADA;
	}
	mysqli_close($con);
?>