-- auto-generated definition
create table products
(
  id          INTEGER
    primary key
  autoincrement,
  type_id     INTEGER       not null
    constraint products_product_types_id_fk
    references product_types
      on update cascade
      on delete cascade,
  name        varchar,
  price       decimal(9, 2) not null,
  description varchar,
  created     datetime      not null,
  modified    datetime      not null
);

