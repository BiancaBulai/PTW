create table alergii
(
  numealergie varchar(255) not null,
  idalergie   int auto_increment
    primary key
);

create table boli
(
  idboala   int auto_increment
    primary key,
  numeboala varchar(255) not null
);

create table bucatarii
(
  numebucatarie varchar(255) not null,
  idbucatarie   int auto_increment
    primary key
);

create table cantitate
(
  idcantitate  int auto_increment
    primary key,
  gramaj       int          not null,
  unitate      varchar(255) not null,
  ingredientid int          not null
);

create index cantitate_ingrediente_idi_fk
  on cantitate (ingredientid);

create table format
(
  idformat int          not null
    primary key,
  rssf     varchar(255) not null,
  csvf     varchar(255) not null,
  jsonf    varchar(255) not null
);

create table imagini
(
  idimg int auto_increment
    primary key,
  cale  varchar(255) not null
);

create table ingrediente
(
  numeingredient varchar(255) not null,
  idingredient   int auto_increment
    primary key,
  cantitateid    int          not null,
  constraint ingrediente_cantitate_idc_fk
  foreign key (cantitateid) references cantitate (idcantitate)
    on update cascade
    on delete cascade
);

alter table cantitate
  add constraint cantitate_ingrediente_idi_fk
foreign key (ingredientid) references ingrediente (idingredient)
  on update cascade
  on delete cascade;

create index ingrediente_cantitate_idc_fk
  on ingrediente (cantitateid);

create table instrumente
(
  numeinstrument varchar(255) not null,
  idinstrument   int auto_increment
    primary key
);

create table mese
(
  numemasa varchar(255) not null,
  idmasa   int auto_increment
    primary key
);

create table pasi
(
  idpas   int auto_increment
    primary key,
  textpas varchar(300) not null
);

create table preparare
(
  metodapreparare varchar(255) not null,
  idpreparare     int auto_increment
    primary key
);

create table regim
(
  numeregim varchar(255) not null,
  idregim   int auto_increment
    primary key
);

create table timp
(
  idtimp int auto_increment
    primary key,
  durata int          not null,
  minute varchar(255) not null
);

create table retete
(
  idreteta     int auto_increment
    primary key,
  titlu        varchar(255) not null,
  formatid     int          not null,
  pasid        int          not null,
  masaid       int          not null,
  timpid       int          not null,
  bucatarieid  int          not null,
  preparareid  int          not null,
  instrumentid int          not null,
  ingredientid int          not null,
  imaginiid    int          not null,
  constraint utilizatori_retete_titlu_uindex
  unique (titlu),
  constraint retete_format_idf_fk
  foreign key (formatid) references format (idformat)
    on update cascade
    on delete cascade,
  constraint retete_pasi_idp_fk
  foreign key (pasid) references pasi (idpas)
    on update cascade
    on delete cascade,
  constraint retete_mese_idm_fk
  foreign key (masaid) references mese (idmasa)
    on update cascade
    on delete cascade,
  constraint retete_timp_idt_fk
  foreign key (timpid) references timp (idtimp)
    on update cascade
    on delete cascade,
  constraint retete_bucatarii_idbucatarie_fk
  foreign key (bucatarieid) references bucatarii (idbucatarie)
    on update cascade
    on delete cascade,
  constraint retete_preparare_idpre_fk
  foreign key (preparareid) references preparare (idpreparare)
    on update cascade
    on delete cascade,
  constraint retete_instrumente_idinstr_fk
  foreign key (instrumentid) references instrumente (idinstrument)
    on update cascade
    on delete cascade,
  constraint retete_ingrediente_idingr_fk
  foreign key (ingredientid) references ingrediente (idingredient),
  constraint retete_imagini_idimg_fk
  foreign key (imaginiid) references imagini (idimg)
);

create index retete_bucatarii_idbucatarie_fk
  on retete (bucatarieid);

create index retete_format_idf_fk
  on retete (formatid);

create index retete_imagini_idimg_fk
  on retete (imaginiid);

create index retete_ingrediente_idingr_fk
  on retete (ingredientid);

create index retete_instrumente_idinstr_fk
  on retete (instrumentid);

create index retete_mese_idm_fk
  on retete (masaid);

create index retete_pasi_idp_fk
  on retete (pasid);

create index retete_preparare_idpre_fk
  on retete (preparareid);

create index retete_timp_idt_fk
  on retete (timpid);

create table retete_boli_alergii_regim
(
  rid  int not null,
  bid  int not null,
  aid  int not null,
  reid int not null,
  constraint retete_boli_alergii_regim_retete_idr_fk
  foreign key (rid) references retete (idreteta)
    on update cascade
    on delete cascade,
  constraint retete_boli_alergii_regim_boli_idb_fk
  foreign key (bid) references boli (idboala)
    on update cascade
    on delete cascade,
  constraint retete_boli_alergii_regim_alergii_ida_fk
  foreign key (aid) references alergii (idalergie)
    on update cascade
    on delete cascade,
  constraint retete_boli_alergii_regim_regim_idr_fk
  foreign key (reid) references regim (idregim)
    on update cascade
    on delete cascade
);

create index retete_boli_alergii_regim_alergii_ida_fk
  on retete_boli_alergii_regim (aid);

create index retete_boli_alergii_regim_boli_idb_fk
  on retete_boli_alergii_regim (bid);

create index retete_boli_alergii_regim_regim_idr_fk
  on retete_boli_alergii_regim (reid);

create index retete_boli_alergii_regim_retete_idr_fk
  on retete_boli_alergii_regim (rid);

create table utilizatori
(
  id           int auto_increment
    primary key,
  email        varchar(100) not null,
  parola       varchar(100) not null,
  nume         varchar(255) not null,
  prenume      varchar(255) not null,
  datanasterii date         not null,
  constraint users_email_uindex
  unique (email)
);

create table utilizatori_retete
(
  rid int not null,
  uid int not null,
  constraint utilizatori_retete_retete_idr_fk
  foreign key (rid) references retete (idreteta)
    on update cascade
    on delete cascade,
  constraint utilizatori_retete_utilizatori_id_fk
  foreign key (uid) references utilizatori (id)
    on update cascade
    on delete cascade
);

create index utilizatori_retete_retete_idr_fk
  on utilizatori_retete (rid);

create index utilizatori_retete_utilizatori_id_fk
  on utilizatori_retete (uid);


