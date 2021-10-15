CREATE DATABASE PF_GE;
USE PF_GE;

CREATE TABLE IF NOT EXISTS  MATERIALES  (
    material_id int(11) NOT NULL AUTO_INCREMENT,
    tipo ENUM('Regalo','Utileria'),
    nombre varchar(30),
    actividad int DEFAULT NULL,
    cantidad int(11) DEFAULT 1,
    costo float DEFAULR 0.00,
    costoT float DEFAULT 0.00,
    dirigido ENUM('Participante','Ambiente','Expositor') NOT NULL,
    PRIMARY KEY(material_id)
)ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT 10000;

INSERT INTO MATERIALES (tipo,nombre,actividad,cantidad,costo,dirigido) 
VALUES
('Regalo','Gorro de la marca X',NULL,20,15.00,'Participante'),
('Utileria','Globos de Color Rojo',NULL,20,1.20,'Ambiente');

UPDATE materiales SET costoT = costo*cantidad;
SELECT * FROM materiales;

CREATE TABLE IF NOT EXISTS AMBIENTES (
    ambiente_id int(11) NOT NULL AUTO_INCREMENT,
    tipo varchar(30),
    nombre varchar(30),
    hora varchar(30),
    fecha varchar(30),
    ubicacion varchar(30),
    capacidad int,
    actividad int DEFAULT 1,
    PRIMARY KEY(ambiente_id)
)ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT 20000;

INSERT INTO AMBIENTES (tipo,nombre,hora,fecha,ubicacion,capacidad,actividad) 
VALUES
('Tipo1','XXXXXXXXXX','00:00','12/12/2012','Ubicacion X',200,'Actividad X'),
('Tipo2','YYYYYYYYYY','00:00','12/12/2012','Ubicacion Y',100,'Actividad Y');

CREATE TABLE IF NOT EXISTS ACTIVIDADES(
    actividad_id INT NOT NULL AUTO_INCREMENT,
    tipo varchar(30),
    nombre varchar(30),
    hora varchar(30),
    fecha varchar(30),
    expositor varchar(30),
    ambiente varchar(30),
    PRIMARY KEY(actividad_id)
)ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT 30000;

INSERT INTO ACTIVIDADES(tipo,nombre,hora,fecha,expositor,ambiente)
VALUES 
    ('Tipo1','XXXXXXXXXX','00:00','12/12/2012','Expositor1','Ambiente 1'),
    ('Tipo2','YYYYYYYYYY','00:00','12/12/2012','Expositor2','Ambiente 2');

CREATE TABLE IF NOT EXISTS EVENTOS(
    evento_id int(11) NOT NULL AUTO_INCREMENT,
    titulo varchar(30),
    descripcion varchar(30),
    categoria varchar(30),
    fecha varchar(30),
    tipo varchar(30),
    PRIMARY KEY(evento_id)
)ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT 40000;

INSERT INTO EVENTOS(titulo,descripcion,categoria,fecha,tipo)
VALUES 
    ('Evento 1','Descripcion del Evento 1','Categoria 1','12/12/2012','Tipo 1'),
    ('Evento 2','Descripcion del Evento 2','Categoria 2','12/12/2012','Tipo 2');
