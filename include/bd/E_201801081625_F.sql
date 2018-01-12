ALTER TABLE `biometrico` ADD `prioridad` INT(2) NOT NULL ;

UPDATE `biometrico` SET `prioridad` = '1' WHERE `idBiometrico` = 4;
UPDATE `biometrico` SET `prioridad` = '2' WHERE `idBiometrico` = 8;
UPDATE `biometrico` SET `prioridad` = '3' WHERE `idBiometrico` = 9;
UPDATE `biometrico` SET `prioridad` = '4' WHERE `idBiometrico` = 10;
UPDATE `biometrico` SET `prioridad` = '5' WHERE `idBiometrico` = 3;
UPDATE `biometrico` SET `prioridad` = '6' WHERE `idBiometrico` = 7;
UPDATE `biometrico` SET `prioridad` = '7' WHERE `idBiometrico` = 2;
UPDATE `biometrico` SET `prioridad` = '8' WHERE `idBiometrico` = 6;
UPDATE `biometrico` SET `prioridad` = '9' WHERE `idBiometrico` = 1;
UPDATE `biometrico` SET `prioridad` = '10' WHERE `idBiometrico` = 5;
