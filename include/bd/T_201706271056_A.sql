CREATE TRIGGER `log_turno_insert` AFTER UPDATE ON `turno`
 FOR EACH ROW begin
if NEW.idEtapa!=OLD.idEtapa then

INSERT INTO log_turno (idTurno,idEtapa, fecha,idUsuario)
Values (old.idTurno, old.idEtapa, old.fechaHora,old.idUsuario);
end if;
END