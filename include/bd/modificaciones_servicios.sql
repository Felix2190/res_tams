ALTER TABLE `servicio_cloud_ip` ADD `IPs` INT NOT NULL AFTER `tipo`; 

ALTER TABLE `servicio_cloud_ip` CHANGE `terminos_condiciones` `terminos_condiciones` TEXT NOT NULL; 

ALTER TABLE `servicio_cloud_ip` CHANGE `observaciones` `observaciones` TEXT NOT NULL; 

ALTER TABLE `servicio_cloud_ip`  ADD `estatus` ENUM('solicitado','activado') NOT NULL DEFAULT 'solicitado'  AFTER `fecha_solicitud`;
ALTER TABLE `servicio_equipo`  ADD `estatus` ENUM('solicitado','activado') NOT NULL DEFAULT 'solicitado'  AFTER `fecha_solicitud`;
ALTER TABLE `servicio_planet_ucc`  ADD `estatus` ENUM('solicitado','activado') NOT NULL DEFAULT 'solicitado'  AFTER `fecha_solicitud`;
ALTER TABLE `servicio_planet_voice`  ADD `estatus` ENUM('solicitado','activado') NOT NULL DEFAULT 'solicitado'  AFTER `fecha_solicitud`;
ALTER TABLE `servicio_planet_video`  ADD `estatus` ENUM('solicitado','activado') NOT NULL DEFAULT 'solicitado'  AFTER `fecha_solicitud`;


ALTER TABLE `servicio_planet_voice` CHANGE `listado` `total_numeros` INT(11) NOT NULL; 

ALTER TABLE `servicio_planet_voice` CHANGE `ciudad` `c_ciudad` VARCHAR(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL, CHANGE `pais` `c_pais` VARCHAR(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL; 

ALTER TABLE `servicio_planet_voice` ADD `c_pais_av` VARCHAR(10) NULL AFTER `c_pais`; 


ALTER TABLE `servicio_planet_voice` ADD `c_cuidad_av` VARCHAR(10) NULL AFTER `c_pais_av`; 