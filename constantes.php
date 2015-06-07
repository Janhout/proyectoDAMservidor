<?php 

/*Constantes conexión base de datos*/
	/*define("DB_SERVER", getenv('OPENSHIFT_MYSQL_DB_HOST'));
	define("DB_USER", getenv('OPENSHIFT_MYSQL_DB_USERNAME'));
	define("DB_PASSWORD", getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
	define("DB_DATABASE", getenv('OPENSHIFT_APP_NAME'));*/

	define("DB_SERVER", "localhost");
	define("DB_USER", "root");
	define("DB_PASSWORD", "");
	define("DB_DATABASE", "proyectodam");

/*Otras*/
	define("RUTA_GASTOS", "../gastos/");

/*Códigos de respuesta*/
	define("LOGIN_INCORRECTO", "r0");
	define("LOGIN_CORRECTO", "r1");
	define("SESION_EXPIRADA", "r2");
	define("SESION_CERRADA", "r3");
	define("ERROR_INSERTAR_ENTRADA", "r4");
	define("ENTRADA_BORRADA", "r5");
	define("ERROR_BORRAR_ENTRADA", "r6");
	define("NADA_QUE_BORRAR", "r7");
	define("ERROR_CONSULTA", "r8");
	define("ERROR_CONEXION_BD", "r9");
	define("FALTAN_PARAMETROS", "r10");
	define("PETICION_CORRECTA", "r11");
	define("NADA_QUE_EDITAR", "r12");
	define("ENTRADA_EDITADA", "r13");
	define("ERROR_EDITAR_ENTRADA", "r14");
	define("CLIENTE_EXISTENTE", "r15");
	define("PRODUCTO_EXISTENTE", "r16");
	define("ERROR_EMAIL", "r17");
	define("ERROR_FOTO", "r18");

	define("CORRECTO", "ok");
?>