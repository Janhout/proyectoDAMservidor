<?php
	$result = mysqli_query($con, $q);

	if($result){
		$rows = array();
		while($row = mysqli_fetch_assoc($result)) {
			//$rows[] = array_map('utf8_encode', $row);
			$rows[] = $row;
		}
		print json_encode($rows);
	} else {
		echo ERROR_CONSULTA;
	}
	mysqli_close($con);
?>