# Script Creacion Entidades
CREATE TABLE db_paraisoTico.Rol (
    id_rol INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(10) NOT NULL,
    activo BOOLEAN NOT NULL
) ENGINE = InnoDB;

CREATE TABLE db_paraisoTico.Usuario (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(25) NOT NULL UNIQUE,
    password VARCHAR(60) NOT NULL,
    nombre VARCHAR(25) NOT NULL,
    primer_apellido VARCHAR(25) NOT NULL,
    correo VARCHAR(50) NOT NULL,
    telefono VARCHAR(15),
    ruta_imagen VARCHAR(1022),
    activo BOOLEAN NOT NULL
    id_rol INT;
) ENGINE = InnoDB;

CREATE TABLE db_paraisoTico.Usuarios_Roles (
    id_rol INT NOT NULL,
    id_usuario INT NOT NULL,
    PRIMARY KEY (id_rol, id_usuario),
    FOREIGN KEY (id_rol) REFERENCES Rol(id_rol),
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario)
) ENGINE = InnoDB;

CREATE TABLE db_paraisoTico.Blog (
    id_blog INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(100) NOT NULL,
    contenido VARCHAR(1022),
    fecha_publicacion DATE NOT NULL,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario)
) ENGINE = InnoDB;

CREATE TABLE db_paraisoTico.Categorias (
    id_categorias INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    activo BOOLEAN NOT NULL,
    PRIMARY KEY (id_categorias)
) ENGINE = InnoDB;

CREATE TABLE db_paraisoTico.Provincias (
    id_provincias INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    activo BOOLEAN NOT NULL DEFAULT TRUE,
    PRIMARY KEY (id_provincias)
) ENGINE = InnoDB;

CREATE TABLE db_paraisoTico.Canton (
    id_canton INT NOT NULL AUTO_INCREMENT,
    id_provincias INT NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    activo BOOLEAN NOT NULL DEFAULT TRUE,
    PRIMARY KEY (id_canton),
    CONSTRAINT fk_canton_provincia
        FOREIGN KEY (id_provincias) REFERENCES Provincias(id_provincias)
) ENGINE = InnoDB;

CREATE TABLE db_paraisoTico.Actividades (
    id_actividad INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    descripcion VARCHAR(255),
    precio DECIMAL(10,2),
    punto_encuentro VARCHAR(100),
    descripcion_incluye VARCHAR(500),
    id_categorias INT NOT NULL,
    id_canton INT NOT NULL,
    foto VARCHAR(2000),
    activo BOOLEAN NOT NULL,
    PRIMARY KEY (id_actividad),
    CONSTRAINT fk_act_categoria
        FOREIGN KEY (id_categorias) REFERENCES Categorias(id_categorias),
    CONSTRAINT fk_act_canton
        FOREIGN KEY (id_canton) REFERENCES Canton(id_canton)
) ENGINE = InnoDB;

CREATE TABLE db_paraisoTico.Ofertas (
    id_oferta INT NOT NULL AUTO_INCREMENT,
    descripcion VARCHAR(50) NOT NULL,
    descuento DECIMAL(5,2) NOT NULL,
    fecha_publicacion DATE NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    activo BOOLEAN NOT NULL,
    PRIMARY KEY (id_oferta)
) ENGINE = InnoDB;

CREATE TABLE Reservas (
    id_reserva INT NOT NULL AUTO_INCREMENT,
    id_usuario INT NOT NULL, 
    id_actividad INT NOT NULL,
    id_oferta INT NULL,
    fecha_reserva DATETIME NOT NULL,
    fecha_actividad DATETIME NOT NULL,
    activo boolean NOT NULL,
    PRIMARY KEY (id_reserva),
    CONSTRAINT fk_reserva_actividad
        FOREIGN KEY (id_actividad) REFERENCES Actividades(id_actividad),
    CONSTRAINT fk_reserva_oferta
        FOREIGN KEY (id_oferta) REFERENCES Ofertas(id_oferta)
) ENGINE = InnoDB;

CREATE TABLE mensajes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    asunto VARCHAR(150) NOT NULL,
    mensaje TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
