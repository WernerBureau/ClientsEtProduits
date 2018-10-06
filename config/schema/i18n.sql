-- auto-generated definition
create table i18n
(
  id          INTEGER not null
    primary key
  autoincrement,
  locale      VARCHAR(6),
  model       VARCHAR(255),
  foreign_key INTEGER,
  field       VARCHAR(255),
  content     TEXT
);

create unique index i18n_locale_model_foreign_key_field_index
  on i18n (locale, model, foreign_key, field);

create index i18n_model_foreign_key_field_index
  on i18n (model, foreign_key, field);

