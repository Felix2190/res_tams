CREATE TABLE producto_cotizado (
`idProductoCotizado` INT NOT NULL AUTO_INCREMENT,
`identificador` VARCHAR(50) NULL,
`descripcion` TEXT NULL,
`estatus` ENUM('vigente','baja','suspendido') NULL DEFAULT 'vigente',
PRIMARY KEY (`idProductoCotizado`)
)ENGINE=InnoDB;

CREATE TABLE `prospecto_producto` (
`idProspectoProducto` INT NOT NULL AUTO_INCREMENT,
`idProspecto` INT NULL,
`idProductoCotizado` INT NULL,
PRIMARY KEY (`idProspectoProducto`)
)ENGINE=InnoDB;