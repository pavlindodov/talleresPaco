drop database if exists tienda;
create database tienda;
use tienda;

-- -----------------------------------------------------
-- Table `tienda`.`rol`
-- -----------------------------------------------------
create table rol (
	id int primary key not null,
    nombre varchar(15) not null
);

-- -----------------------------------------------------
-- Table `tienda`.`usuario`
-- -----------------------------------------------------
create table usuario (
	dni char(9) primary key not null,
    nombre varchar(15) not null,
    apellidos varchar(30),
    usuario varchar(15) unique not null,
    contrasenia varchar(64) not null,
    idRol int not null,
    correo varchar(30),
    telefono char(9),
    imgPerfil varchar(255),
    constraint fk_usuario_rol foreign key (idRol) references tienda.rol(id)
);

-- -----------------------------------------------------
-- Table `tienda`.`producto`
-- -----------------------------------------------------
create table producto (
	id int primary key not null auto_increment,
    modelo varchar(40) not null,
    marca varchar(40) not null,
    serie varchar(40) not null,
    fechaFabricacion date,
    precioProducto decimal(9,2) not null,
    stock int,
    descuento int,
    imgArticulo varchar(255)
);

-- -----------------------------------------------------
-- Table `tienda`.`factura`
-- -----------------------------------------------------
create table factura (
	id int primary key not null auto_increment,
    totalFactura decimal(9,2) not null,
    dniCliente char(9) not null,
    fechaFactura datetime not null,
    constraint fk_factura_usuario foreign key (dniCliente) references tienda.usuario(dni)
);

-- -----------------------------------------------------
-- Table `tienda`.`lineaFactura`
-- -----------------------------------------------------
create table lineaFactura (
    idFactura int not null,
    idProducto int not null,
    cantidad int not null,
    precioUd decimal(9,2) not null,
    constraint fk_lineaFactura_producto foreign key (idProducto) references tienda.producto(id),
    constraint fk_lineaFactura_factura foreign key (idFactura) references tienda.factura(id)
);

insert into rol values (1,'administrador'),(2,'usuario');
insert into usuario values ('111111111','Pavlin','Dodov','root','1d7c07570befaf67781dea6735c675c94c4b63cdcde56fcce77bbd781c94ef73',1,'root@gmail.com','673804133','admin.jpg');
insert into usuario values ('222222222','Pavlin','Dodov','pavlin','1d7c07570befaf67781dea6735c675c94c4b63cdcde56fcce77bbd781c94ef73',2,'hola@gmail.com','673804133','default.jpg');