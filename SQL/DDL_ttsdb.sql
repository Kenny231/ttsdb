/*==============================================================*/
/* Database name:  TTSDB                                        */
/* DBMS name:      Microsoft SQL Server 2012                    */
/* Created on:     22-4-2016 11:50:09                           */
/*==============================================================*/


drop database TTSDB
go

/*==============================================================*/
/* Database: TTSDB                                              */
/*==============================================================*/
create database TTSDB
go

use TTSDB
go

create rule R_D_GESLACHT as
      @column in ('M','V')
go

create rule R_D_LICENTIE as
      @column in ('A','B','C','D','E','F','G','H')
go

create rule R_D_SET as
      @column between 1 and 3
go

create rule R_D_TOERNOOITYPE as
      @column in ('Prestatie','Familie','Ladder')
go

/*==============================================================*/
/* Domain: D_BOOLEAN                                            */
/*==============================================================*/
create type D_BOOLEAN
   from bit
go

/*==============================================================*/
/* Domain: D_CATNAME                                            */
/*==============================================================*/
create type D_CATNAME
   from varchar(15)
go

/*==============================================================*/
/* Domain: D_DATE                                               */
/*==============================================================*/
create type D_DATE
   from datetime
go

/*==============================================================*/
/* Domain: D_EMAIL                                              */
/*==============================================================*/
create type D_EMAIL
   from varchar(100)
go

/*==============================================================*/
/* Domain: D_GEBDATUM                                           */
/*==============================================================*/
create type D_GEBDATUM
   from datetime
go

/*==============================================================*/
/* Domain: D_GESLACHT                                           */
/*==============================================================*/
create type D_GESLACHT
   from char(1)
go

execute sp_bindrule R_D_GESLACHT, D_GESLACHT
go

/*==============================================================*/
/* Domain: D_HUISNUMMER                                         */
/*==============================================================*/
create type D_HUISNUMMER
   from varchar(10)
go

/*==============================================================*/
/* Domain: D_ID                                                 */
/*==============================================================*/
create type D_ID
   from int
go

/*==============================================================*/
/* Domain: D_LEEFTIJD                                           */
/*==============================================================*/
create type D_LEEFTIJD
   from int
go

/*==============================================================*/
/* Domain: D_LICENTIE                                           */
/*==============================================================*/
create type D_LICENTIE
   from char(1)
go

execute sp_bindrule R_D_LICENTIE, D_LICENTIE
go

/*==============================================================*/
/* Domain: D_NAAM                                               */
/*==============================================================*/
create type D_NAAM
   from varchar(75)
go

/*==============================================================*/
/* Domain: D_NUMMER                                             */
/*==============================================================*/
create type D_NUMMER
   from int
go

/*==============================================================*/
/* Domain: D_POSTCODE                                           */
/*==============================================================*/
create type D_POSTCODE
   from varchar(6)
go

/*==============================================================*/
/* Domain: D_POULE                                              */
/*==============================================================*/
create type D_POULE
   from varchar(2)
go

/*==============================================================*/
/* Domain: D_SET                                                */
/*==============================================================*/
create type D_SET
   from int
go

execute sp_bindrule R_D_SET, D_SET
go

/*==============================================================*/
/* Domain: D_TELNUMMER                                          */
/*==============================================================*/
create type D_TELNUMMER
   from numeric(10)
go

/*==============================================================*/
/* Domain: D_TEXT                                               */
/*==============================================================*/
create type D_TEXT
   from text
go

/*==============================================================*/
/* Domain: D_TIME                                               */
/*==============================================================*/
create type D_TIME
   from datetime
go

/*==============================================================*/
/* Domain: D_TOERNOOITYPE                                       */
/*==============================================================*/
create type D_TOERNOOITYPE
   from varchar(15)
go

execute sp_bindrule R_D_TOERNOOITYPE, D_TOERNOOITYPE
go

/*==============================================================*/
/* Table: ADRES                                                 */
/*==============================================================*/
create table ADRES (
   POSTCODE             D_POSTCODE           not null,
   STRAATNAAM           D_NAAM               not null,
   PLAATSNAAM           D_NAAM               not null,
   HUISNUMMER           D_HUISNUMMER         not null,
   constraint PK_ADRES primary key nonclustered (POSTCODE)
)
go

/*==============================================================*/
/* Table: FORMAT                                                */
/*==============================================================*/
create table FORMAT (
   FORMAT_KLASSE        D_NUMMER             not null,
   TOERNOOI_ID          D_ID                 not null,
   constraint PK_FORMAT primary key nonclustered (FORMAT_KLASSE)
)
go

/*==============================================================*/
/* Index: FK_TOERNOOI_FORMAT_FK                                 */
/*==============================================================*/
create index FK_TOERNOOI_FORMAT_FK on FORMAT (
TOERNOOI_ID ASC
)
go

/*==============================================================*/
/* Table: FUNCTIE                                               */
/*==============================================================*/
create table FUNCTIE (
   FUNCTIE_NAAM         D_NAAM               not null,
   FUNCTIE_OMSCHRIJVING D_TEXT               not null,
   constraint PK_FUNCTIE primary key nonclustered (FUNCTIE_NAAM)
)
go

/*==============================================================*/
/* Table: INSCHRIJFADRES                                        */
/*==============================================================*/
create table INSCHRIJFADRES (
   TOERNOOI_ID          D_ID                 not null,
   INSCHRIJF_ID         D_ID                 not null,
   POSTCODE             D_POSTCODE           not null,
   CATEGORIE_NAAM       D_CATNAME            null,
   PERSOON_ID           D_ID                 not null,
   TELEFOONNUMMER       D_TELNUMMER          not null,
   EMAIL                D_EMAIL              not null,
   constraint PK_INSCHRIJFADRES primary key nonclustered (TOERNOOI_ID, INSCHRIJF_ID)
)
go

/*==============================================================*/
/* Index: FK_TOERNOOI_INSCHRIJFADRES_FK                         */
/*==============================================================*/
create index FK_TOERNOOI_INSCHRIJFADRES_FK on INSCHRIJFADRES (
TOERNOOI_ID ASC
)
go

/*==============================================================*/
/* Index: FK_INSCHRIJFADRES_LEEFTIJDSCATEGORIE_FK               */
/*==============================================================*/
create index FK_INSCHRIJFADRES_LEEFTIJDSCATEGORIE_FK on INSCHRIJFADRES (
CATEGORIE_NAAM ASC
)
go

/*==============================================================*/
/* Index: FK_ADRES_INSCHRIJFADRES_FK                            */
/*==============================================================*/
create index FK_ADRES_INSCHRIJFADRES_FK on INSCHRIJFADRES (
POSTCODE ASC
)
go

/*==============================================================*/
/* Index: FK_WERKNEMER_INSCHRIJFADRES_FK                        */
/*==============================================================*/
create index FK_WERKNEMER_INSCHRIJFADRES_FK on INSCHRIJFADRES (
PERSOON_ID ASC
)
go

/*==============================================================*/
/* Table: LADDER                                                */
/*==============================================================*/
create table LADDER (
   TOERNOOI_ID          D_ID                 not null,
   JAARTAL              D_NUMMER             not null,
   RANG                 D_NUMMER             not null,
   constraint PK_LADDER primary key nonclustered (TOERNOOI_ID, JAARTAL, RANG)
)
go

/*==============================================================*/
/* Index: FK_TOERNOOI_LADDER_FK                                 */
/*==============================================================*/
create index FK_TOERNOOI_LADDER_FK on LADDER (
TOERNOOI_ID ASC
)
go

/*==============================================================*/
/* Table: LEEFTIJDSCATEGORIE                                    */
/*==============================================================*/
create table LEEFTIJDSCATEGORIE (
   CATEGORIE_NAAM       D_CATNAME            not null,
   LEEFTIJD             D_LEEFTIJD           not null,
   constraint PK_LEEFTIJDSCATEGORIE primary key nonclustered (CATEGORIE_NAAM)
)
go

/*==============================================================*/
/* Table: PERSOON                                               */
/*==============================================================*/
create table PERSOON (
   PERSOON_ID           D_ID                 not null,
   POSTCODE             D_POSTCODE           not null,
   VERENIGING_NAAM      D_NAAM               null,
   VOORNAAM             D_NAAM               not null,
   ACHTERNAAM           D_NAAM               not null,
   GESLACHT             D_GESLACHT           not null,
   GEBOORTDEDATUM       D_GEBDATUM           null,
   constraint PK_PERSOON primary key nonclustered (PERSOON_ID)
)
go

/*==============================================================*/
/* Index: FK_TOERNOOI_PERSOON_FK                                */
/*==============================================================*/
create index FK_TOERNOOI_PERSOON_FK on PERSOON (
VERENIGING_NAAM ASC
)
go

/*==============================================================*/
/* Index: FK_ADRES_PERSOON_FK                                   */
/*==============================================================*/
create index FK_ADRES_PERSOON_FK on PERSOON (
POSTCODE ASC
)
go

/*==============================================================*/
/* Table: SCORE                                                 */
/*==============================================================*/
create table SCORE (
   TOERNOOI_ID          D_ID                 not null,
   WEDSTRIJD_ID         D_ID                 not null,
   "SET"                D_SET                not null,
   TEAM_NAAM            D_NAAM               not null,
   PUNTEN               D_NUMMER             null,
   constraint PK_SCORE primary key nonclustered (TOERNOOI_ID, WEDSTRIJD_ID, "SET")
)
go

/*==============================================================*/
/* Index: FK_WEDSTRIJD_SCORE_FK                                 */
/*==============================================================*/
create index FK_WEDSTRIJD_SCORE_FK on SCORE (
TOERNOOI_ID ASC,
WEDSTRIJD_ID ASC
)
go

/*==============================================================*/
/* Index: FK_TEAM_SCORE_FK                                      */
/*==============================================================*/
create index FK_TEAM_SCORE_FK on SCORE (
TEAM_NAAM ASC
)
go

/*==============================================================*/
/* Table: SPELER                                                */
/*==============================================================*/
create table SPELER (
   PERSOON_ID           D_ID                 not null,
   CATEGORIE_NAAM       D_CATNAME            not null,
   KLASSE               D_NUMMER             null,
   BONDSNUMMER          D_NUMMER             null,
   LICENTIE             D_LICENTIE           null,
   RANKING              D_NUMMER             null,
   constraint PK_SPELER primary key (PERSOON_ID)
)
go

/*==============================================================*/
/* Index: FK_LEEFTIJDSCATEGORIE_SPELER_FK                       */
/*==============================================================*/
create index FK_LEEFTIJDSCATEGORIE_SPELER_FK on SPELER (
CATEGORIE_NAAM ASC
)
go

/*==============================================================*/
/* Table: SPELERINLADDER                                        */
/*==============================================================*/
create table SPELERINLADDER (
   PERSOON_ID           D_ID                 not null,
   TOERNOOI_ID          D_ID                 not null,
   JAARTAL              D_NUMMER             not null,
   RANG                 D_NUMMER             not null,
   constraint PK_SPELERINLADDER primary key (PERSOON_ID, TOERNOOI_ID, JAARTAL, RANG)
)
go

/*==============================================================*/
/* Index: SPELERINLADDER_FK                                     */
/*==============================================================*/
create index SPELERINLADDER_FK on SPELERINLADDER (
PERSOON_ID ASC
)
go

/*==============================================================*/
/* Index: SPELERINLADDER2_FK                                    */
/*==============================================================*/
create index SPELERINLADDER2_FK on SPELERINLADDER (
TOERNOOI_ID ASC,
JAARTAL ASC,
RANG ASC
)
go

/*==============================================================*/
/* Table: SPELERINTEAM                                          */
/*==============================================================*/
create table SPELERINTEAM (
   TEAM_NAAM            D_NAAM               not null,
   PERSOON_ID           D_ID                 not null,
   constraint PK_SPELERINTEAM primary key (TEAM_NAAM, PERSOON_ID)
)
go

/*==============================================================*/
/* Index: SPELERINTEAM_FK                                       */
/*==============================================================*/
create index SPELERINTEAM_FK on SPELERINTEAM (
TEAM_NAAM ASC
)
go

/*==============================================================*/
/* Index: SPELERINTEAM2_FK                                      */
/*==============================================================*/
create index SPELERINTEAM2_FK on SPELERINTEAM (
PERSOON_ID ASC
)
go

/*==============================================================*/
/* Table: TAFEL                                                 */
/*==============================================================*/
create table TAFEL (
   TAFEL_ID             D_ID                 not null,
   VERENIGING_NAAM      D_NAAM               not null,
   constraint PK_TAFEL primary key nonclustered (TAFEL_ID)
)
go

/*==============================================================*/
/* Index: FK_VERENIGING_TAFEL_FK                                */
/*==============================================================*/
create index FK_VERENIGING_TAFEL_FK on TAFEL (
VERENIGING_NAAM ASC
)
go

/*==============================================================*/
/* Table: TAFELINTOERNOOI                                       */
/*==============================================================*/
create table TAFELINTOERNOOI (
   TOERNOOI_ID          D_ID                 not null,
   TAFEL_ID             D_ID                 not null,
   constraint PK_TAFELINTOERNOOI primary key (TOERNOOI_ID, TAFEL_ID)
)
go

/*==============================================================*/
/* Index: TAFELINTOERNOOI_FK                                    */
/*==============================================================*/
create index TAFELINTOERNOOI_FK on TAFELINTOERNOOI (
TOERNOOI_ID ASC
)
go

/*==============================================================*/
/* Index: TAFELINTOERNOOI2_FK                                   */
/*==============================================================*/
create index TAFELINTOERNOOI2_FK on TAFELINTOERNOOI (
TAFEL_ID ASC
)
go

/*==============================================================*/
/* Table: TEAM                                                  */
/*==============================================================*/
create table TEAM (
   TEAM_NAAM            D_NAAM               not null,
   constraint PK_TEAM primary key nonclustered (TEAM_NAAM)
)
go

/*==============================================================*/
/* Table: TEAMINTOERNOOI                                        */
/*==============================================================*/
create table TEAMINTOERNOOI (
   TEAM_NAAM            D_NAAM               not null,
   TOERNOOI_ID          D_ID                 not null,
   constraint PK_TEAMINTOERNOOI primary key (TEAM_NAAM, TOERNOOI_ID)
)
go

/*==============================================================*/
/* Index: TEAMINTOERNOOI_FK                                     */
/*==============================================================*/
create index TEAMINTOERNOOI_FK on TEAMINTOERNOOI (
TEAM_NAAM ASC
)
go

/*==============================================================*/
/* Index: TEAMINTOERNOOI2_FK                                    */
/*==============================================================*/
create index TEAMINTOERNOOI2_FK on TEAMINTOERNOOI (
TOERNOOI_ID ASC
)
go

/*==============================================================*/
/* Table: TOERNOOI                                              */
/*==============================================================*/
create table TOERNOOI (
   TOERNOOI_ID          D_ID                 not null,
   VERENIGING_NAAM      D_NAAM               not null,
   POSTCODE             D_POSTCODE           not null,
   START_DATUM          D_DATE               not null,
   EIND_DATUM           D_DATE               null,
   ORGANISATIE          D_NAAM               not null,
   GOEDKEURING          D_BOOLEAN            not null,
   AANVANGSTIJDSTIP     D_TIME               not null,
   TOERNOOITYPE         D_TOERNOOITYPE       not null,
   GESLACHT             D_GESLACHT           null,
   ENKEL                D_BOOLEAN            not null,
   constraint PK_TOERNOOI primary key nonclustered (TOERNOOI_ID)
)
go

/*==============================================================*/
/* Index: FK_VERENIGING_TOERNOOI_FK                             */
/*==============================================================*/
create index FK_VERENIGING_TOERNOOI_FK on TOERNOOI (
VERENIGING_NAAM ASC
)
go

/*==============================================================*/
/* Index: FK_ADRES_TOERNOOI_FK                                  */
/*==============================================================*/
create index FK_ADRES_TOERNOOI_FK on TOERNOOI (
POSTCODE ASC
)
go

/*==============================================================*/
/* Table: VERENIGING                                            */
/*==============================================================*/
create table VERENIGING (
   VERENIGING_NAAM      D_NAAM               not null,
   POSTCODE             D_POSTCODE           not null,
   TELEFOONNUMMER       D_TELNUMMER          not null,
   EMAIL                D_EMAIL              not null,
   constraint PK_VERENIGING primary key nonclustered (VERENIGING_NAAM)
)
go

/*==============================================================*/
/* Index: FK_ADRES_VERENIGING_FK                                */
/*==============================================================*/
create index FK_ADRES_VERENIGING_FK on VERENIGING (
POSTCODE ASC
)
go

/*==============================================================*/
/* Table: WEDSTRIJD                                             */
/*==============================================================*/
create table WEDSTRIJD (
   TOERNOOI_ID          D_ID                 not null,
   WEDSTRIJD_ID         D_ID                 not null,
   TEAM_NAAM            D_NAAM               not null,
   TAFEL_ID             D_ID                 not null,
   TEA_TEAM_NAAM        D_NAAM               not null,
   PERSOON_ID           D_ID                 not null,
   START_DATUM          D_DATE               not null,
   POULECODE            D_POULE              null,
   constraint PK_WEDSTRIJD primary key nonclustered (TOERNOOI_ID, WEDSTRIJD_ID)
)
go

/*==============================================================*/
/* Index: FK_TOERNOOI_WEDSTRIJD_FK                              */
/*==============================================================*/
create index FK_TOERNOOI_WEDSTRIJD_FK on WEDSTRIJD (
TOERNOOI_ID ASC
)
go

/*==============================================================*/
/* Index: FK_WEDSTRIJD_TAFEL_FK                                 */
/*==============================================================*/
create index FK_WEDSTRIJD_TAFEL_FK on WEDSTRIJD (
TAFEL_ID ASC
)
go

/*==============================================================*/
/* Index: FK_WERKNEMER_WEDSTRIJD_FK                             */
/*==============================================================*/
create index FK_WERKNEMER_WEDSTRIJD_FK on WEDSTRIJD (
PERSOON_ID ASC
)
go

/*==============================================================*/
/* Index: FK_TEAM_WEDSTRIJD_FK                                  */
/*==============================================================*/
create index FK_TEAM_WEDSTRIJD_FK on WEDSTRIJD (
TEAM_NAAM ASC
)
go

/*==============================================================*/
/* Index: FK_TEAM_WEDSTRIJD_B_FK                                */
/*==============================================================*/
create index FK_TEAM_WEDSTRIJD_B_FK on WEDSTRIJD (
TEA_TEAM_NAAM ASC
)
go

/*==============================================================*/
/* Table: WERKNEMER                                             */
/*==============================================================*/
create table WERKNEMER (
   PERSOON_ID           D_ID                 not null,
   FUNCTIE_NAAM         D_NAAM               not null,
   constraint PK_WERKNEMER primary key (PERSOON_ID)
)
go

/*==============================================================*/
/* Index: FK_WERKNEMER_FUNCTIE_FK                               */
/*==============================================================*/
create index FK_WERKNEMER_FUNCTIE_FK on WERKNEMER (
FUNCTIE_NAAM ASC
)
go

alter table FORMAT
   add constraint FK_FORMAT_FK_TOERNO_TOERNOOI foreign key (TOERNOOI_ID)
      references TOERNOOI (TOERNOOI_ID)
go

alter table INSCHRIJFADRES
   add constraint FK_INSCHRIJ_FK_ADRES__ADRES foreign key (POSTCODE)
      references ADRES (POSTCODE)
go

alter table INSCHRIJFADRES
   add constraint FK_INSCHRIJ_FK_INSCHR_LEEFTIJD foreign key (CATEGORIE_NAAM)
      references LEEFTIJDSCATEGORIE (CATEGORIE_NAAM)
go

alter table INSCHRIJFADRES
   add constraint FK_INSCHRIJ_FK_TOERNO_TOERNOOI foreign key (TOERNOOI_ID)
      references TOERNOOI (TOERNOOI_ID)
go

alter table INSCHRIJFADRES
   add constraint FK_INSCHRIJ_FK_WERKNE_WERKNEME foreign key (PERSOON_ID)
      references WERKNEMER (PERSOON_ID)
go

alter table LADDER
   add constraint FK_LADDER_FK_TOERNO_TOERNOOI foreign key (TOERNOOI_ID)
      references TOERNOOI (TOERNOOI_ID)
go

alter table PERSOON
   add constraint FK_PERSOON_FK_ADRES__ADRES foreign key (POSTCODE)
      references ADRES (POSTCODE)
go

alter table PERSOON
   add constraint FK_PERSOON_FK_TOERNO_VERENIGI foreign key (VERENIGING_NAAM)
      references VERENIGING (VERENIGING_NAAM)
go

alter table SCORE
   add constraint FK_SCORE_FK_TEAM_S_TEAM foreign key (TEAM_NAAM)
      references TEAM (TEAM_NAAM)
go

alter table SCORE
   add constraint FK_SCORE_FK_WEDSTR_WEDSTRIJ foreign key (TOERNOOI_ID, WEDSTRIJD_ID)
      references WEDSTRIJD (TOERNOOI_ID, WEDSTRIJD_ID)
go

alter table SPELER
   add constraint FK_SPELER_FK_LEEFTI_LEEFTIJD foreign key (CATEGORIE_NAAM)
      references LEEFTIJDSCATEGORIE (CATEGORIE_NAAM)
go

alter table SPELER
   add constraint FK_SPELER_INHERITAN_PERSOON foreign key (PERSOON_ID)
      references PERSOON (PERSOON_ID)
go

alter table SPELERINLADDER
   add constraint FK_SPELERIN_SPELERINL_SPELER foreign key (PERSOON_ID)
      references SPELER (PERSOON_ID)
go

alter table SPELERINLADDER
   add constraint FK_SPELERIN_SPELERINL_LADDER foreign key (TOERNOOI_ID, JAARTAL, RANG)
      references LADDER (TOERNOOI_ID, JAARTAL, RANG)
go

alter table SPELERINTEAM
   add constraint FK_SPELERIN_SPELERINT_TEAM foreign key (TEAM_NAAM)
      references TEAM (TEAM_NAAM)
go

alter table SPELERINTEAM
   add constraint FK_SPELERIN_SPELERINT_SPELER foreign key (PERSOON_ID)
      references SPELER (PERSOON_ID)
go

alter table TAFEL
   add constraint FK_TAFEL_FK_VERENI_VERENIGI foreign key (VERENIGING_NAAM)
      references VERENIGING (VERENIGING_NAAM)
go

alter table TAFELINTOERNOOI
   add constraint FK_TAFELINT_TAFELINTO_TOERNOOI foreign key (TOERNOOI_ID)
      references TOERNOOI (TOERNOOI_ID)
go

alter table TAFELINTOERNOOI
   add constraint FK_TAFELINT_TAFELINTO_TAFEL foreign key (TAFEL_ID)
      references TAFEL (TAFEL_ID)
go

alter table TEAMINTOERNOOI
   add constraint FK_TEAMINTO_TEAMINTOE_TEAM foreign key (TEAM_NAAM)
      references TEAM (TEAM_NAAM)
go

alter table TEAMINTOERNOOI
   add constraint FK_TEAMINTO_TEAMINTOE_TOERNOOI foreign key (TOERNOOI_ID)
      references TOERNOOI (TOERNOOI_ID)
go

alter table TOERNOOI
   add constraint FK_TOERNOOI_FK_ADRES__ADRES foreign key (POSTCODE)
      references ADRES (POSTCODE)
go

alter table TOERNOOI
   add constraint FK_TOERNOOI_FK_VERENI_VERENIGI foreign key (VERENIGING_NAAM)
      references VERENIGING (VERENIGING_NAAM)
go

alter table VERENIGING
   add constraint FK_VERENIGI_FK_ADRES__ADRES foreign key (POSTCODE)
      references ADRES (POSTCODE)
go

alter table WEDSTRIJD
   add constraint FK_WEDSTRIJ_FK_TEAM_A_TEAM foreign key (TEAM_NAAM)
      references TEAM (TEAM_NAAM)
go

alter table WEDSTRIJD
   add constraint FK_WEDSTRIJ_FK_TEAM_B_TEAM foreign key (TEA_TEAM_NAAM)
      references TEAM (TEAM_NAAM)
go

alter table WEDSTRIJD
   add constraint FK_WEDSTRIJ_FK_TOERNO_TOERNOOI foreign key (TOERNOOI_ID)
      references TOERNOOI (TOERNOOI_ID)
go

alter table WEDSTRIJD
   add constraint FK_WEDSTRIJ_FK_WEDSTR_TAFEL foreign key (TAFEL_ID)
      references TAFEL (TAFEL_ID)
go

alter table WEDSTRIJD
   add constraint FK_WEDSTRIJ_FK_WERKNE_WERKNEME foreign key (PERSOON_ID)
      references WERKNEMER (PERSOON_ID)
go

alter table WERKNEMER
   add constraint FK_WERKNEME_FK_WERKNE_FUNCTIE foreign key (FUNCTIE_NAAM)
      references FUNCTIE (FUNCTIE_NAAM)
go

alter table WERKNEMER
   add constraint FK_WERKNEME_INHERITAN_PERSOON foreign key (PERSOON_ID)
      references PERSOON (PERSOON_ID)
go

