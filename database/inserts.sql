INSERT INTO usuarios (nombre_usuario, clave, nombre, apellido)
VALUES ('ejemplo','$2y$10$MKEZOE1o/HEE2KAgDMBkq.j6kjw0tiu.FGMSKLdi9wU8MMDQIlpFO',
        'Fulano','de Tal');
 
INSERT INTO usuarios (nombre_usuario, clave, nombre, apellido)
VALUES ('juansemarquez','$2y$10$MKEZOE1o/HEE2KAgDMBkq.j6kjw0tiu.FGMSKLdi9wU8MMDQIlpFO',
        'Juan','Marquez'); 

INSERT INTO anuncios (titulo, texto, fecha_publicacion, vigente, usuarios_id)
VALUES ('Suspensión de clases','Los alumnos no tendran clase en el día de la fecha por desinfección',
        '2023-10-06 10:00:00','1','1');
        
INSERT INTO anuncios (titulo, texto, fecha_publicacion, vigente, usuarios_id)
VALUES ('Ausencia de profesor','Profesor González de Estadística se ausentará en el día de la fecha',
        '2023-10-07 12:00:00','1','1');

INSERT INTO anuncios (titulo, texto, fecha_publicacion, vigente, usuarios_id)
VALUES ('Cambio de horario','Profesor Perez de Programación I adelantará sus horas del día jueves, ingresando los alumnos 19:20hs y retirándose 20:40hs',
        '2023-10-08 14:00:00','1','1');

INSERT INTO comisiones (id, anio, comision, carrera)
VALUES ('DS11','1', '1','DS');

INSERT INTO comisiones (id, anio, comision, carrera)
VALUES ('DS12','1', '2','DS');

INSERT INTO comisiones (id, anio, comision, carrera)
VALUES ('DS13','1', '3','DS');

INSERT INTO comisiones (id, anio, comision, carrera)
VALUES ('DS21','2', '1','DS');

INSERT INTO comisiones (id, anio, comision, carrera)
VALUES ('DS22','2', '2','DS');

INSERT INTO comisiones (id, anio, comision, carrera)
VALUES ('DS22','2', '3','DS');

INSERT INTO comisiones (id, anio, comision, carrera)
VALUES ('DS31','3', '1','DS');

INSERT INTO comisiones (id, anio, comision, carrera)
VALUES ('DS32','3', '2','DS');


INSERT INTO comisiones (id, anio, comision, carrera)
VALUES ('ITI11','1', '1','ITI');

INSERT INTO comisiones (id, anio, comision, carrera)
VALUES ('ITI12','1', '2','ITI');

INSERT INTO comisiones (id, anio, comision, carrera)
VALUES ('ITI21','2', '1','ITI');

INSERT INTO comisiones (id, anio, comision, carrera)
VALUES ('ITI22','2', '2','ITI');

INSERT INTO comisiones (id, anio, comision, carrera)
VALUES ('ITI31','3', '1','ITI');

INSERT INTO comisiones (id, anio, comision, carrera)
VALUES ('ITI32','3', '2','ITI');


INSERT INTO comisiones (id, anio, comision, carrera)
VALUES ('AF11','1', '1','AF');

INSERT INTO comisiones (id, anio, comision, carrera)
VALUES ('AF12','1', '2','AF');

INSERT INTO comisiones (id, anio, comision, carrera)
VALUES ('AF13','1', '3','AF');

INSERT INTO comisiones (id, anio, comision, carrera)
VALUES ('AF21','2', '1','AF');

INSERT INTO comisiones (id, anio, comision, carrera)
VALUES ('AF22','2', '2','AF');

INSERT INTO comisiones (id, anio, comision, carrera)
VALUES ('AF31','3', '1','AF');










