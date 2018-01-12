ALTER TABLE `persona` CHANGE `nacCveEnt` `nacCveEnt` VARCHAR(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `persona` CHANGE `nacCveMun` `nacCveMun` VARCHAR(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL; 
ALTER TABLE `persona` CHANGE `nacionalidad` `nacionalidad` ENUM('mex','ext') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'mex'; 
ALTER TABLE `persona` CHANGE `nacCveLoc` `nacCveLoc` VARCHAR(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;