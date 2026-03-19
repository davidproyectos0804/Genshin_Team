-- ======================================
-- CREAR BASE DE DATOS
-- ======================================
CREATE DATABASE gestion_genshin;
USE gestion_genshin;

-- ======================================
-- TABLA USUARIOS
-- ======================================
CREATE TABLE Usuarios (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

-- ======================================
-- TABLAS PRINCIPALES
-- ======================================

CREATE TABLE Elementos (
    idElemento INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    foto VARCHAR(255)
);

CREATE TABLE Armas (
    idArma INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    foto VARCHAR(255)
);

CREATE TABLE EstadisticasAscension (
    idEstadistica INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    foto VARCHAR(255)
);

CREATE TABLE Banners (
    idBanner INT AUTO_INCREMENT PRIMARY KEY,
    version VARCHAR(20) NOT NULL,
    fecha_inicio DATE,
    fecha_fin DATE
);

CREATE TABLE Personajes (
    idPersonaje INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    foto VARCHAR(255),
    rareza INT CHECK (rareza IN (4, 5)),
    idElemento INT NOT NULL,
    idArma INT NOT NULL,
    idEstadistica INT NOT NULL,

    FOREIGN KEY (idElemento) REFERENCES Elementos(idElemento),
    FOREIGN KEY (idArma) REFERENCES Armas(idArma),
    FOREIGN KEY (idEstadistica) REFERENCES EstadisticasAscension(idEstadistica)
);

CREATE TABLE Equipos (
    idEquipo INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    idUsuario INT,
    FOREIGN KEY (idUsuario) REFERENCES Usuarios(idUsuario)
);

-- ======================================
-- RELACIONES M:N
-- ======================================

-- Equipo ↔ Personajes (con posición)
CREATE TABLE Equipo_Personaje (
    idEquipo INT,
    idPersonaje INT,
    posicion INT,
    PRIMARY KEY (idEquipo, idPersonaje),
    FOREIGN KEY (idEquipo) REFERENCES Equipos(idEquipo),
    FOREIGN KEY (idPersonaje) REFERENCES Personajes(idPersonaje),
    UNIQUE (idEquipo, posicion)
);

-- Banner ↔ Personajes
CREATE TABLE Banner_Personaje (
    idBanner INT,
    idPersonaje INT,
    PRIMARY KEY (idBanner, idPersonaje),
    FOREIGN KEY (idBanner) REFERENCES Banners(idBanner),
    FOREIGN KEY (idPersonaje) REFERENCES Personajes(idPersonaje)
);