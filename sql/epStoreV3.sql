/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     28. 12. 2016 13:25:57                        */
/*==============================================================*/


drop table if exists administrator;

drop table if exists artikel;

drop table if exists narocilo;

drop table if exists narocilo_artikel;

drop table if exists naslov;

drop table if exists posta;

drop table if exists prodajalec;

drop table if exists stranka;

/*==============================================================*/
/* Table: administrator                                         */
/*==============================================================*/
create table administrator
(
   email_admina         varchar(45) not null,
   ime_admina           varchar(45) not null,
   priimek_admina       varchar(45) not null,
   geslo_admina         varchar(160) not null,
   id_admina            int not null,
   primary key (id_admina)
);

/*==============================================================*/
/* Table: artikel                                               */
/*==============================================================*/
create table artikel
(
   id_artikla           int not null,
   ime_artikla          varchar(45) not null,
   cena                 float(5) not null,
   artikel_aktiviran    bool not null,
   opis_artikla         varchar(45),
   primary key (id_artikla)
);

/*==============================================================*/
/* Table: narocilo                                              */
/*==============================================================*/
create table narocilo
(
   id_narocila          int not null,
   id_stranke           int not null,
   narocilo_potrjeno    bool not null,
   narocilo_preklicano  bool not null,
   narocilo_stornirano  bool not null,
   primary key (id_narocila)
);

/*==============================================================*/
/* Table: narocilo_artikel                                      */
/*==============================================================*/
create table narocilo_artikel
(
   id_narocila          int not null,
   id_artikla           int not null,
   primary key (id_narocila, id_artikla)
);

/*==============================================================*/
/* Table: naslov                                                */
/*==============================================================*/
create table naslov
(
   ulica                varchar(45) not null,
   hisna_st             varchar(45) not null,
   id_naslova           int not null,
   id_poste             int not null,
   primary key (id_naslova)
);

/*==============================================================*/
/* Table: posta                                                 */
/*==============================================================*/
create table posta
(
   postna_st            int not null,
   ime_poste            varchar(45) not null,
   id_poste             int not null,
   primary key (id_poste)
);

/*==============================================================*/
/* Table: prodajalec                                            */
/*==============================================================*/
create table prodajalec
(
   email_prodajalca     varchar(45) not null,
   prodajalec_aktiviran bool not null,
   ime_prodajalca       varchar(45) not null,
   priimek_prodajalca   varchar(45) not null,
   geslo_prodjalca      varchar(160) not null,
   id_prodajalca        int not null,
   primary key (id_prodajalca)
);

/*==============================================================*/
/* Table: stranka                                               */
/*==============================================================*/
create table stranka
(
   email_stranke        varchar(45) not null,
   id_naslova           int not null,
   ime_stranke          varchar(45) not null,
   priimek_stranke      varchar(45) not null,
   geslo_stranke        varchar(160) not null,
   tel_st_stranke       int not null,
   stranka_aktivirana   bool not null,
   id_stranke           int not null,
   primary key (id_stranke)
);

alter table narocilo add constraint FK_je_narocil foreign key (id_stranke)
      references stranka (id_stranke) on delete restrict on update restrict;

alter table narocilo_artikel add constraint FK_narocilo_artikel foreign key (id_narocila)
      references narocilo (id_narocila) on delete restrict on update restrict;

alter table narocilo_artikel add constraint FK_narocilo_artikel2 foreign key (id_artikla)
      references artikel (id_artikla) on delete restrict on update restrict;

alter table naslov add constraint FK_posta_naslov foreign key (id_poste)
      references posta (id_poste) on delete restrict on update restrict;

alter table stranka add constraint FK_stranka_naslov foreign key (id_naslova)
      references naslov (id_naslova) on delete restrict on update restrict;

