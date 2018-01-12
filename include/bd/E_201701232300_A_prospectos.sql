CREATE TABLE `prospecto` (
`idProspecto` INT NOT NULL AUTO_INCREMENT,
`idUsuarioAlta` INT NOT NULL,
`fechaAlta` DATETIME NOT NULL,
`folio` VARCHAR(10) NOT NULL,
`contactoNombre` VARCHAR(200) NOT NULL,
`RFC` VARCHAR(14) NOT NULL,
`razonSocial` VARCHAR(200) NOT NULL,
`comentarios` TEXT NOT NULL,
`estatus` ENUM('nuevo', 'autorizado', 'reasignado', 'cancelado', 'cliente') NOT NULL DEFAULT 'nuevo',
`latitud` VARCHAR(30) NOT NULL,
`longitud` VARCHAR(30) NOT NULL,
`idUsuarioAsignado` INT NOT NULL,
PRIMARY KEY (`idProspecto`)
)ENGINE=InnoDB;


CREATE TABLE `prospecto_comentario` (
	`idProspectoComentario` INT NOT NULL AUTO_INCREMENT,
	`idProspecto` INT NOT NULL,
	`idUsuario` INT NOT NULL,
	`fecha` DATETIME NOT NULL,
	`comentario` TEXT NOT NULL,
	PRIMARY KEY (`idProspectoComentario`)
)ENGINE=InnoDB;


ALTER TABLE `prospecto_comentario`
ADD COLUMN `sistema` ENUM('Y','N') NOT NULL DEFAULT 'N' AFTER `comentario`;
