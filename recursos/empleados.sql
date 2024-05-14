create database empleados;

use empleados;

create table empleados (
  ID_empleado varchar(30),
  Nombre varchar(50),
  Apellido varchar(100),
  Departamento varchar(30),
  primary key(ID_empleado)
);

insert into
  empleados (ID_empleado, Nombre, Apellido, Departamento)
values
  ("E-2730", "Jesus", "Torres Sanchez", 2);

INSERT INTO
  empleados (ID_empleado, Nombre, Apellido, Departamento)
VALUES
  ('R-880', 'Efra', 'SEGUNDO', 'MANGUERAS');

INSERT INTO
  empleados (ID_empleado, Nombre, Apellido, Departamento)
VALUES
  ('E-1999', 'Carlos', 'NUÑEZ', 'LOGISTICA');

INSERT INTO
  empleados (ID_empleado, Nombre, Apellido, Departamento)
VALUES
  ('E-2050', 'localhost', 'REYNOSO', 'ADMON');

INSERT INTO
  empleados (ID_empleado, Nombre, Apellido, Departamento)
VALUES
  ('E-2729', 'AAA', 'HERNANDEZ GONZALEZ', 'PSICO I');

INSERT INTO
  empleados (ID_empleado, Nombre, Apellido, Departamento)
VALUES
  ('M-3697', 'AAA', 'ORTEGA', 'HERRERIA');

INSERT INTO
  empleados (ID_empleado, Nombre, Apellido, Departamento)
VALUES
  ('P-4217', 'AAA', 'PEREZ', 'PLASTICOS');

INSERT INTO
  empleados (ID_empleado, Nombre, Apellido, Departamento)
VALUES
  ('P-4462', 'AAA', 'CASTAÑEDA', 'PLASTICOS');

INSERT INTO
  empleados (ID_empleado, Nombre, Apellido, Departamento)
VALUES
  ('P-4463', 'AAA', 'CASTAÑEDA', 'PLASTICOS');

INSERT INTO
  empleados (ID_empleado, Nombre, Apellido, Departamento)
VALUES
  ('P-4464', 'AAA', 'CASTAÑEDA', 'PLASTICOS');

INSERT INTO
  empleados (ID_empleado, Nombre, Apellido, Departamento)
VALUES
  ('P-4465', 'AAA', 'CASTAÑEDA', 'PLASTICOS');

INSERT INTO
  empleados (ID_empleado, Nombre, Apellido, Departamento)
VALUES
  ('P-4466', 'AAA', 'CASTAÑEDA', 'PLASTICOS');

INSERT INTO
  empleados (ID_empleado, Nombre, Apellido, Departamento)
VALUES
  ('P-4467', 'AAA', 'CASTAÑEDA', 'PLASTICOS');

INSERT INTO
  empleados (ID_empleado, Nombre, Apellido, Departamento)
VALUES
  ('P-4468', 'AAA', 'CASTAÑEDA', 'PLASTICOS');

INSERT INTO
  empleados (ID_empleado, Nombre, Apellido, Departamento)
VALUES
  ('P-4511', 'AAA', 'LOPEZ', 'PLASTICOS');

INSERT INTO
  empleados (ID_empleado, Nombre, Apellido, Departamento)
VALUES
  ('P-4576', 'AAA', 'GONZALEZ', 'PLASTICOS');

INSERT INTO
  empleados (ID_empleado, Nombre, Apellido, Departamento)
VALUES
  ('P-4579', 'AAA', 'LOPEZ OROZCO', 'ADMON');

INSERT INTO
  empleados (ID_empleado, Nombre, Apellido, Departamento)
VALUES
  ('P-4697', 'AAA', 'CHIMAL MEDINA', 'ADMON');

INSERT INTO
  empleados (ID_empleado, Nombre, Apellido, Departamento)
VALUES
  ('P-4698', 'AAA', 'PEREZ', 'ADMON');

INSERT INTO
  empleados (ID_empleado, Nombre, Apellido, Departamento)
VALUES
  ('P-4699', 'AAA', 'RILH', 'ADMON');

select
  *
from
  empleados;

CREATE TABLE dia (
  dia_id INT NOT NULL UNIQUE,
  dia VARCHAR(10) NOT NULL,
  PRIMARY KEY (dia_id)
);

insert into
  dia (dia_id, dia)
values
  (2, "Lunes");

insert into
  dia (dia_id, dia)
values
  (3, "Martes");

insert into
  dia (dia_id, dia)
values
  (4, "Miercoles");

insert into
  dia (dia_id, dia)
values
  (5, "Jueves");

insert into
  dia (dia_id, dia)
values
  (6, "Viernes");

insert into
  dia (dia_id, dia)
values
  (7, "Sabado");

insert into
  dia (dia_id, dia)
values
  (1, "Domingo");

select
  *
from
  dia;

CREATE TABLE asistencia(
  id int AUTO_INCREMENT,
  ID_empleado varchar(30),
  fecha date,
  H_entrada TIME,
  H_salida TIME,
  retardos int,
  faltas int,
  PRIMARY KEY (id),
  foreign key (ID_empleado) references empleados (ID_empleado) on delete cascade on update cascade
);

insert into
  asistencia (
    ID_empleado,
    fecha,
    H_entrada,
    H_salida,
    retardos,
    faltas
  )
values
  ("E-1999", "2023-11-28", "8:00", "16:00", 2, 0);

insert into
  asistencia (
    ID_empleado,
    fecha,
    H_entrada,
    H_salida,
    retardos,
    faltas
  )
values
  ("E-1999", "2023-11-29", "8:00", "16:00", 2, 0);

insert into
  asistencia (
    ID_empleado,
    fecha,
    H_entrada,
    H_salida,
    retardos,
    faltas
  )
values
  ("E-1999", "2023-11-30", "8:00", "16:00", 2, 0);

insert into
  asistencia (
    ID_empleado,
    fecha,
    H_entrada,
    H_salida,
    retardos,
    faltas
  )
values
  ("E-1999", "2023-12-01", "8:00", "16:00", 2, 0);

insert into
  asistencia (
    ID_empleado,
    fecha,
    H_entrada,
    H_salida,
    retardos,
    faltas
  )
values
  ("E-1999", "2023-12-02", "8:00", "15:00", 2, 0);

insert into
  asistencia (
    ID_empleado,
    fecha,
    H_entrada,
    H_salida,
    retardos,
    faltas
  )
values
  ("E-2050", "2023-11-28", "8:00", "16:00", 2, 0);

insert into
  asistencia (
    ID_empleado,
    fecha,
    H_entrada,
    H_salida,
    retardos,
    faltas
  )
values
  ("E-2729", "2023-11-28", "8:00", "16:00", 2, 1);

insert into
  asistencia (
    ID_empleado,
    fecha,
    H_entrada,
    H_salida,
    retardos,
    faltas
  )
values
  ("M-3697", "2023-11-28", "8:00", "16:00", 2, 0);

insert into
  asistencia (
    ID_empleado,
    fecha,
    H_entrada,
    H_salida,
    retardos,
    faltas
  )
values
  ("P-4217", "2023-11-28", "8:00", "16:00", 0, 0);

insert into
  asistencia (
    ID_empleado,
    fecha,
    H_entrada,
    H_salida,
    retardos,
    faltas
  )
values
  ("P-4462", "2023-11-28", "8:00", "16:00", 1, 0);

insert into
  asistencia (
    ID_empleado,
    fecha,
    H_entrada,
    H_salida,
    retardos,
    faltas
  )
values
  ("R-880", "2023-11-20", "8:00", "16:00", 1, 0);

insert into
  asistencia (
    ID_empleado,
    fecha,
    H_entrada,
    H_salida,
    retardos,
    faltas
  )
values
  ("P-4699", "2023-11-25", "8:00", "14:00", 1, 0);

insert into
  asistencia (
    ID_empleado,
    fecha,
    H_entrada,
    H_salida,
    retardos,
    faltas
  )
values
  ("E-1999", "2023-12-13", "8:00", "16:00", 1, 0);

insert into
  asistencia (
    ID_empleado,
    fecha,
    H_entrada,
    H_salida,
    retardos,
    faltas
  )
values
  ("E-1999", "2024-01-14", "8:00", "16:00", 1, 0);

insert into
  asistencia (
    ID_empleado,
    fecha,
    H_entrada,
    H_salida,
    retardos,
    faltas
  )
values
  ("E-2730", "2024-01-15", "8:00", "16:00", 0, 0);

select
  *
from
  asistencia;

create table departamentos (
  id int auto_increment,
  nom_departamento varchar(50),
  primary key (id)
);

insert into
  departamentos (nom_departamento)
values
  ("ADMON");

insert into
  departamentos (nom_departamento)
values
  ("HERRERIA");

insert into
  departamentos (nom_departamento)
values
  ("LOGISTICA");

insert into
  departamentos (nom_departamento)
values
  ("MANGUERAS");

insert into
  departamentos (nom_departamento)
values
  ("PLASTICOS");

insert into
  departamentos (nom_departamento)
values
  ("PSICO I");

CREATE TABLE horario (
  horario_id INT auto_increment,
  ID_departamento int,
  dia_id INT NOT NULL,
  H_entrada TIME NULL,
  H_salida TIME NULL,
  PRIMARY KEY (horario_id),
  FOREIGN KEY (dia_id) REFERENCES dia(dia_id) on delete cascade on update cascade,
  foreign key (ID_departamento) references departamentos (id) on delete cascade on update cascade
);

insert into
  horario (
    horario_id,
    ID_departamento,
    dia_id,
    H_entrada,
    H_salida
  )
values
  (1, 1, 2, "8:00", "16:00");

insert into
  horario (
    horario_id,
    ID_departamento,
    dia_id,
    H_entrada,
    H_salida
  )
values
  (2, 1, 3, "8:00", "16:00");

insert into
  horario (
    horario_id,
    ID_departamento,
    dia_id,
    H_entrada,
    H_salida
  )
values
  (3, 1, 4, "8:00", "16:00");

insert into
  horario (
    horario_id,
    ID_departamento,
    dia_id,
    H_entrada,
    H_salida
  )
values
  (4, 1, 5, "8:00", "16:00");

insert into
  horario (
    horario_id,
    ID_departamento,
    dia_id,
    H_entrada,
    H_salida
  )
values
  (5, 1, 6, "8:00", "16:00");

insert into
  horario (
    horario_id,
    ID_departamento,
    dia_id,
    H_entrada,
    H_salida
  )
values
  (6, 1, 7, "8:00", "14:00");

insert into
  horario (
    horario_id,
    ID_departamento,
    dia_id,
    H_entrada,
    H_salida
  )
values
  (7, 1, 1, null, null);

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (2, 2, "8:00", "16:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (2, 3, "8:00", "16:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (2, 4, "8:00", "16:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (2, 5, "8:00", "16:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (2, 6, "8:00", "16:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (2, 7, "8:00", "14:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (2, 1, null, null);

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (3, 2, "8:00", "16:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (3, 3, "8:00", "16:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (3, 4, "8:00", "16:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (3, 5, "8:00", "16:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (3, 6, "8:00", "16:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (3, 7, "8:00", "15:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (3, 1, null, null);

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (4, 2, "8:00", "16:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (4, 3, "8:00", "16:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (4, 4, "8:00", "16:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (4, 5, "8:00", "16:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (4, 6, "8:00", "16:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (4, 7, "8:00", "14:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (4, 1, null, null);

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (5, 2, "8:00", "17:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (5, 3, "8:00", "17:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (5, 4, "8:00", "17:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (5, 5, "8:00", "17:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (5, 6, "8:00", "17:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (5, 7, "8:00", "17:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (5, 1, null, null);

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (6, 2, "8:00", "16:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (6, 3, "8:00", "16:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (6, 4, "8:00", "16:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (6, 5, "8:00", "16:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (6, 6, "8:00", "16:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (6, 7, "8:00", "15:00");

insert into
  horario (ID_departamento, dia_id, H_entrada, H_salida)
values
  (6, 1, null, null);

select
  *
from
  horario;

select
  horario.horario_id,
  dia.dia_id,
  dia.dia,
  departamentos.nom_departamento,
  MAX(
    if(
      DAYOFWEEK(horario.dia_id) = 2,
      null,
      concat(horario.H_entrada, '--', horario.H_salida)
    )
  ) L,
  MIN(
    if(
      DAYOFWEEK(dia.dia_id) = 3,
      null,
      concat(horario.H_entrada, '--', horario.H_salida)
    )
  ) M,
  MIN(
    if(
      DAYOFWEEK(NOW()) = 4,
      concat(horario.H_entrada, '--', horario.H_salida),
      null
    )
  ) X,
  MIN(
    if(
      DAYOFWEEK(dia.dia_id) = 5,
      null,
      concat(horario.H_entrada, '--', horario.H_salida)
    )
  ) J,
  MIN(
    if(
      DAYOFWEEK(dia.dia_id) = 6,
      null,
      concat(horario.H_entrada, '--', horario.H_salida)
    )
  ) V,
  MIN(
    if(
      dia.dia_id = "7",
      concat(horario.H_entrada, '--', horario.H_salida),
      null
    )
  ) S,
  MIN(
    if(
      DAYOFWEEK(dia.dia_id) = 1,
      null,
      concat(horario.H_entrada, '--', horario.H_salida)
    )
  ) D
from
  horario
  inner join dia on horario.dia_id = dia.dia_id
  inner join departamentos on horario.ID_departamento = departamentos.id
group by
  1
ORDER BY
  horario.horario_id;

/* ESte es el bueno*/
select
  horario.horario_id,
  dia.dia_id,
  dia.dia,
  departamentos.nom_departamento,
  concat(horario.H_entrada, '---', horario.H_salida) as "Horario"
from
  horario
  inner join dia on horario.dia_id = dia.dia_id
  inner join departamentos on horario.ID_departamento = departamentos.id
group by
  1
ORDER BY
  horario.horario_id;

select
  DAYOFWEEK(horario.dia_id) = "2"
from
  horario;

select
  horario.dia_id
from
  horario
where
  dia_id = 2;

select
  dia.dia_id,
  dia.dia,
  departamentos.nom_departamento,
  horario.H_entrada,
  horario.H_salida
from
  horario
  inner join dia on horario.dia_id = dia.dia_id
  inner join departamentos on horario.ID_departamento = departamentos.id
ORDER BY
  CASE
    WHEN dia.dia_id - DAYOFWEEK(CURDATE()) + 2 < 0 THEN dia.dia_id + DAYOFWEEK(CURDATE())
    ELSE dia.dia_id - DAYOFWEEK(CURDATE())
  END;

create table usuarios (
  id int auto_increment,
  usuario varchar(30) NOT NULL,
  contraseña varchar(500) NOT NULL,
  tipo varchar(50) NOT NULL,
  id_empleado varchar(30),
  primary key (id)
);

insert into
  usuarios (usuario, contraseña, tipo, id_empleado)
values
  ("localhost", "localhost", "administrador", null);

insert into
  usuarios (usuario, contraseña, tipo, id_empleado)
values
  ("Efra", "123", "empleado", "E-1999");

select
  empleados.ID_empleado,
  empleados.nombre,
  empleados.apellido,
  departamentos.nom_departamento,
  dia.dia,
  concat(horario.H_entrada, '---', horario.H_salida) as "Horario"
from
  empleados
  inner join departamentos on departamentos.id = empleados.Departamento
  inner join horario on horario.ID_departamento = departamentos.id
  inner join dia on dia.dia_id = horario.dia_id;

select
  empleados.ID_empleado,
  empleados.nombre,
  empleados.apellido,
  asistencia.fecha,
  DATE_FORMAT(asistencia.fecha, "%W") as dia,
  departamentos.nom_departamento,
  concat(asistencia.H_entrada, '---', asistencia.H_salida) as "Horas"
from
  asistencia
  inner join empleados on asistencia.ID_empleado = empleados.ID_empleado
  inner join departamentos on departamentos.id = empleados.Departamento;

select
  count(*) as "conteo"
from
  empleados
  inner join departamentos on departamentos.id = empleados.Departamento
  inner join horario on horario.ID_departamento = departamentos.id
  inner join dia on dia.dia_id = horario.dia_id;

/*Registro de horas*/
select
  empleados.ID_empleado,
  empleados.nombre,
  empleados.apellido,
  asistencia.fecha,
  departamentos.nom_departamento,
  asistencia.H_entrada,
  asistencia.H_salida
from
  asistencia
  inner join empleados on asistencia.ID_empleado = empleados.ID_empleado
  inner join departamentos on departamentos.id = empleados.Departamento
ORDER BY
  asistencia.fecha desc;

select
  count(*) as "conteo"
from
  asistencia
  inner join empleados on asistencia.ID_empleado = empleados.ID_empleado
  inner join departamentos on departamentos.id = empleados.Departamento;

/* Determinar hora dia*/
select
  empleados.ID_empleado,
  empleados.nombre,
  empleados.apellido,
  asistencia.fecha,
  departamentos.nom_departamento,
  time_FORMAT(
    (asistencia.H_salida - asistencia.H_entrada),
    "%H:%i:%S"
  ) as "hora dia",
  asistencia.H_entrada,
  asistencia.H_salida
from
  asistencia
  inner join empleados on asistencia.ID_empleado = empleados.ID_empleado
  inner join departamentos on departamentos.id = empleados.Departamento
where
  asistencia.ID_empleado = "E-1999";

/*horas mes*/
select
  empleados.ID_empleado,
  empleados.nombre,
  empleados.apellido,
  asistencia.fecha,
  departamentos.nom_departamento,
  DATE_FORMAT(NOW(), "%M") as "mes",
  time_FORMAT(
    sum(asistencia.H_salida - asistencia.H_entrada),
    "%H:%i:%S"
  ) as "horas mes",
  asistencia.H_entrada,
  asistencia.H_salida
from
  asistencia
  inner join empleados on asistencia.ID_empleado = empleados.ID_empleado
  inner join departamentos on departamentos.id = empleados.Departamento
where
  asistencia.ID_empleado = "E-1999"
  and DATE_FORMAT(asistencia.fecha, "%m") = DATE_FORMAT(NOW(), "%m");

/*DATE_FORMAT(asistencia.fecha, "%m")=DATE_FORMAT(NOW(), "%m")*/
select
  empleados.ID_empleado,
  empleados.nombre,
  empleados.apellido,
  asistencia.fecha,
  departamentos.nom_departamento,
  time_FORMAT(
    (asistencia.H_salida - asistencia.H_entrada),
    "%H:%i:%S"
  ) as "hora",
  time_FORMAT(
    sum(asistencia.H_salida - asistencia.H_entrada),
    "%H:%i:%S"
  ),
  asistencia.H_entrada,
  asistencia.H_salida
from
  asistencia
  inner join empleados on asistencia.ID_empleado = empleados.ID_empleado
  inner join departamentos on departamentos.id = empleados.Departamento
where
  DATE_FORMAT("2023-12-06", "%M") = DATE_FORMAT(NOW(), "%M");

select
  *
from
  usuarios;

select
  *
from
  horario;

select
  *
from
  empleados;

select
  *
from
  horario;

SET
  lc_time_names = 'es_MX';

select
  DATE_FORMAT(NOW(), "%H:%i:%S %p");

select
  DATE_FORMAT("2023-12-07", "%W");

select
  DATE_FORMAT("2023-12-07", "%M");

select
  DATE_FORMAT(NOW(), "%m");

SELECT
  DAYOFWEEK("2023-12-06");

SELECT
  DAYOFWEEK(NOW()) as "dia";

SELECT
  EXTRACT(
    DAY
    FROM
      NOW()
  ) AS d;

select
  WEEKOFYEAR(now());

select
  empleados.ID_empleado,
  empleados.nombre,
  empleados.apellido,
  asistencia.fecha,
  WEEKOFYEAR(asistencia.fecha),
  departamentos.nom_departamento,
  time_FORMAT(
    (asistencia.H_salida - asistencia.H_entrada),
    "%H:%i:%S"
  ) as "hora",
  time_FORMAT(
    sum(asistencia.H_salida - asistencia.H_entrada),
    "%H:%i:%S"
  ) as "hora semana",
  asistencia.H_entrada,
  asistencia.H_salida
from
  asistencia
  inner join empleados on asistencia.ID_empleado = empleados.ID_empleado
  inner join departamentos on departamentos.id = empleados.Departamento
where
  empleados.ID_empleado = 'E-1999'
  and WEEKOFYEAR(asistencia.fecha) = "2";

select
  asistencia.ID_empleado,
  fecha,
  WEEKOFYEAR(asistencia.fecha) AS semana
from
  asistencia
where
  asistencia.ID_empleado = "E-1999"
  and asistencia.fecha = '2024-01-14';

select
  asistencia.ID_empleado,
  fecha,
  DATE_FORMAT(asistencia.fecha, "%m") AS semana
from
  asistencia;

SELECT
  WEEKOFYEAR(NOW()) AS semana;

select
  *
from
  departamentos;

select
  *
from
  horario;

select
  *
from
  dia;

select
  *
from
  departamentos;

select
  *
from
  departamentos;

select
  horario.H_entrada,
  horario.H_salida,
  dia.dia
from
  horario
  inner join dia on horario.dia_id = dia.dia_id
where
  horario.ID_departamento = 1;