<?php
	$result = mysqli_query($con, $q);
	
	if($result){
		echo mysqli_insert_id($con);
	} else {
		echo ERROR_INSERTAR_ENTRADA;
	}
	mysqli_close($con);
?>