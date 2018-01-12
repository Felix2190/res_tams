CREATE TABLE IF NOT EXISTS `log_turno` (
  `idLog` int(11) NOT NULL AUTO_INCREMENT,
  `idTurno` int(11) NOT NULL,
  `idEtapa` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idLog`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=143 ;
