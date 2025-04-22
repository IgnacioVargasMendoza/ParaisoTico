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