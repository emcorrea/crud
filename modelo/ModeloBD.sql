CREATE TABLE ALUMNO(
	rut INT(11),
	nombre VARCHAR(50),
	apellidoPaterno VARCHAR(50),
	apellidoMaterno VARCHAR(50),
	sexo CHAR(1),
	fechaNacimiento DATE,
	domicilio VARCHAR(255),
	telefono INT(11),
	PRIMARY KEY(rut)
);

CREATE TABLE MATRICULA(
	codigoMatricula INT(11) AUTO_INCREMENT,
	rutAlumno INT(11),
	curso INT(11),
	nombreApoderado VARCHAR(255),
	fechaMatricula DATETIME,
	PRIMARY KEY(codigoMatricula),
	FOREIGN KEY(rutAlumno) REFERENCES ALUMNO(rut)
);

CREATE TABLE EJECUTIVO(
	rutEjecutivo INT(11),
	nombreEjecutivo VARCHAR(100),
	activo CHAR(1) NOT NULL DEFAULT 1,
	PRIMARY KEY(rutEjecutivo)
);