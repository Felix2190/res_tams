CREATE TABLE `rol_permisos` (
  `id_rol_permiso` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_rol` int(11) NOT NULL,
  `permisos` int(11) NOT NULL,
  `menu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(100) NOT NULL,  
  `estatus` enum('activo','inactivo') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `login_user`
	ADD COLUMN `id_recaudacion` INT(11) NOT NULL AFTER `id_rol`;
  
  ALTER TABLE `login_user`
	ADD COLUMN `estatus` ENUM('activo','inactivo') NOT NULL DEFAULT 'activo' AFTER `email`;