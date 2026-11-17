-- --------------------------------------------------------
-- Host:                         10.1daw.esvirgua.com
-- Versión del servidor:         8.0.46 - MySQL Community Server - GPL
-- SO del servidor:              Linux
-- HeidiSQL Versión:             12.21.0.7344
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para user1daw_BD1-10
CREATE DATABASE IF NOT EXISTS `user1daw_BD1-10` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `user1daw_BD1-10`;

-- Volcando estructura para tabla user1daw_BD1-10.asignatura
CREATE TABLE IF NOT EXISTS `asignatura` (
  `clase` varchar(10) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `profesor` varchar(30) NOT NULL,
  PRIMARY KEY (`clase`,`nombre`),
  KEY `profesor` (`profesor`),
  CONSTRAINT `asignatura_ibfk_1` FOREIGN KEY (`clase`) REFERENCES `clase` (`nombre`),
  CONSTRAINT `asignatura_ibfk_2` FOREIGN KEY (`profesor`) REFERENCES `profesor` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla user1daw_BD1-10.asignatura: ~20 rows (aproximadamente)
INSERT INTO `asignatura` (`clase`, `nombre`, `profesor`) VALUES
	('1DAW', 'BASES DE DATOS', 'Pablo'),
	('1DAW', 'LENGUAJES DE MARCAS', 'Laura'),
	('1DAW', 'PROGRAMACIÓN', 'Marta'),
	('1DAW', 'SISTEMAS', 'Javier'),
	('1SMR', 'MONTAJE', 'Pablo'),
	('1SMR', 'REDES', 'Javier'),
	('1SMR', 'SISTEMAS', 'Marta'),
	('2DAW', 'CLIENTE', 'Alberto'),
	('2DAW', 'DESPLIEGUE', 'Ernesto'),
	('2DAW', 'DIGIT.', 'Alberto'),
	('2DAW', 'IP', 'Luis'),
	('2DAW', 'OPT. 1', 'Luis'),
	('2DAW', 'OPT. 2', 'Alberto'),
	('2DAW', 'PIMOD', 'Ernesto'),
	('2DAW', 'SERVIDOR', 'Isabel'),
	('2DAW', 'SOST.', 'Santi'),
	('2DAW', 'TUTORÍA', 'Alberto'),
	('2SMR', 'EMPRESA', 'Santi'),
	('2SMR', 'SEGURIDAD', 'Javier'),
	('2SMR', 'SERVICIOS', 'Laura');

-- Volcando estructura para tabla user1daw_BD1-10.clase
CREATE TABLE IF NOT EXISTS `clase` (
  `nombre` varchar(10) NOT NULL,
  PRIMARY KEY (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla user1daw_BD1-10.clase: ~4 rows (aproximadamente)
INSERT INTO `clase` (`nombre`) VALUES
	('1DAW'),
	('1SMR'),
	('2DAW'),
	('2SMR');

-- Volcando estructura para tabla user1daw_BD1-10.horario
CREATE TABLE IF NOT EXISTS `horario` (
  `clase` varchar(10) NOT NULL,
  `dia` int NOT NULL,
  `hora` int NOT NULL,
  `asignatura` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`clase`,`dia`,`hora`),
  KEY `clase` (`clase`,`asignatura`),
  CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`clase`, `asignatura`) REFERENCES `asignatura` (`clase`, `nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla user1daw_BD1-10.horario: ~31 rows (aproximadamente)
INSERT INTO `horario` (`clase`, `dia`, `hora`, `asignatura`) VALUES
	('2DAW', 1, 1, 'IP'),
	('2DAW', 1, 2, 'SERVIDOR'),
	('2DAW', 1, 3, 'SERVIDOR'),
	('2DAW', 1, 4, 'PIMOD'),
	('2DAW', 1, 5, 'PIMOD'),
	('2DAW', 1, 6, 'CLIENTE'),
	('2DAW', 1, 7, 'CLIENTE'),
	('2DAW', 2, 1, 'CLIENTE'),
	('2DAW', 2, 2, 'CLIENTE'),
	('2DAW', 2, 3, 'SERVIDOR'),
	('2DAW', 2, 4, 'SERVIDOR'),
	('2DAW', 2, 5, 'PIMOD'),
	('2DAW', 2, 6, 'DESPLIEGUE'),
	('2DAW', 3, 1, 'IP'),
	('2DAW', 3, 2, 'CLIENTE'),
	('2DAW', 3, 3, 'CLIENTE'),
	('2DAW', 3, 4, 'SERVIDOR'),
	('2DAW', 3, 5, 'DESPLIEGUE'),
	('2DAW', 3, 6, 'DESPLIEGUE'),
	('2DAW', 4, 1, 'SERVIDOR'),
	('2DAW', 4, 2, 'SERVIDOR'),
	('2DAW', 4, 3, 'SERVIDOR'),
	('2DAW', 4, 4, 'SOST.'),
	('2DAW', 4, 5, 'OPT. 1'),
	('2DAW', 4, 6, 'IP'),
	('2DAW', 5, 1, 'OPT. 2'),
	('2DAW', 5, 2, 'TUTORÍA'),
	('2DAW', 5, 3, 'DIGIT.'),
	('2DAW', 5, 4, 'SERVIDOR'),
	('2DAW', 5, 5, 'SERVIDOR'),
	('2DAW', 5, 6, 'OPT. 2');

-- Volcando estructura para tabla user1daw_BD1-10.profesor
CREATE TABLE IF NOT EXISTS `profesor` (
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla user1daw_BD1-10.profesor: ~9 rows (aproximadamente)
INSERT INTO `profesor` (`nombre`) VALUES
	('Alberto'),
	('Ernesto'),
	('Isabel'),
	('Javier'),
	('Laura'),
	('Luis'),
	('Marta'),
	('Pablo'),
	('Santi');

-- Volcando estructura para tabla user1daw_BD1-10.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` int unsigned NOT NULL AUTO_INCREMENT,
  `correo` varchar(254) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `rol` enum('administrador','profesor','alumno') NOT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla user1daw_BD1-10.usuarios: ~4 rows (aproximadamente)
INSERT INTO `usuarios` (`idUsuario`, `correo`, `contraseña`, `rol`) VALUES
	(1, 'admin@evg.com', '1234', 'administrador'),
	(2, 'isabel@evg.com', '1234', 'profesor'),
	(3, 'abraham@evg.com', '1234', 'alumno'),
	(4, 'carlos@evg.com', '1234', 'alumno');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
