ALTER TABLE `persona` ADD `segundoNombre` VARCHAR(50) NOT NULL AFTER `nombres`; 

ALTER TABLE `inegi_domicilio` CHANGE `colonia` `colonia` VARCHAR(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL; 

ALTER TABLE `persona` ADD `codigoPais` VARCHAR(3) NOT NULL AFTER `email`, ADD `ladaTel` VARCHAR(3) NOT NULL AFTER `codigoPais`; 

ALTER TABLE `contacto_emergencia` ADD `apellidoPaterno` VARCHAR(50) NOT NULL AFTER `nombre`, ADD `apellidoMaterno` VARCHAR(50) NOT NULL AFTER `apellidoPaterno`; 

ALTER TABLE `contacto_emergencia` ADD `codigoPais` VARCHAR(5) NOT NULL AFTER `codigoPostal`, ADD `ladaTel` VARCHAR(5) NOT NULL AFTER `codigoPais`; 

ALTER TABLE `inegi_domicilio` CHANGE `cveLoc` `cveLoc` VARCHAR(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL; 