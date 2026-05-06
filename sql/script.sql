-- ======================================
-- CREAR BASE DE DATOS
-- ======================================
CREATE DATABASE gestion_genshin;
USE gestion_genshin;

-- ======================================
-- TABLAS PRINCIPALES
-- ======================================
CREATE TABLE Usuarios (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

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

CREATE TABLE Versiones (
    idVersion INT AUTO_INCREMENT PRIMARY KEY,
    numero VARCHAR(10) NOT NULL UNIQUE
);

CREATE TABLE Banners (
    idBanner INT AUTO_INCREMENT PRIMARY KEY,
    idVersion INT NOT NULL,
    numero_banner TINYINT NOT NULL,
    fecha_inicio DATE,
    fecha_fin DATE,
    activo BOOLEAN DEFAULT FALSE,
    UNIQUE (idVersion, numero_banner),
    FOREIGN KEY (idVersion) REFERENCES Versiones(idVersion)
);

CREATE TABLE BannerPersonajes (
    idBanner INT NOT NULL,
    idPersonaje INT NOT NULL,
    PRIMARY KEY (idBanner, idPersonaje),
    FOREIGN KEY (idBanner) REFERENCES Banners(idBanner) ON DELETE CASCADE,
    FOREIGN KEY (idPersonaje) REFERENCES Personajes(idPersonaje)
);