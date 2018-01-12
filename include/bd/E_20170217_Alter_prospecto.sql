ALTER TABLE `prospecto`
ADD COLUMN `categoria` ENUM('empresarial','gobiernoFederal','gobiernoMunicipalEstatal') NOT NULL DEFAULT 'empresarial',
ADD COLUMN `valorAnualEstimado` INT NOT NULL,
ADD COLUMN `mesCierreEsperado` VARCHAR(20) NOT NULL,
ADD COLUMN `probabilidadExito` INT NOT NULL,
ADD COLUMN `fechaUltimaModificacion` DATETIME NOT NULL,
CHANGE COLUMN `estatus` `estatus` ENUM('nuevo','autorizado','reasignado','cancelado','cliente', 'informacion','propuesta','contrato','denegado','pospuesto') NOT NULL DEFAULT 'nuevo',
ADD COLUMN `fechaRetomar` DATETIME NOT NULL`
ADD COLUMN `filePropuesta` VARCHAR(100) NOT NULL;

DROP TABLE producto_cotizado;
CREATE TABLE producto_cotizado (
`idProductoCotizado` INT NOT NULL AUTO_INCREMENT,
`identificador` VARCHAR(50) NULL,
`descripcion` TEXT NULL,
`estatus` ENUM('vigente','baja','suspendido') NULL DEFAULT 'vigente',
PRIMARY KEY (`idProductoCotizado`)
)ENGINE=InnoDB;

INSERT INTO producto_cotizado(identificador) VALUES('Cloud IP');
INSERT INTO producto_cotizado(identificador) VALUES('Planet Voice');
INSERT INTO producto_cotizado(identificador) VALUES('Planet UCC');
INSERT INTO producto_cotizado(identificador) VALUES('Planet Video Center');
INSERT INTO producto_cotizado(identificador) VALUES('Equipo');