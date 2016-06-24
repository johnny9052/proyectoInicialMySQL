-- ----------------------------------------------------------------------------
-- MySQL Workbench Migration
-- Migrated Schemata: proyectoInicial
-- Source Schemata: proyectoInicial
-- Created: Wed Jun 22 17:40:29 2016
-- Workbench Version: 6.3.7
-- ----------------------------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------------------------------------------------------
-- Schema proyectoInicial
-- ----------------------------------------------------------------------------
DROP SCHEMA IF EXISTS `proyectoInicial` ;
CREATE SCHEMA IF NOT EXISTS `proyectoInicial` ;

-- ----------------------------------------------------------------------------
-- Table proyectoInicial.menu
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyectoInicial`.`menu` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(30) NULL,
  `codigo` VARCHAR(2000) NULL,
  `padre` INT NULL,
  `descripcion` VARCHAR(2000) NULL,
  `prioridad` INT NULL,
  PRIMARY KEY (`id`));

-- ----------------------------------------------------------------------------
-- Table proyectoInicial.menu_rol
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyectoInicial`.`menu_rol` (
  `idrol` INT NULL,
  `idmenu` INT NULL,
  CONSTRAINT `menu_usuario_idmenu_fkey`
    FOREIGN KEY (`idmenu`)
    REFERENCES `proyectoInicial`.`menu` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `menu_usuario_idrol_fkey`
    FOREIGN KEY (`idrol`)
    REFERENCES `proyectoInicial`.`rol` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table proyectoInicial.rol
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyectoInicial`.`rol` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NULL,
  `descripcion` VARCHAR(2000) NULL,
  PRIMARY KEY (`id`));

-- ----------------------------------------------------------------------------
-- Table proyectoInicial.usuario
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyectoInicial`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `primer_nombre` VARCHAR(50) NULL,
  `segundo_nombre` VARCHAR(50) NULL,
  `primer_apellido` VARCHAR(50) NULL,
  `segundo_apellido` VARCHAR(50) NULL,
  `usuario` VARCHAR(50) NULL,
  `password` VARCHAR(50) NULL,
  `rol` INT NULL,
  `descripcion` VARCHAR(2000) NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `usuario_rol_fkey`
    FOREIGN KEY (`rol`)
    REFERENCES `proyectoInicial`.`rol` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
SET FOREIGN_KEY_CHECKS = 1;






DROP PROCEDURE IF EXISTS login;
DELIMITER //
CREATE PROCEDURE login(usu VARCHAR(50), pass VARCHAR(50))
COMMENT 'Procedimiento que valida las credenciales de un usuairo'
BEGIN
   select usuario,primer_nombre,primer_apellido,rol from Usuario where password=pass and usuario=usu;		
END//

DELIMITER ;



DELIMITER //
CREATE FUNCTION deleterol(cod INT) RETURNS INT(1)
COMMENT 'Funcion que elimina un rol'
READS SQL DATA
DETERMINISTIC
BEGIN
	DECLARE res INT default 0;	
    delete from rol where id = cod;
	SET res = 1;
	RETURN res;
END//

DELIMITER ;





DELIMITER //
CREATE FUNCTION deleteuser(vid INT) RETURNS INT( 1 ) 
COMMENT  'Funcion que elimina un usuario'
READS SQL DATA 
DETERMINISTIC 
BEGIN 
    DECLARE res INT DEFAULT 0;
    DELETE FROM usuario WHERE id = vid;
SET res = 1;
	RETURN res;
END//

DELIMITER ;







DELIMITER //
CREATE PROCEDURE listrol(iduser int)
COMMENT 'Procedimiento que lista los roles de un determinado usuario'
BEGIN
   select id,nombre as nombre_rol,descripcion 
   from rol
   order by nombre;
END//

DELIMITER ;








DELIMITER //
CREATE PROCEDURE listuser(iduser int)
COMMENT 'Procedimiento que lista los usuarios'
BEGIN
   
	SELECT us.id, us.primer_nombre as primer_nombre, us.primer_apellido as primer_apellido, us.usuario as nickname, r.nombre as rol, 
	       us.descripcion as descripcion
	FROM usuario as us
	INNER JOIN rol as r on r.id = us.rol
	ORDER BY us.primer_nombre;

END//

DELIMITER ;








DELIMITER //
CREATE PROCEDURE loadallmenu()
COMMENT 'Procedimiento que lista todos los menus del sistema'
BEGIN
   
	select m.id,m.nombre,m.codigo,m.padre as codpadre,m2.nombre as nombrepadre,m.prioridad
	from Menu as m
	left JOIN menu as m2 on m.padre = m2.id	
	order by m.prioridad;

END//

DELIMITER ;





DELIMITER //
CREATE PROCEDURE loadapage(vpage varchar(2000),vrol int)
COMMENT 'Procedimiento que lista los menus'
BEGIN
   
	select m.codigo
	from Menu as m 	
	inner join menu_rol as mr on mr.idmenu = m.id
	where mr.idrol = vrol AND m.codigo = vpage;	

END//

DELIMITER ;














DELIMITER //
CREATE PROCEDURE loadmenu(rol int)
COMMENT 'Procedimiento que lista los menus de un determinado rol'
BEGIN
   
	select m.id,m.nombre,m.codigo,m.padre as codpadre,m2.nombre as nombrepadre,mr.idrol,m.prioridad
	from Menu as m
	left JOIN menu as m2 on m.padre = m2.id
	LEFT join menu_rol as mr on mr.idmenu = m.id
	where (mr.idrol = rol OR (m.padre = -1 AND (mr.idrol = rol OR mr.idrol IS NULL)))
	order by m.prioridad;
END//

DELIMITER ;







DELIMITER //
CREATE PROCEDURE loadrol(idfilter int,iduser int)
COMMENT 'Procedimiento que lista los roles'
BEGIN
 
	IF idfilter > -1 THEN
	
		select id,nombre
		from rol
		ORDER BY nombre;
		
   ELSE	
	
		select id,nombre
		from rol
		ORDER BY nombre;
	
   END IF;

END//

DELIMITER ;









DELIMITER //
CREATE FUNCTION saverol(cod INT,nom varchar(50),des varchar(2000)) RETURNS INT( 1 ) 
COMMENT  'Funcion que almacena un rol'
READS SQL DATA 
DETERMINISTIC 
BEGIN 
    DECLARE res INT DEFAULT 0;
    
IF NOT EXISTS(select nombre from rol where nombre=nom)
		THEN
			insert into rol(nombre,descripcion) values(nom,des);	
			set res = 1;							
			
		END IF;

	RETURN res;
	

END//

DELIMITER ;











DELIMITER //
CREATE FUNCTION saveuser(id int, vfirstname varchar(50), vsecondname varchar(50), vfirstlastname varchar(50), vsecondlastname varchar(50), vuser varchar(50), vpass varchar(50), vrol int, vdescription varchar(50)) RETURNS INT( 1 ) 
COMMENT  'Funcion que almacena un rol'
READS SQL DATA 
DETERMINISTIC 
BEGIN 
    DECLARE res INT DEFAULT 0;
    
IF NOT EXISTS(select usuario from usuario where usuario=vuser)
		THEN
			insert into usuario(primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, 
					   usuario, password, rol,descripcion)
			VALUES (vfirstname,vsecondname,vfirstlastname,vsecondlastname,vuser,vpass,vrol,vdescription);
			set res = 1;
			
				
			
		END IF;

	RETURN res;
	
	

END//

DELIMITER ;





DELIMITER //
CREATE PROCEDURE searchrol(idrol int)
COMMENT 'Procedimiento que carga la informacion de un rol'
BEGIN
 
	
	select id,nombre,descripcion
	from rol
	where id = idrol;
	
END//

DELIMITER ;





DELIMITER //
CREATE PROCEDURE searchuser(vid int)
COMMENT 'Procedimiento que carga la informacion de un usuario'
BEGIN
 	
	SELECT id, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, 
	usuario, rol, descripcion
	FROM usuario
	where id = vid;	
	
END//

DELIMITER ;








DELIMITER //
CREATE FUNCTION updaterol(cod INT,nom varchar(50),des varchar(2000)) RETURNS INT( 1 ) 
COMMENT  'Funcion que modifica un rol'
READS SQL DATA 
DETERMINISTIC 
BEGIN 
    DECLARE res INT DEFAULT 0;
    
IF NOT EXISTS(select nombre from rol where nombre=nom and id<>cod)
		THEN
			update rol set nombre = nom,descripcion = des where id = cod;		
			set res=1;
														
		END IF;

	RETURN res;
	

END//

DELIMITER ;









DELIMITER //
CREATE FUNCTION updateuser(vid int, vfirstname varchar(50), vsecondname varchar(50), vfirstlastname varchar(50), vsecondlastname varchar(50), vuser varchar(50), vpass varchar(50), vrol int, vdescription varchar(50)) RETURNS INT( 1 ) 
COMMENT  'Funcion que modifica un rol'
READS SQL DATA 
DETERMINISTIC 
BEGIN 
    DECLARE res INT DEFAULT 0;
    
IF NOT EXISTS(select usuario from usuario where usuario=vuser and id<>vid)
		THEN

UPDATE usuario
   SET  primer_nombre=vfirstname, segundo_nombre=vsecondname, primer_apellido=vfirstlastname, segundo_apellido=vsecondlastname, 
       usuario=vuser, password= vpass, rol=vrol, descripcion=vdescription
 WHERE id=vid;

			
			set res=1;
								
			
		END IF;

	RETURN res;
	

END//

DELIMITER ;










DELIMITER //
CREATE FUNCTION  updatepermission (vid integer, vpermission varchar(2000)) RETURNS INT( 1 ) 
COMMENT  'Funcion que actualiza los permisos de un rol'
READS SQL DATA 
DETERMINISTIC 
BEGIN 
    DECLARE res INT DEFAULT 0;
    /*Variable que contendra el permiso a almacenar*/
    DECLARE permiso varchar(50) DEFAULT '';    

    /*Se borra todos los permisos existentes del usuario*/
    delete from menu_rol where idrol = vid;
    
    WHILE (LOCATE(',', vpermission) > 0) DO
        /*Se saca el primer campo separado por coma del varchar*/
    	SET permiso = ELT(1, vpermission);
        /*Se elimina ese primer valor y se reemplaza en la cadena*/
    	SET vpermission = SUBSTRING(vpermission, LOCATE(',',vpermission) + 1);
        /*Se almacena en la tabla, siempre y cuando tenga un dato para almacenar*/
		IF permiso <> ',' THEN	
    		INSERT INTO menu_rol(idrol, idmenu) VALUES (vid, permiso);
		END IF;
    END WHILE;

    SET res = 1;

    RETURN res;	
END//

DELIMITER ;
