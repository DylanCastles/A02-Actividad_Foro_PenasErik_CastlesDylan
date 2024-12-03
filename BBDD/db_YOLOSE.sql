-- Creación de la base de datos
DROP DATABASE IF EXISTS db_YOLOSE;
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
    titulo_post VARCHAR(50) NULL,
    contenido_post VARCHAR(500) NOT NULL,
    fecha_post DATETIME NOT NULL,
    user_post VARCHAR(30) NOT NULL,
    ref_post INT NULL
);

-- Añadir FK
ALTER TABLE tbl_POST 
ADD CONSTRAINT FK_POST_USER
FOREIGN KEY(user_post) REFERENCES tbl_USERS(id_user);

INSERT INTO tbl_USERS (id_user, nombre_user, apellido_user, email_user, desc_user, pwd_user) VALUES -- CONTRASEÑA QWEqwe123
('user001', 'Juan', 'Pérez', 'juan.perez@example.com', 'Amante de la tecnología', '$2b$12$tk/4lrZlKZbyxgFxNDWTfOrMlRdhcZLCsC41.HUJ6FDWGUmLRGnIa'),
('user002', 'María', 'García', 'maria.garcia@example.com', 'Apasionada por el arte', '$2b$12$tk/4lrZlKZbyxgFxNDWTfOrMlRdhcZLCsC41.HUJ6FDWGUmLRGnIa'),
('user003', 'Carlos', 'López', 'carlos.lopez@example.com', 'Experto en programación', '$2b$12$tk/4lrZlKZbyxgFxNDWTfOrMlRdhcZLCsC41.HUJ6FDWGUmLRGnIa'),
('user004', 'Ana', 'Martínez', 'ana.martinez@example.com', 'Fan de los videojuegos', '$2b$12$tk/4lrZlKZbyxgFxNDWTfOrMlRdhcZLCsC41.HUJ6FDWGUmLRGnIa'),
('user005', 'Pedro', 'Hernández', 'pedro.hernandez@example.com', 'Curioso y creativo', '$2b$12$tk/4lrZlKZbyxgFxNDWTfOrMlRdhcZLCsC41.HUJ6FDWGUmLRGnIa');

INSERT INTO tbl_POST (titulo_post, contenido_post, fecha_post, user_post, ref_post) VALUES
('Lenguaje de Programación', '¿Cuál es el mejor lenguaje de programación para empezar?', '2024-11-21 10:00:00', 'user003', NULL),
('Técnica Artística', '¿Qué técnica artística recomiendan para principiantes?', '2024-11-21 11:30:00', 'user002', NULL),
('Mejor Juego del Año', '¿Cuál es el mejor juego del año?', '2024-11-21 12:15:00', 'user004', NULL),
('Optimización de Computadoras', '¿Cómo optimizar el rendimiento de mi computadora?', '2024-11-21 13:45:00', 'user001', NULL),
('Libro de Diseño', '¿Qué libro recomendarían para aprender diseño?', '2024-11-21 15:20:00', 'user005', NULL);

INSERT INTO tbl_POST (contenido_post, fecha_post, user_post, ref_post) VALUES
('Python es un excelente punto de partida por su simplicidad y comunidad activa.', '2024-11-21 10:30:00', 'user001', 1),
('El carboncillo es ideal para empezar porque es económico y versátil.', '2024-11-21 12:00:00', 'user005', 2),
('Definitivamente el mejor juego del año es Zelda: Tears of the Kingdom.', '2024-11-21 12:45:00', 'user003', 3),
('Asegúrate de limpiar los archivos temporales y aumentar la RAM.', '2024-11-21 14:00:00', 'user004', 4),
('Recomiendo "Don’t Make Me Think" de Steve Krug, es un clásico del diseño.', '2024-11-21 15:45:00', 'user002', 5);
