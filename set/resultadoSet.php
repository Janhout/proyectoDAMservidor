<?php
	$result = mysqli_query($con, $q);
	$editadas = mysqli_affected_rows($con);
	if($result && $editadas>0){
		echo ENTRADA_EDITADA;
	} else if ($result && $editadas<1){
		echo NADA_QUE_EDITAR;
	} else {
		echo ERROR_EDITAR_ENTRADA;
	}
	mysqli_close($con);
?>