create table providers (
	prov_id serial primary key,
	prov_title varchar(30) not null
);

insert into providers (prov_title) values
	( 'Comedor "BuenDía"'),
	( 'Bunker "Sra. Rosa"'),
	( 'Comedor "La Providencia"'),
	( 'Bunker "Tu vecina"'),
	( 'Sra. Josefa Encalada'),
	( 'Don Silvio Landazuri');

create table cart
	(id serial primary key,
	ip_add varchar(250) not null,
	p_id integer,
	user_id integer default null,
	qty integer not null
   );

create table categories (
	cat_id serial primary key,
	cat_title varchar not null
		);

insert into categories (cat_title) values
	( 'Desayunos'),
	( 'Almuerzos'),
	( 'Meriendas'),
	( 'Postres'),
	( 'Bebidas'),
	( 'Entradas'),
	( 'Ensaladas'),
	( 'Otros');

create table orders (
	order_id serial primary key,
	user_id integer,
	product_id integer not null,
	qty integer not null,
	trx_id varchar not null,
	p_status varchar not null
);

insert into orders (user_id, product_id, qty, trx_id, p_status)values
	(2, 7, 1, '07M47684BS5725041', 'Completed'),
	(2, 2, 1, '07M47684BS5725041', 'Completed');


create table products (
	product_id serial primary key,
	user_id integer,
	stock integer,
	limit_date date,
	register_date TIMESTAMP,
	product_cat integer,
	product_prov integer,
	product_title varchar not null,
	product_price numeric not null,
	product_desc varchar not null,
	product_image varchar not null,
	product_keywords varchar not null
);

insert into products (user_id, stock, limit_date, register_date, product_cat, product_prov, product_title, product_price, product_desc, product_image, product_keywords)values
	( 1, 10, '2018-05-18', now(), 3, 1, 'Desayuno Normal', 2.50, 'Emparedado, huevos fritos, jugo y leche/café', 'desayuno_n.jpg', 'comida desayuno'),
	( 1, 10, '2018-05-18', now(), 1, 2, 'Desayuno Express', 1.75, 'Emparedado y leche/café', 'desayuno_e.jpg', 'comida desayuno'),
	( 1, 10, '2018-05-18', now(), 1, 3, 'Desayuno Continental', 3.50, 'Huevos revueltos, chorizo, emparedado, jugo y leche/café', 'desayuno_c.jpg', 'comida desayuno'),
	( 1, 10, '2018-05-18', now(), 2, 1, 'Almuerzo Completo', 2.50, 'Seco de carne, jugo de piña y ensalada de tomate', 'almuerzo_1.jpg', 'comida almuerzo'),
	( 1, 10, '2018-05-18', now(), 2, 2, 'Almuerzo Completo', 3.00, 'Corvina frita, papas fritas, curtido y jugo de piña', 'almuerzo_2.jpg', 'comida almuerzo'),
	( 1, 10, '2018-05-18', now(), 2, 3, 'Almuerzo Completo', 2.25, 'Pollo al horno, pure de papas y jugo de piña', 'almuerzo_3.jpg', 'comida almuerzo'),
	( 1, 10, '2018-05-18', now(), 3, 2, 'Merienda Completa', 2.25, 'Pollo broster con papas fritas y café', 'merienda_1.jpg', 'comida merienda'),
	( 1, 10, '2018-05-18', now(), 4, 1, 'Pay de chocolate', 1.50, 'Porción de pay de chocolate. Fresco y delicioso.', 'postre_1.jpg', 'comida postre'),
	( 1, 10, '2018-05-18', now(), 4, 2, 'Exquisita tarta', 2.25, 'Tarta de queso con frambuesas', 'postre_2.jpg', 'comida postre'),
	( 1, 10, '2018-05-18', now(), 5, 3, 'Jugos naturales', 1.50, 'Vasos de jugo 100% Natural: Fresa, manzana y limón', 'bebida_1.jpg', 'bebida jugo'),
	( 1, 10, '2018-05-18', now(), 5, 2, 'Cerveza Pilsener', 2.25, 'Cerveza Pilsener de 1 Litro', 'bebida_2.jpg', 'bebida cerveza'),
	( 1, 10, '2018-05-18', now(), 6, 1, 'Aguacates Rellenos', 2.00, 'Aguacates rellenos de queso mozarella', 'entrada_1.jpg', 'comida entrada'),
	( 1, 10, '2018-05-18', now(), 7, 2, 'Ensalada de verduras', 2.75, 'Ensalada de apio, tomate y agua', 'ensalada_1.jpg', 'comida ensalada'),
	( 1, 10, '2018-05-18', now(), 8, 3, 'Cigarrillos en oferta', 5.25, 'Vendo media de cigarrillos Lider', 'otros_1.jpg', 'otros cigarros cigarrillos');

create table user_info (
	user_id serial primary key ,
	first_name varchar not null,
	last_name varchar not null,
	email varchar not null,
	password varchar(300) not null,
	mobile varchar (10) not null,
	address1 varchar not null,
	address2 varchar not NULL
);

insert into user_info (first_name, last_name, email, password, mobile, address1, address2)values
	( 'Henry', 'Caraguay', 'henry.caraguay@gmail.com', '1234567890loja', '0986100449', 'Loja', 'La Banda'),
	( 'Jose', 'Serquive', 'jose.seraquive@yahoo.com', '1234567890quito', '0987654321', 'Quito', 'El Valle');
