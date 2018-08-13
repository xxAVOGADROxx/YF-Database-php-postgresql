create table user_info
(user_id serial,
first_name character varying (20),
last_name1 character varying (20),
last_name2 character varying (20),
dependence character varying (50),
email character varying (50),
password character varying (300),
contact_number	character varying (10));


create table cart --historial
(id integer,
ip_add character varying(250),
p_id integer,
user_id integer,
qty integer)


create table order -- facture
(order_id serial,  -- automatico
user_id character varying (40),
dependence character varying (20),
date_order timestamp
);


create table requirements --items facture
(user_id integer,
requirements_id serial, -- automatico
orden_id integer,
requirement character varying(500),
date_solution timestamp,
solution  varchar,
equipment varchar,
type_of_atten character varying(30)
observations varchar
);
