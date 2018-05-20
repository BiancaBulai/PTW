create table alergii
(
  numea varchar(255) not null,
  ida   int auto_increment
    primary key
);

create table boli
(
  idb   int auto_increment
    primary key,
  numeb int not null
);

create table bucatarii
(
  titlu varchar(255) not null,
  idb   int auto_increment
    primary key
);

create table cantitate
(
  idc     int auto_increment
    primary key,
  gramaj  int          not null,
  unitate varchar(255) not null,
  idi     int          not null
);

create index cantitate_ingrediente_idi_fk
  on cantitate (idi);

create table format
(
  idf   int          not null
    primary key,
  rssf  varchar(255) not null,
  csvf  varchar(255) not null,
  jsonf varchar(255) not null
);

create table imagini
(
  idimg int auto_increment
    primary key,
  cale  varchar(255) not null
);

create table ingrediente
(
  numei  varchar(255) not null,
  idingr int auto_increment
    primary key,
  idc    int          not null,
  constraint ingrediente_cantitate_idc_fk
  foreign key (idc) references cantitate (idc)
    on update cascade
    on delete cascade
);

alter table cantitate
  add constraint cantitate_ingrediente_idi_fk
foreign key (idi) references ingrediente (idingr)
  on update cascade
  on delete cascade;

create index ingrediente_cantitate_idc_fk
  on ingrediente (idc);

create table instrumente
(
  numei   varchar(255) not null,
  idinstr int auto_increment
    primary key
);

create table mese
(
  numem varchar(255) not null,
  idm   int auto_increment
    primary key
);

create table pasi
(
  idp      int auto_increment
    primary key,
  textpasi varchar(300) not null
);

create table preparare
(
  numep varchar(255) not null,
  idpre int auto_increment
    primary key
);

create table regim
(
  numer varchar(255) not null,
  idr   int auto_increment
    primary key
);

create table timp
(
  idt    int auto_increment
    primary key,
  durata int          not null,
  minute varchar(255) not null
);

create table retete
(
  idr     int auto_increment
    primary key,
  titlu   varchar(255) not null,
  fid     int          not null,
  pid     int          not null,
  mid     int          not null,
  tid     int          not null,
  bid     int          not null,
  preid   int          not null,
  instrid int          not null,
  ingrid  int          not null,
  imgid   int          not null,
  constraint utilizatori_retete_titlu_uindex
  unique (titlu),
  constraint retete_format_idf_fk
  foreign key (fid) references format (idf)
    on update cascade
    on delete cascade,
  constraint retete_pasi_idp_fk
  foreign key (pid) references pasi (idp)
    on update cascade
    on delete cascade,
  constraint retete_mese_idm_fk
  foreign key (mid) references mese (idm)
    on update cascade
    on delete cascade,
  constraint retete_timp_idt_fk
  foreign key (tid) references timp (idt)
    on update cascade
    on delete cascade,
  constraint retete_bucatarii_idb_fk
  foreign key (bid) references bucatarii (idb)
    on update cascade
    on delete cascade,
  constraint retete_preparare_idpre_fk
  foreign key (preid) references preparare (idpre)
    on update cascade
    on delete cascade,
  constraint retete_instrumente_idinstr_fk
  foreign key (instrid) references instrumente (idinstr)
    on update cascade
    on delete cascade,
  constraint retete_ingrediente_idingr_fk
  foreign key (ingrid) references ingrediente (idingr),
  constraint retete_imagini_idimg_fk
  foreign key (imgid) references imagini (idimg)
);

create index retete_bucatarii_idb_fk
  on retete (bid);

create index retete_format_idf_fk
  on retete (fid);

create index retete_imagini_idimg_fk
  on retete (imgid);

create index retete_ingrediente_idingr_fk
  on retete (ingrid);

create index retete_instrumente_idinstr_fk
  on retete (instrid);

create index retete_mese_idm_fk
  on retete (mid);

create index retete_pasi_idp_fk
  on retete (pid);

create index retete_preparare_idpre_fk
  on retete (preid);

create index retete_timp_idt_fk
  on retete (tid);

create table retete_boli_alergii_regim
(
  rid  int not null,
  bid  int not null,
  aid  int not null,
  reid int not null,
  constraint retete_boli_alergii_regim_retete_idr_fk
  foreign key (rid) references retete (idr)
    on update cascade
    on delete cascade,
  constraint retete_boli_alergii_regim_boli_idb_fk
  foreign key (bid) references boli (idb)
    on update cascade
    on delete cascade,
  constraint retete_boli_alergii_regim_alergii_ida_fk
  foreign key (aid) references alergii (ida)
    on update cascade
    on delete cascade,
  constraint retete_boli_alergii_regim_regim_idr_fk
  foreign key (reid) references regim (idr)
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
  foreign key (rid) references retete (idr)
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


