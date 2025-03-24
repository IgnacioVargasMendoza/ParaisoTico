#SELECT * FROM db_paraisotico.provincias;
# SELECT * FROM db_paraisotico.canton;

# Insert Provincias Costa Rica
INSERT INTO db_paraisotico.provincias(nombre, activo) VALUES
("San Jose", true),
("Alajuela", true),
("Cargago", true),
("Heredia", true),
("Guanacaste", true),
("Puntarenas", true),
("Limon", true);

#Insert - Cantones San Jose
INSERT INTO db_paraisotico.canton(id_provincias, nombre, activo) VALUES
(1,"San José",true),
(1,"Escazú",true),
(1,"Desamparados",true),
(1,"Aserrí",true),
(1,"Puriscal",true),
(1,"Mora",true),
(1,"Tarrazú",true),
(1,"Tarrazú",true),
(1,"Goicoechea",true),
(1,"Santa Ana",true);

#Insert - Cantones Alajuela
INSERT INTO db_paraisotico.canton(id_provincias, nombre, activo) VALUES
(2,"Alajuela",true),
(2,"San Ramón",true),
(2,"Grecia",true),
(2,"Atenas",true),
(2,"Naranjo",true),
(2,"Palmares",true),
(2,"Poás",true),
(2,"Orotina",true);

#Insert - Cantones Cartago
INSERT INTO db_paraisotico.canton(id_provincias, nombre, activo) VALUES
(3,"Alvarado",true),
(3,"Cartago",true),
(3,"El Guarco",true),
(3,"Jiménez",true),
(3,"La Unión",true),
(3,"Paraíso",true),
(3,"Turrialba",true);

#Insert - Cantones Heredia
INSERT INTO db_paraisotico.canton(id_provincias, nombre, activo) VALUES
(4,"Barva",true),
(4,"Flores",true),
(4,"Heredia",true),
(4,"San Isidro",true),
(4,"San Pablo",true),
(4,"San Rafael",true),
(4,"Santa Bárbara",true),
(4,"Sarapiquí",true),
(4,"Santo Domingo.",true);

#Insert - Cantones Guanacaste
INSERT INTO db_paraisotico.canton(id_provincias, nombre, activo) VALUES
(5,"Abangares",true),
(5,"Bagaces",true),
(5,"Cañas",true),
(5,"Carrillo",true),
(5,"La Cruz",true),
(5,"Liberia",true),
(5,"Nandayure",true),
(5,"Santa Cruz",true),
(5,"Tilarán",true);

#Insert - Cantones Puntarenas
INSERT INTO db_paraisotico.canton(id_provincias, nombre, activo) VALUES
(6,"Puntarenas",true),
(6,"Esparza",true),
(6,"Buenos Aires",true),
(6,"Montes de Oro",true),
(6,"Osa",true),
(6,"Quepos",true),
(6,"Golfito",true),
(6,"Coto Brus",true),
(6,"Parrita",true),
(6,"Corredores",true),
(6,"Garabito",true);

#Insert - Cantones Limon
INSERT INTO db_paraisotico.canton(id_provincias, nombre, activo) VALUES
(7,"Limon",true),
(7,"Pococí",true),
(7,"Siquirres",true),
(7,"Talamanca",true),
(7,"Guácimo",true),
(7,"Matina",true);

 















