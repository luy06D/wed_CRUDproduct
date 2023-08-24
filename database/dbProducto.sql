CREATE DATABASE wproducto;
USE wproducto;

CREATE TABLE productos
(
idproducto 		INT AUTO_INCREMENT PRIMARY KEY,
tipo			CHAR(1)	NOT NULL,
descripcion 	VARCHAR(70)  NULL,
precio			DECIMAL(7,2) NOT NULL,
fechavencimiento DATE NULL,
presentacion	VARCHAR(20) NOT NULL,
lote			CHAR(1) NOT NULL,
create_at		DATETIME DEFAULT NOW(),
inactive_at		DATETIME,
update_at		DATETIME
)ENGINE = INNODB;

insert into productos (tipo, precio, presentacion, lote) values
		('R', 500, 'caja', 'A');

-- LISTAR PRODUCTOS

DELIMITER $$
CREATE PROCEDURE spu_listar_product()
BEGIN 
	SELECT tipo, descripcion, precio, presentacion,
    lote, create_at
    FROM productos
	WHERE inactive_at IS NULL
	ORDER BY idproducto DESC;
END $$

CALL spu_listar_product();

-- REGISTRAR PRODUCTOS
DELIMITER $$
CREATE PROCEDURE spu_registrar_product
(
IN _tipo CHAR(1),
IN _descripcion	VARCHAR(70),
IN _precio		DECIMAL(7,2),
IN _fechavencimiento	DATE,
IN _presentacion	VARCHAR(20),
IN _lote	CHAR(1)
)
BEGIN
	INSERT INTO productos (tipo, descripcion, precio, fechavencimiento, presentacion, lote) VALUES
		(_tipo, _descripcion, _precio, _fechavencimiento, _presentacion, _lote); 
END $$

CALL spu_registrar_product('C','prueba 3',300,'2025-06-04', 'paquetes', 'C');

DELIMITER $$
CREATE PROCEDURE spu_producto_update
(
IN _idproducto INT,
IN _tipo CHAR(1),
IN _descripcion	VARCHAR(70),
IN _precio		DECIMAL(7,2),
IN _fechavencimiento	DATE,
IN _presentacion	VARCHAR(20),
IN _lote	CHAR(1)
)
BEGIN 
	UPDATE productos SET
	tipo 				= _tipo,
    descripcion 		= NULLIF(_descripcion, ''),
    precio 				= _precio,
    fechavencimiento 	= NULLIF(_fechavencimiento, ''),
    presentacion 		= _presentacion,
    lote				= _lote,
    update_at 			= NOW()
    WHERE idproducto = _idproducto;
END $$

CALL spu_producto_update( 2 ,'C','prueba 3', 300 ,'2024-05-23', 'paquetes', 'C');


DELIMITER $$ 
CREATE PROCEDURE spu_get_producto(IN _idproducto INT)
BEGIN 
	SELECT  tipo, descripcion, precio,
			fechavencimiento, presentacion, lote
    FROM productos;
END $$

CALL spu_get_producto(3);

DELIMITER $$
CREATE PROCEDURE spu_producto_delete(IN _idproducto INT)
BEGIN 
	UPDATE productos SET 
    inactive_at = NOW()
    WHERE idproducto = _idproducto;
END $$

CALL spu_producto_delete(3);





        
        
        
        
        
        
        
        
        
        
        