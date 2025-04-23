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


DELIMITER $$

CREATE PROCEDURE sp_obtenerBlogs()
BEGIN
  SELECT 
    id_blog,
    titulo,
    resumen,
    contenido,
    contacto,
    actividades,
    detallado,
    incluye,
    imagen
  FROM Blog
  ORDER BY id_blog ASC;
END$$

CREATE PROCEDURE sp_insertarBlog(
    IN p_titulo      VARCHAR(255),
    IN p_resumen     VARCHAR(1022),
    IN p_contenido   TEXT,
    IN p_contacto    VARCHAR(1022),
    IN p_actividades TEXT,
    IN p_detallado   TEXT,
    IN p_incluye     TEXT,
    IN p_imagen      LONGBLOB
)
BEGIN
  INSERT INTO Blog (
    titulo, resumen, contenido, contacto,
    actividades, detallado, incluye, imagen
  ) VALUES (
    p_titulo, p_resumen, p_contenido, p_contacto,
    p_actividades, p_detallado, p_incluye, p_imagen
  );
  SELECT LAST_INSERT_ID() AS id_blog;
END$$

CREATE PROCEDURE sp_insertarImagenBlog(
    IN p_id_blog INT,
    IN p_imagen  LONGBLOB
)
BEGIN
  INSERT INTO Imagenes_Blog (id_blog, imagen)
    VALUES (p_id_blog, p_imagen);
END$$

CREATE PROCEDURE sp_eliminarBlogCompleto(
    IN p_id_blog INT
)
BEGIN
  DELETE FROM Imagenes_Blog
    WHERE id_blog = p_id_blog;
  DELETE FROM Blog
    WHERE id_blog = p_id_blog;
END$$

CREATE PROCEDURE sp_obtenerBlogPorId(
    IN p_id_blog INT
)
BEGIN
  SELECT
    id_blog, titulo, contenido, contacto,
    actividades, detallado, incluye, imagen
  FROM Blog
  WHERE id_blog = p_id_blog;
END$$

CREATE PROCEDURE sp_obtenerGaleriaPorBlog(
    IN p_id_blog INT
)
BEGIN
  SELECT imagen
  FROM Imagenes_Blog
  WHERE id_blog = p_id_blog;
END$$

DELIMITER ;