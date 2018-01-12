DROP TABLE reglalicencia;
CREATE TABLE `reglaLicencia` (
  `idReglaLicencia` int(11) NOT NULL,
  `idTipoLicencia` int(11) NOT NULL,
  `nombreRegla` varchar(50) NOT NULL,
  `formatoSF001` tinyint(1) NOT NULL,
  `examenTransito` tinyint(1) NOT NULL,
  `identificacionOficial` tinyint(1) NOT NULL,
  `comprobanteDomicilio` tinyint(1) NOT NULL,
  `curp` tinyint(1) NOT NULL,
  `rfc` tinyint(1) NOT NULL,
  `actaNacimiento` tinyint(1) NOT NULL,
  `polizaSeguro` tinyint(1) NOT NULL,
  `cartaResponsiva` tinyint(1) NOT NULL,
  `identificacionPadreTutor` tinyint(1) NOT NULL,
  `formatoMigratorio` tinyint(1) NOT NULL,
  `constanciaLicenciaVigente` tinyint(1) NOT NULL,
  `licenciaAnterior` tinyint(1) NOT NULL,
  `estatus` enum('activo','inactivo') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `reglaLicencia` (`idReglaLicencia`, `idTipoLicencia`, `nombreRegla`, `formatoSF001`, `examenTransito`, `identificacionOficial`, `comprobanteDomicilio`, `curp`, `rfc`, `actaNacimiento`, `polizaSeguro`, `cartaResponsiva`, `identificacionPadreTutor`, `formatoMigratorio`, `constanciaLicenciaVigente`, `licenciaAnterior`, `estatus`) VALUES
(1, 2, 'Expedición Automovilista', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 'activo'),
(2, 3, 'Expedición Automovilista', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 'activo'),
(3, 6, 'Expedición Chofer', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 'activo'),
(4, 7, 'Expedición Chofer', 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 'activo'),
(5, 10, 'Expedición Motociclista ', 1, 1, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 'activo'),
(6, 11, 'Expedición Motociclista ', 1, 1, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 'activo'),
(7, 2, 'Expedición Automovilista Menor de Edad ', 1, 1, 1, 0, 0, 0, 1, 1, 1, 1, 0, 0, 0, 'activo'),
(8, 1, 'Expedición Automovilista Extranjero ', 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 'activo'),
(9, 4, 'Revalidación Automovilista', 1, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 'activo'),
(10, 5, 'Revalidación Automovilista', 1, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 'activo'),
(11, 8, 'Revalidación Chofer', 1, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 'activo'),
(12, 9, 'Revalidación Chofer', 1, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 'activo'),
(13, 12, 'Revalidación Motociclista', 1, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 'activo'),
(14, 13, 'Revalidación Motociclista', 1, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 'activo');
