

-- Tabla para USUARIO, en esta tabla se consigna la información para la creación del usuario y datos para el ingreso al blog

CREATE TABLE usuarios (
    UserID INT PRIMARY KEY,
    Nombre VARCHAR(50),
    Email VARCHAR(50) UNIQUE,
    Contraseña VARCHAR(50)
);

INSERT INTO Usuarios (Nombre, Email, Contraseña) VALUES
('Usuario1', 'usuario1@email.com', 'contrasena1'),
('Usuario2', 'usuario2@email.com', 'contrasena2'),
('Usuario3', 'usuario3@email.com', 'contrasena3'),
('Usuario4', 'usuario4@email.com', 'contrasena4'),
('Usuario5', 'usuario5@email.com', 'contrasena5'),
('Usuario6', 'usuario6@email.com', 'contrasena6'),
('Usuario7', 'usuario7@email.com', 'contrasena7'),
('Usuario8', 'usuario8@email.com', 'contrasena8'),
('Usuario9', 'usuario9@email.com', 'contrasena9'),
('Usuario10', 'usuario10@email.com', 'contrasena10');

-- Tabla para CATEGORIAS, en esta tabla se consigna la informacion sobre las categorias del blog

CREATE TABLE categorias (
    CategoriaID INT PRIMARY KEY,
    Nombre VARCHAR(50)
);

-- Tabla para publicaciones, en esta tabla se consignan las publicaciones realizadas por el creador del blog. Cada publicacion tiene un id
--para ser identificada dentro de la base, un titulo, un contenido, una fecha de publicacion, el autor y se asigna dentro de 
--una categoria. Se usan las llaves foraneas AUTOR y CATEGORIA pues estas pertenecesn originalmente a las tablas USUARIOS y PUBLICACIONES
--esto dado que es necesario consignar dicha informacion en la creacion o elaboracion de una publicacion 

CREATE TABLE publicaciones (
    PublicacionID INT PRIMARY KEY,
    Titulo VARCHAR(100),
    Contenido TEXT,
    FechaPublicacion DATE,
    AutorID INT,
    CategoriaID INT,
    FOREIGN KEY (AutorID) REFERENCES usuarios(UserID),
    FOREIGN KEY (CategoriaID) REFERENCES categorias(CategoriaID)
);

-- Tabla para comentarios

CREATE TABLE comentarios (
    ComentarioID INT PRIMARY KEY,
    Contenido TEXT,
    FechaComentario DATE,
    AutorID INT,
    PublicacionID INT,
    FOREIGN KEY (AutorID) REFERENCES usuarios(UserID),
    FOREIGN KEY (PublicacionID) REFERENCES publicaciones(PublicacionID)
);
