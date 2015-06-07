<?php
	require_once("constantes.php");
	if(!isset($_POST['usuario'])){
		echo FALTAN_PARAMETROS;
	} else{
		require_once("conexion.php");

		$usuario = mysqli_real_escape_string($con, $_POST["usuario"]);   

		$q = "SELECT * FROM usuario WHERE usuario='".$usuario."'";
		$result = mysqli_query($con, $q) or die(mysqli_error($con));

		if(mysqli_num_rows($result)==1){
			session_start();
			$row = mysqli_fetch_array($result);
			$destinatario = $row['email'];
			$password = $row['password'];

			$body =
				" <html> 
					  <head> 
						  <title>Recuperar pass</title> 
					  </head> 
					  <body>
					  	  <p>Hola, ".$usuario.":</p>
						  <p>Tu contraseña es ".$password."</p> 
					  </body> 
				  </html>"; 

			require_once 'swiftmailer/lib/swift_required.php';

			$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
	                        ->setUsername('proyectodam2015@gmail.com')
	                        ->setPassword('proyecto2015');

	        $message = Swift_Message::newInstance()
							->setTo(array($destinatario => $usuario,))
							->setSubject("Recuperar Password ProyectoDAM")
							->addPart($body, 'text/html')
	    					->setFrom("proyectodam2015@gmail.com", "Rafael Gómez Rodríguez");
	    	try {
	    		$mailer = Swift_Mailer::newInstance($transport);
	    		$mailer->send($message);
	    		echo PETICION_CORRECTA;
	    	} catch(Exception $e){
	    		echo ERROR_EMAIL;
	    	}
		} else {
			echo ERROR_CONSULTA;
		}
		mysqli_close($con);
	}
?>