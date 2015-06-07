<?php
	require_once('constantes.php');
	session_start();
	if(!isset($_SESSION['usuario']) || !isset($_SESSION['id_usuario'])) {
  		echo SESION_EXPIRADA;
	} else {
  		$_SESSION = array();
  		if (ini_get("session.use_cookies")) {
    		$params = session_get_cookie_params();
    		setcookie(session_name(), '', time() - 42000,
        		$params["path"], $params["domain"],
        		$params["secure"], $params["httponly"]);
		}
  		session_destroy();
  		echo SESION_CERRADA;
	}
	exit();
?>