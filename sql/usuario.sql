CREATE TABLE mydatabase.usuarios (
	usuario_id varchar(20) NOT NULL,
	nombre varchar(50) NOT NULL,
	password varchar(50) NOT NULL,
	CONSTRAINT usuarios_PK PRIMARY KEY (usuario_id)
)
ENGINE=InnoDB
DEFAULT CHARSET=latin1
COLLATE=latin1_swedish_ci;
