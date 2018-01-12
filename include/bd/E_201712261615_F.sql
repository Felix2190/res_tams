
ALTER TABLE `persona` ADD `nacionalidad` ENUM('mex','ext') NOT NULL DEFAULT 'mex' AFTER `homoclave`; 

ALTER TABLE `persona_datos_extras` ADD `observaciones` TEXT NOT NULL ; 

ALTER TABLE `inegi_domicilio` ADD `numeroInterior` SMALLINT(3) NOT NULL AFTER `numeroExterior`; 


ALTER TABLE `persona_datos_extras` CHANGE `impresionSangre` `impresionSangre` TINYINT(1) NOT NULL DEFAULT '0', CHANGE `usaLentes` `usaLentes` TINYINT(1) NOT NULL DEFAULT '0', CHANGE `donaOrganos` `donaOrganos` TINYINT(1) NOT NULL DEFAULT '0', CHANGE `usaTransmisionAutomat1ica` `usaTransmisionAutomat1ica` TINYINT(1) NOT NULL DEFAULT '0', CHANGE `equipadoConductorDiscapacitado` `equipadoConductorDiscapacitado` TINYINT(1) NOT NULL DEFAULT '0', CHANGE `equipadoConductorProtesis` `equipadoConductorProtesis` TINYINT(1) NOT NULL DEFAULT '0'; 

INSERT INTO `listadoscortos` (`idListado`, `listado`, `valor`) VALUES ('26', 'sangre', 'no sabe');

ALTER TABLE `persona_datos_extras` DROP `observaciones`;

ALTER TABLE `contacto_emergencia` ADD `numeroInterior` SMALLINT NOT NULL DEFAULT '0' AFTER `numeroExterrior`; 

ALTER TABLE `contacto_emergencia` ADD `observaciones` TEXT NOT NULL ; 

CREATE TABLE IF NOT EXISTS `estado_civil` (
  `idEstadoCivil` int(10) unsigned NOT NULL DEFAULT '0',
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idEstadoCivil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `estado_civil` (`idEstadoCivil`, `nombre`) VALUES
(1, 'CASADO(A)'),
(2, 'SOLTERO(A)'),
(3, 'DIVORCIADO(A)'),
(4, 'VIUDO(A)'),
(9, 'SE DESCONOCE/NO SABE/ NO RESPONDIO');

