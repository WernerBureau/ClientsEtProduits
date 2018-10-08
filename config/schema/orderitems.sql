-- auto-generated definition
create table order_items
(
  id INTEGER not null primary key autoincrement,
  order_id   INTEGER,
  product_id INTEGER,
  quantity   INTEGER,
  total      DECIMAL(9, 2) default 0.00
);

