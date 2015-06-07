DROP DATABASE IF EXISTS proyectodam;
CREATE DATABASE proyectodam DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
USE proyectodam;

CREATE TABLE IF NOT EXISTS contacto(
	id_contacto INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	email VARCHAR(50),
	nombre VARCHAR(50),
	mensaje VARCHAR(250)
);

CREATE TABLE IF NOT EXISTS provincia(
	id_provincia INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	provincia VARCHAR(3) NOT NULL,
	titulo VARCHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS localidad(
	id_localidad INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	id_provincia INT UNSIGNED NOT NULL,
	localidad VARCHAR(80) NOT NULL,
	titulo VARCHAR(80) NOT NULL,
	codigo_postal VARCHAR(5) NOT NULL,

	CONSTRAINT fk_localidad_provincia_id_provincia  FOREIGN KEY (id_provincia) REFERENCES provincia(id_provincia) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS tipoDireccion(
	id_tipo_direccion INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	tipo VARCHAR(4) NOT NULL,
	titulo VARCHAR(30) NOT NULL
);

CREATE TABLE IF NOT EXISTS usuario(
	id_usuario INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	usuario VARCHAR(30) NOT NULL,
	nif VARCHAR(9) NOT NULL,
	email VARCHAR(30) NOT NULL,
	password VARCHAR(30) NOT NULL,
	nombre_empresa VARCHAR(50) NOT NULL,

	UNIQUE(usuario),
	UNIQUE(nombre_empresa)
);

CREATE TABLE IF NOT EXISTS cliente(
	id_cliente INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	id_usuario INT UNSIGNED NOT NULL,
	nombre_comercial VARCHAR(50) NOT NULL,
	nif VARCHAR(9) NOT NULL,
	telefono01 VARCHAR(12) DEFAULT "",
	telefono02 VARCHAR(12) DEFAULT "",
	email VARCHAR(30) DEFAULT "",
	favorito BIT(1) DEFAULT 0,
	direccion VARCHAR(150) DEFAULT "",
	numero_cuenta VARCHAR(25) DEFAULT "0000 0000 00 0000000000",

	CONSTRAINT fk_cliente_usuario_id_usuario  FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON DELETE CASCADE,

	UNIQUE(nif, nombre_comercial, id_usuario)
);

CREATE TABLE IF NOT EXISTS factura(
	id_factura INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	id_cliente INT UNSIGNED NOT NULL,
	numero VARCHAR(50) NOT NULL,
	fecha DATE NOT NULL,
	fecha_vencimiento DATE NOT NULL,
	estado VARCHAR(15) DEFAULT "borrador",
	pendiente VARCHAR(20) NOT NULL,
	printed INT DEFAULT 0,
	sent INT DEFAULT 0,
	notas VARCHAR(150) DEFAULT "",

	CONSTRAINT fk_factura_cliente_id_cliente  FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS producto(
	id_producto INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	id_usuario INT UNSIGNED NOT NULL,
	nombre_producto VARCHAR(40) NOT NULL,
	referencia_producto VARCHAR(20) NOT NULL,
	descripcion VARCHAR(100) DEFAULT "",
	precio_coste DOUBLE NOT NULL,
	precio_venta DOUBLE NOT NULL,
	tipo_iva DOUBLE DEFAULT 21,

	UNIQUE(id_usuario, referencia_producto),
	CONSTRAINT fk_producto_usuario_id_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS productoFactura(
	id_producto_factura INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	id_factura INT UNSIGNED NOT NULL,
	id_producto INT UNSIGNED NOT NULL,
	cantidad INT DEFAULT 1,

	CONSTRAINT fk_productoFactura_factura_id_factura FOREIGN KEY (id_factura) REFERENCES factura(id_factura) ON DELETE CASCADE,
	CONSTRAINT fk_productoFactura_producto_id_producto FOREIGN KEY (id_producto) REFERENCES producto(id_producto) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS gasto(
	id_gasto INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	id_usuario INT UNSIGNED NOT NULL,
	concepto VARCHAR(50) NOT NULL,
	importe DOUBLE NOT NULL,
	fecha DATE NOT NULL,
	detalles VARCHAR(200) DEFAULT "",
	foto VARCHAR(200) DEFAULT "",
	tipo_iva DOUBLE DEFAULT 21,

	CONSTRAINT fk_gasto_usuario_id_usuario  FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON DELETE CASCADE
);