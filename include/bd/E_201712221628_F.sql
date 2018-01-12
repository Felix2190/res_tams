ALTER TABLE `verificacion_biografica` ADD `entrada` VARCHAR(100) NOT NULL ; 


INSERT INTO `rol` (`id_rol`, `nombre`, `estatus`) VALUES
(1, 'ROOT', 'activo');


INSERT INTO `rol_permisos` (`id_rol_permiso`, `id_rol`, `permisos`, `menu`) VALUES
(12, 1, 15, 'turnos'),
(13, 1, 15, 'verificacion'),
(14, 1, 15, 'modulo1'),
(15, 1, 15, 'modulo2'),
(16, 1, 15, 'modulo3'),
(17, 1, 15, 'reportes'),
(18, 1, 15, 'usuarios'),
(19, 1, 15, 'roles'),
(20, 1, 15, 'reglas'),
(21, 1, 15, 'descuentos'),
(22, 1, 15, 'soporte');

UPDATE `licenciastam`.`login_user` SET `id_rol` = '1' , `id_recaudacion` = '1' 

