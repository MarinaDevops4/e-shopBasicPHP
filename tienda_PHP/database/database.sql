CREATE DATABASE tienda_master;
use tienda_master;

CREATE TABLE usuarios ( 
    id int(255) PRIMARY KEY auto_increment not null, 
    nombre VARCHAR(255) not null, 
    apellidos VARCHAR(255), 
    email VARCHAR(255) not null, 
    password VARCHAR(255) not null,
    rol VARCHAR(20), 
    img VARCHAR(255),   
    CONSTRAINT uq_email UNIQUE(email)
    
)ENGINE = InnoDB;

INSERT INTO usuarios VALUES(null, 'admin', 'admin', 'admin@admin.com', '123', 'Administrador', null);

CREATE TABLE categorias ( 
    id int(255) PRIMARY KEY auto_increment not null, 
    nombre VARCHAR(255) not null, 
    
    
)ENGINE = InnoDB;

INSERT INTO categorias VALUES(null, 'principiantes');
INSERT INTO categorias VALUES(null, 'avanzado');
INSERT INTO categorias VALUES(null, 'experto');

CREATE TABLE productos ( 
    id int(255) PRIMARY KEY auto_increment not null, 
    categoria_id int(255)  not null, 
    nombre VARCHAR(255) not null, 
    descripcion text, 
    precio float(100,2) not null, 
    stock int(255) not null,
    oferta VARCHAR(2), 
    fecha DATE,   
    imagen varchar(255),   
    CONSTRAINT fk_producto_categoria FOREIGN KEY (categoria_id) REFERENCES categorias(id)
    
)ENGINE = InnoDB;

CREATE TABLE pedidos ( 
    id int(255) PRIMARY KEY auto_increment not null, 
    usuario_id int(255)  not null, 
    provincia VARCHAR(255) not null, 
    localidad VARCHAR(255) not null, 
    direccion VARCHAR(255) not null, 
    coste FLOAT(100,2) not null,
    estado VARCHAR(25) not null, 
    fecha DATE,   
    hora TIME, 
    CONSTRAINT fk_pedido_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id) 
    
)ENGINE = InnoDB;

CREATE TABLE lineas_pedidos(
    id int(255) PRIMARY KEY auto_increment not null,
    pedido_id int(255) not null, 
    producto_id int(255) not null, 
    unidades int(100) not null, 
    CONSTRAINT fk_lineasPedido FOREIGN KEY (pedido_id) REFERENCES pedidos(id),
    CONSTRAINT fk_lineasProducto FOREIGN KEY (producto_id) REFERENCES producto(id)
)ENGINE = InnoDB;