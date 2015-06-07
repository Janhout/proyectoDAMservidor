<?php
	$info = "";
	if(isset($_POST['submit'])){
		if(isset($_POST['contacto_nombre']) && isset($_POST['contacto_email']) && 
			isset($_POST['contacto_mensaje'])){
			$info = "Datos enviados correctamente";
			require_once('constantes.php');
			require_once("conexion.php");

			$email = mysqli_real_escape_string($con, $_POST['contacto_email']);
			$nombre = mysqli_real_escape_string($con, $_POST['contacto_nombre']);
			$mensaje = mysqli_real_escape_string($con, $_POST['contacto_mensaje']);
			
			$q = "INSERT INTO contacto(email, nombre, mensaje)
				  VALUES('".$email."', '".$nombre."', '".$mensaje."')";
			
			$result = mysqli_query($con, $q) or die(mysqli_error($con));

			$body =
				" <html> 
					  <head> 
						  <title>Contacto proyectodam2015</title> 
					  </head> 
					  <body>
					  	  <p>Hola, ".$nombre.":</p>
						  <p>He recibido su mensaje. Le contestaré con la mayor brevedad posible
						  a ".$email.".</p>
						  <p>Saludos</p>
						  <p>Rafael Gómez Rodríguez</p> 
					  </body> 
				  </html>"; 

			require_once 'swiftmailer/lib/swift_required.php';

			$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
	                        ->setUsername('proyectodam2015@gmail.com')
	                        ->setPassword('proyecto2015');

	        $message = Swift_Message::newInstance()
							->setTo(array($email => $nombre,))
							->setSubject("Contacto ProyectoDAM")
							->addPart($body, 'text/html')
	    					->setFrom("proyectodam2015@gmail.com", "Rafael Gómez Rodríguez");
	    	try {
	    		$mailer = Swift_Mailer::newInstance($transport);
	    		$mailer->send($message);
	    	} catch(Exception $e){
	    		echo $e;
	    	}
		}
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<title>SERVIDOR PROYECTO DAM</title>
</head>
<body>
	<div class="container col-md-12">
		<div class="container text-center">
			<h1>SERVIDOR - <small>Proyecto DAM</small></h1>
			<h4>Proximamente habrá una versión WEB disponible</h4>
			<h3>Formulario de contacto</h3>
		</div>
		<div class="container col-md-6 col-md-offset-3">
			<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" role="form">
				<div class="form-group">
					<label for="contacto_email">Email:</label>
					<input type="email" class="form-control" id="contacto_email" name="contacto_email" placeholder="Introduce email de contacto" maxlength="50" required />
				</div>
				<div class="form-group">
					<label for="contacto_nombre">Nombre:</label>
					<input type="text" class="form-control" id="contacto_nombre" name="contacto_nombre" placeholder="Introduce tu nombre" maxlength="50" required />
				</div>
				<div class="form-group">
					<label for="contacto_mensaje">Mensaje:</label>
					<textarea class="form-control" id="contacto_mensaje" name="contacto_mensaje" placeholder="¿Qué me quieres contar?" maxlength="250" rows="6" required ></textarea>
				</div>
				<div class="text-center"> 
					<button type="submit" id="submit" name="submit" class="btn btn-primary pull-right">Enviar</button>
				</div>
			</form>
		</div>

		<div class="container col-md-6 col-md-offset-3">
			<?php
				echo "<p class='text-info'>".$info."</p>";
			?>
		</div>
	</div>
</body>
</html>