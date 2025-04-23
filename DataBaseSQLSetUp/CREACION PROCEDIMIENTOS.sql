DELIMITER $$
CREATE PROCEDURE SP_ConsultarProvincias()
BEGIN
    SELECT 
        id_provincias,
        nombre
    FROM Provincias
    WHERE activo = 1; 
END 
$$
DELIMITER ;
CALL SP_ConsultarProvincias();

DELIMITER $$
CREATE PROCEDURE SP_ConsultarCantones()
BEGIN
    SELECT 
        id_canton,
        nombre,
        id_provincias
    FROM Canton
    WHERE activo = 1; 
END 
$$
DELIMITER ;
CALL SP_ConsultarCantones();

DELIMITER $$
CREATE PROCEDURE SP_CrearActividad( p_nombre VARCHAR(25), p_descripcion VARCHAR(500), p_precio DOUBLE, p_punto_encuentro VARCHAR(25), 
p_descripcion_incluye VARCHAR(500), p_id_categorias INT,
p_id_canton INT, p_foto VARCHAR(200)
)
BEGIN
    INSERT INTO Actividades
    (nombre, descripcion, precio, punto_encuentro, incluye, id_categorias, id_canton, foto, activo)
    VALUES
    (p_nombre, p_descripcion, p_precio, p_punto_encuentro,  p_descripcion_incluye, p_id_categorias, p_id_canton, p_foto, p_activo );
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE SP_ConsultarCategorias()
BEGIN
    SELECT 
        id_categoria, 
        nombre
    FROM Categorias; 
END $$
DELIMITER ;

ALTER TABLE actividades
    MODIFY COLUMN activo TINYINT(1) NOT NULL DEFAULT 1;
    
ALTER TABLE categorias
    MODIFY COLUMN activo TINYINT(1) NOT NULL DEFAULT 1;

INSERT INTO db_paraisotico.categorias(nombre) VALUES("Aventura");
select * from categorias;


