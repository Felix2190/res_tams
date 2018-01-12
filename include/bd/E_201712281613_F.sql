ALTER TABLE `documento` ADD `clave` VARCHAR(100) NOT NULL AFTER `descripcion`; 


INSERT INTO `documento` (`iddocumento`, `descripcion`, `clave`, `estatus`) VALUES (NULL, 'Forrmato SF001', 'formatoSF001', 'activo'); 
UPDATE `documento` SET `clave` = 'identificacionOficial' WHERE `documento`.`iddocumento` = 6; 
UPDATE `documento` SET `clave` = 'comprobanteDomicilio' WHERE `documento`.`iddocumento` = 2; 
UPDATE `documento` SET `clave` = 'actaNacimiento' WHERE `documento`.`iddocumento` = 4;
UPDATE `documento` SET `clave` = 'identificacionPadreTutor' WHERE `documento`.`iddocumento` = 8; 
UPDATE `documento` SET `clave` = 'licenciaAnterior' WHERE `documento`.`iddocumento` = 14; 
INSERT INTO  `documento` (`iddocumento`, `descripcion`, `clave`, `estatus`) VALUES (NULL, 'Exámen de tránsito', 'examenTransito', 'activo'), (NULL, 'CURP', 'curp', 'activo'), (NULL, 'RFC', 'rfc', 'activo'), (NULL, 'Poliza de seguro', 'polizaSeguro', 'activo'), (NULL, 'Carta responsiva', 'cartaResponsiva', 'activo'), (NULL, 'Formato migratorio', 'formatoMigratorio', 'activo'), (NULL, 'Constancia licencia vigente', 'constanciaLicenciaVigente', 'activo'); 
UPDATE `documento` SET `clave` = 'fotografia' WHERE `documento`.`iddocumento` = 1; 
