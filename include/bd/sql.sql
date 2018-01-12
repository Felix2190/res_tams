CREATE TABLE `demomx_inms`.`registerTmp` (
  `idRegisterTmp` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` VARCHAR(200) NOT NULL DEFAULT '',
  `full_lastname` VARCHAR(200) NOT NULL DEFAULT '',
  `empresaTxt` VARCHAR(200) NOT NULL DEFAULT '',
  `phone` VARCHAR(20) NOT NULL DEFAULT '',
  `idCountry` VARCHAR(2) NOT NULL DEFAULT '',
  `state` VARCHAR(200) NOT NULL DEFAULT '',
  `city` VARCHAR(200) NOT NULL DEFAULT '',
  `addressTxt` VARCHAR(500) NOT NULL DEFAULT '',
  `cpTxt` VARCHAR(5) NOT NULL DEFAULT '',
  `sameDir` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  `full_fiscalname` VARCHAR(200) NOT NULL DEFAULT '',
  `emailfiscal` VARCHAR(200) NOT NULL DEFAULT '',
  `phonefiscal` VARCHAR(200) NOT NULL DEFAULT '',
  `addressFiscalTxt` VARCHAR(500) NOT NULL DEFAULT '',
  `cpFiscalTxt` VARCHAR(5) NOT NULL DEFAULT '',
  `idCountryFiscal` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  `stateFiscal` VARCHAR(200) NOT NULL DEFAULT '',
  `cityFiscal` VARCHAR(200) NOT NULL DEFAULT '',
  `vatFiscal` VARCHAR(20) NOT NULL DEFAULT '',
  `domainName` VARCHAR(300) NOT NULL DEFAULT '',
  `password` VARCHAR(200) NOT NULL DEFAULT '',
  `crmLanguage` VARCHAR(5) NOT NULL DEFAULT '',
  `invoiceLanguage` VARCHAR(5) NOT NULL DEFAULT '',
  `idAmadeoOptions` INTEGER UNSIGNED NOT NULL DEFAULT 0,
  `nbrUsers` INTEGER UNSIGNED NOT NULL DEFAULT 0,
  `orderTotal` DOUBLE NOT NULL DEFAULT 0,
  `fechaAlta` DATETIME,
  `estatusPago` ENUM('pendiente','rechazado','aceptado') NOT NULL DEFAULT 'pendiente',
  `proveedorPago` VARCHAR(50) NOT NULL DEFAULT '',
  `email` VARCHAR(300) NOT NULL DEFAULT '',
  PRIMARY KEY(`idRegisterTmp`)
)
ENGINE = InnoDB;

CREATE TABLE `demomx_inms`.`amadeoOptions` (
  `idAmadeoOptions` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL DEFAULT '',
  `description` VARCHAR(45) NOT NULL DEFAULT '',
  `costUser` DOUBLE NOT NULL DEFAULT 0,
  `status` ENUM('activo','inactivo') NOT NULL DEFAULT 'activo',
  PRIMARY KEY(`idAmadeoOptions`)
)
ENGINE = InnoDB;

CREATE TABLE `demomx_inms`.`registroPasos` (
  `idRegistroPasos` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  `idTmp` INTEGER UNSIGNED NOT NULL DEFAULT 0,
  `nombrePaso` VARCHAR(45) NOT NULL DEFAULT '',
  `fechaCompletado` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `observaciones` TEXT NOT NULL DEFAULT '',
  `estatus` ENUM('pendiente','completado') NOT NULL DEFAULT 'pendiente',
  `fechaInicio` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY(`idRegistroPasos`)
)
ENGINE = InnoDB;

ALTER TABLE `registertmp` MODIFY COLUMN `idCountry` VARCHAR(4) NOT NULL DEFAULT '0',
 MODIFY COLUMN `idCountryFiscal` VARCHAR(4) NOT NULL DEFAULT '0';

