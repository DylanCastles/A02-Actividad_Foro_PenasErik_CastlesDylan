-- Creación de la base de datos
CREATE DATABASE db_YOLOSE;
USE db_YOLOSE;

-- Creación de las tablas
CREATE TABLE tbl_USERS (
    id_user VARCHAR(30) PRIMARY KEY NOT NULL,
    nombre_user VARCHAR(50) NOT NULL,
    apellido_user VARCHAR(50) NOT NULL,
    email_user VARCHAR(50) NOT NULL UNIQUE,
    desc_user VARCHAR(100) NULL,
    pwd_user CHAR(60) NOT NULL
);

CREATE TABLE tbl_POST (
    id_post INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    contenido_post TEXT NOT NULL,
    fecha_post DATETIME NOT NULL,
    user_post VARCHAR(30) NOT NULL,
    ref_post INT NULL,
    votos_post INT NULL
);

-- Añadir FK
ALTER TABLE tbl_POST 
ADD CONSTRAINT FK_POST_USER
FOREIGN KEY(user_post) REFERENCES tbl_USERS(id_user);