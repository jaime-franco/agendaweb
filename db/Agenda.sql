create database Agenda;

use  Agenda;

create table Usuario(
id_usuario int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
nombre varchar(30),  
clave varchar(64), 
salt varchar(64),  
tipo tinyint,
estado tinyint
);

create table Contacto(
id_contacto int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_usuario int(11) NOT NULL,
nombres varchar(50),
apellidos varchar(50),
direccion varchar(255),
tel_trabajo varchar(20),
tel_movil varchar(20),
correo varchar(30),
FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario) ON DELETE CASCADE
);

