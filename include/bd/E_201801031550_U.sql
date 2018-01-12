CREATE TABLE `modulos` (
  `idModulo` int(11) NOT NULL,
  `Descripcion` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `IP` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
