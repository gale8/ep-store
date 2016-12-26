/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     26. 12. 2016 18:44:00                        */
/*==============================================================*/


drop table if exists posta;

drop table if exists administrator;

drop table if exists artikel;

drop table if exists narocilo;

drop table if exists narocilo_artikel;

drop table if exists naslov;

drop table if exists prodajalec;

drop table if exists stranka;

/*==============================================================*/
/* Table: posta                                                 */
/*==============================================================*/
create table posta
(
   postna_st            int not null,
   ime_poste            varchar(45) not null,
   primary key (postna_st)
);

/*==============================================================*/
/* Table: administrator                                         */
/*==============================================================*/
create table administrator
(
   email                varchar(45) not null,
   ime                  varchar(45) not null,
   priimek              varchar(45) not null,
   geslo                varchar(45) not null,
   primary key (email)
);

/*==============================================================*/
/* Table: artikel                                               */
/*==============================================================*/
create table artikel
(
   id_artikla           int NOT NULL AUTO_INCREMENT,
   ime_artikla          varchar(45) not null,
   cena                 float(5) not null,
   artikel_aktiviran    bool not null default 0,
   opis_artikla			varchar(45) not null,
   primary key (id_artikla)
);

/*==============================================================*/
/* Table: narocilo                                              */
/*==============================================================*/
create table narocilo
(
   id_narocila          int not null AUTO_INCREMENT,
   email                varchar(45) not null,
   narocilo_potrjeno    bool not null default 0,
   narocilo_preklicano  bool not null default 0,
   narocilo_stornirano  bool not null default 0,
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
   id_naslova           int not null AUTO_INCREMENT,
   postna_st            int not null,
   primary key (id_naslova)
);

/*==============================================================*/
/* Table: prodajalec                                            */
/*==============================================================*/
create table prodajalec
(
   email                varchar(45) not null,
   prodajalec_aktiviran bool not null default 0,
   ime                  varchar(45) not null,
   priimek              varchar(45) not null,
   geslo                varchar(45) not null,
   primary key (email)
);

/*==============================================================*/
/* Table: stranka                                               */
/*==============================================================*/
create table stranka
(
   email                varchar(45) not null,
   id_naslova           int not null,
   ime                  varchar(45) not null,
   priimek              varchar(45) not null,
   geslo                varchar(45) not null,
   tel_st               int not null,
   uporabnik_aktiviran  bool not null default 1,
   primary key (email)
);

alter table narocilo add constraint FK_je_narocil foreign key (email)
      references stranka (email) on delete restrict on update restrict;

alter table narocilo_artikel add constraint FK_narocilo_artikel foreign key (id_narocila)
      references narocilo (id_narocila) on delete restrict on update restrict;

alter table narocilo_artikel add constraint FK_narocilo_artikel2 foreign key (id_artikla)
      references artikel (id_artikla) on delete restrict on update restrict;

alter table naslov add constraint FK_posta_naslov foreign key (postna_st)
      references posta (postna_st) on delete restrict on update restrict;

alter table stranka add constraint FK_stranka_naslov foreign key (id_naslova)
      references naslov (id_naslova) on delete restrict on update restrict;

