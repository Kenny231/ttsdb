/*==============================================================*/
/* DBMS name:      Microsoft SQL Server 2008                    */
/* Created on:     5/25/2016 1:19:37 PM                         */
/*==============================================================*/
use master
go

IF DB_ID('TTSDB') IS NOT NULL
	DROP DATABASE TTSDB
GO

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

create rule R_D_EMAILADRES as
	  @column LIKE ('%_@__%.__%')
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
/* Table: AANMELDINGENLADDER                                    */
/*==============================================================*/
create table AANMELDINGENLADDER (
   PERSOON_ID           D_ID                 not null,
   TOERNOOI_ID          D_ID                 not null,
   constraint PK_AANMELDINGENLADDER primary key (PERSOON_ID, TOERNOOI_ID)
)
go

/*==============================================================*/
/* Index: AANMELDINGENLADDER2_FK                                */
/*==============================================================*/
create index AANMELDINGENLADDER2_FK on AANMELDINGENLADDER (
TOERNOOI_ID ASC
)
go

/*==============================================================*/
/* Table: ADRES                                                 */
/*==============================================================*/
create table ADRES (
   POSTCODE             D_POSTCODE           not null,
   HUISNUMMER           D_HUISNUMMER         not null,
   STRAATNAAM           D_NAAM               not null,
   PLAATSNAAM           D_NAAM               not null,
   constraint PK_ADRES primary key nonclustered (POSTCODE, HUISNUMMER)
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
   SUBTOERNOOI_ID       D_ID                 not null,
   POSTCODE             D_POSTCODE           not null,
   HUISNUMMER           D_HUISNUMMER         not null,
   PERSOON_ID           D_ID                 not null,
   TELEFOONNUMMER       D_TELNUMMER          not null,
   EMAIL                D_EMAIL              not null,
   constraint PK_INSCHRIJFADRES primary key nonclustered (TOERNOOI_ID, SUBTOERNOOI_ID)
)
go

execute sp_bindrule R_D_EMAILADRES, D_EMAIL
go

/*==============================================================*/
/* Index: R_ADRES_VAN_INSCHRIJFADRES_FK                         */
/*==============================================================*/
create index R_ADRES_VAN_INSCHRIJFADRES_FK on INSCHRIJFADRES (
POSTCODE ASC,
HUISNUMMER ASC
)
go

/*==============================================================*/
/* Index: R_CONTACTPERSOON_VAN_INSCHRIJFADRES_FK                */
/*==============================================================*/
create index R_CONTACTPERSOON_VAN_INSCHRIJFADRES_FK on INSCHRIJFADRES (
PERSOON_ID ASC
)
go

/*==============================================================*/
/* Table: LADDER                                                */
/*==============================================================*/
create table LADDER (
   TOERNOOI_ID          D_ID                 not null,
   JAARTAL              D_NUMMER             not null,
   constraint PK_LADDER primary key nonclustered (TOERNOOI_ID, JAARTAL)
)
go

/*==============================================================*/
/* Index: R_LADDER_VAN_TOERNOOI_FK                              */
/*==============================================================*/
create index R_LADDER_VAN_TOERNOOI_FK on LADDER (
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
/* Table: LICENTIE                                              */
/*==============================================================*/
create table LICENTIE (
   LICENTIE             D_LICENTIE           not null,
   TOERNOOI_ID          D_ID                 not null,
   SUBTOERNOOI_ID       D_ID                 not null,
   constraint PK_LICENTIE primary key nonclustered (LICENTIE, TOERNOOI_ID, SUBTOERNOOI_ID)
)
go

/*==============================================================*/
/* Index: R_FORMAT_VAN_SUBTOERNOOI_FK                           */
/*==============================================================*/
create index R_FORMAT_VAN_SUBTOERNOOI_FK on LICENTIE (
TOERNOOI_ID ASC,
SUBTOERNOOI_ID ASC
)
go

/*==============================================================*/
/* Table: PERSOON                                               */
/*==============================================================*/
create table PERSOON (
   PERSOON_ID           D_ID                 not null,
   POSTCODE             D_POSTCODE           not null,
   HUISNUMMER           D_HUISNUMMER         not null,
   VERENIGING_NAAM      D_NAAM               null,
   VOORNAAM             D_NAAM               not null,
   ACHTERNAAM           D_NAAM               not null,
   GESLACHT             D_GESLACHT           not null,
   GEBOORTEDATUM        D_GEBDATUM           not null,
   constraint PK_PERSOON primary key nonclustered (PERSOON_ID)
)
go

/*==============================================================*/
/* Index: R_CONTACTPERSOON_VAN_VERENIGING_FK                    */
/*==============================================================*/
create index R_CONTACTPERSOON_VAN_VERENIGING_FK on PERSOON (
VERENIGING_NAAM ASC
)
go

/*==============================================================*/
/* Index: R_PERSOON_ADRES_FK                                    */
/*==============================================================*/
create index R_PERSOON_ADRES_FK on PERSOON (
POSTCODE ASC,
HUISNUMMER ASC
)
go

/*==============================================================*/
/* Table: SCORE                                                 */
/*==============================================================*/
create table SCORE (
   TOERNOOI_ID          D_ID                 not null,
   SUBTOERNOOI_ID       D_ID                 not null,
   WEDSTRIJD_ID         D_ID                 not null,
   "SET"                D_SET                not null,
   TEAM_ID              D_ID                 not null,
   PUNTEN               D_NUMMER             null,
   constraint PK_SCORE primary key nonclustered (TOERNOOI_ID, SUBTOERNOOI_ID, WEDSTRIJD_ID, "SET", TEAM_ID)
)
go

/*==============================================================*/
/* Index: R_SCORE_VAN_WEDSTRIJD_FK                              */
/*==============================================================*/
create index R_SCORE_VAN_WEDSTRIJD_FK on SCORE (
TOERNOOI_ID ASC,
SUBTOERNOOI_ID ASC,
WEDSTRIJD_ID ASC
)
go

/*==============================================================*/
/* Index: R_SCORE_VAN_TEAM_FK                                   */
/*==============================================================*/
create index R_SCORE_VAN_TEAM_FK on SCORE (
TEAM_ID ASC
)
go

CREATE FUNCTION fnGetLeeftijdscategorie (@persoon_id INT)
RETURNS VARCHAR(30)
	AS
  	  BEGIN
  		  DECLARE @leeftijd INT, @categorie VARCHAR(30)
  			  SELECT @leeftijd = DATEDIFF(HOUR,GEBOORTEDATUM, GETDATE())/8766
  			  FROM PERSOON
  			  WHERE PERSOON_ID = @persoon_id


  			  SELECT TOP 1 @categorie = CATEGORIE_NAAM
  			   FROM LEEFTIJDSCATEGORIE
  			   WHERE ABS( LEEFTIJD  ) <= @leeftijd

  		  RETURN @categorie
  	  END
GO


/*==============================================================*/
/* Table: SPELER                                            	*/
/*==============================================================*/
create table SPELER (
   PERSOON_ID       	D_ID             	not null,
   CATEGORIE_NAAM AS (dbo.fnGetLeeftijdscategorie(PERSOON_ID)),
   BONDSNUMMER      	D_NUMMER         	null,
   LICENTIE         	D_LICENTIE       	null,
   RANKING          	D_NUMMER         	null,
   constraint PK_SPELER primary key (PERSOON_ID),
   constraint CK_GeregistreerdLid check ((LICENTIE IS NOT NULL AND BONDSNUMMER IS NOT NULL AND RANKING IS NOT NULL) OR (LICENTIE IS NULL AND BONDSNUMMER IS NULL AND RANKING IS NULL))
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
   constraint PK_SPELERINLADDER primary key (PERSOON_ID, TOERNOOI_ID),
   constraint AK_SPELERINLADDER unique (TOERNOOI_ID, RANG)
)
go

/*==============================================================*/
/* Index: R_SPELER_IN_LADDER_FK                                 */
/*==============================================================*/
create index R_SPELER_IN_LADDER_FK on SPELERINLADDER (
PERSOON_ID ASC
)
go

/*==============================================================*/
/* Index: R_SPELER_IN_LADDER2_FK                                */
/*==============================================================*/
create index R_SPELER_IN_LADDER2_FK on SPELERINLADDER (
TOERNOOI_ID ASC,
JAARTAL ASC,
RANG ASC
)
go

/*==============================================================*/
/* Table: SPELERINTEAM                                          */
/*==============================================================*/
create table SPELERINTEAM (
   TEAM_ID              D_ID                 not null,
   PERSOON_ID           D_ID                 not null,
   constraint PK_SPELERINTEAM primary key (TEAM_ID, PERSOON_ID)
)
go

/*==============================================================*/
/* Index: R_SPELER_IN_TEAM_FK                                   */
/*==============================================================*/
create index R_SPELER_IN_TEAM_FK on SPELERINTEAM (
TEAM_ID ASC
)
go

/*==============================================================*/
/* Index: R_SPELER_IN_TEAM2_FK                                  */
/*==============================================================*/
create index R_SPELER_IN_TEAM2_FK on SPELERINTEAM (
PERSOON_ID ASC
)
go

/*==============================================================*/
/* Table: SUBTOERNOOI                                           */
/*==============================================================*/
create table SUBTOERNOOI (
   TOERNOOI_ID          D_ID                 not null,
   SUBTOERNOOI_ID       D_ID                 not null,
   CATEGORIE_NAAM       D_CATNAME            null,
   GESLACHT             D_GESLACHT           null,
   ENKEL                D_BOOLEAN            not null,
   constraint PK_SUBTOERNOOI primary key nonclustered (TOERNOOI_ID, SUBTOERNOOI_ID)
)
go

/*==============================================================*/
/* Index: SUBTOERNOOI_VAN_TOERNOOI_FK                           */
/*==============================================================*/
create index SUBTOERNOOI_VAN_TOERNOOI_FK on SUBTOERNOOI (
TOERNOOI_ID ASC
)
go

/*==============================================================*/
/* Index: R_LEEFTIJDSCATEGORIE_VAN_SUBTOERNOOI_FK               */
/*==============================================================*/
create index R_LEEFTIJDSCATEGORIE_VAN_SUBTOERNOOI_FK on SUBTOERNOOI (
CATEGORIE_NAAM ASC
)
go

/*==============================================================*/
/* Table: TAFEL                                                 */
/*==============================================================*/
create table TAFEL (
   VERENIGING_NAAM      D_NAAM               not null,
   TAFEL_ID             D_ID                 not null,
   constraint PK_TAFEL primary key nonclustered (VERENIGING_NAAM, TAFEL_ID)
)
go

/*==============================================================*/
/* Index: R_TAFEL_VAN_VERENIGING_FK                             */
/*==============================================================*/
create index R_TAFEL_VAN_VERENIGING_FK on TAFEL (
VERENIGING_NAAM ASC
)
go

/*==============================================================*/
/* Table: TEAM                                                  */
/*==============================================================*/
create table TEAM (
   TEAM_ID              INT IDENTITY         not null,
   TEAM_NAAM            D_NAAM               not null,
   constraint PK_TEAM primary key nonclustered (TEAM_ID)
)
go

/*==============================================================*/
/* Table: TEAMINSUBTOERNOOI                                     */
/*==============================================================*/
create table TEAMINSUBTOERNOOI (
   TEAM_ID              D_ID                 not null,
   TOERNOOI_ID          D_ID                 not null,
   SUBTOERNOOI_ID       D_ID                 not null,
   constraint PK_TEAMINSUBTOERNOOI primary key (TEAM_ID, TOERNOOI_ID, SUBTOERNOOI_ID)
)
go

/*==============================================================*/
/* Index: R_TEAM_IN_SUBTOERNOOI_FK                              */
/*==============================================================*/
create index R_TEAM_IN_SUBTOERNOOI_FK on TEAMINSUBTOERNOOI (
TEAM_ID ASC
)
go

/*==============================================================*/
/* Index: R_TEAM_IN_SUBTOERNOOI2_FK                             */
/*==============================================================*/
create index R_TEAM_IN_SUBTOERNOOI2_FK on TEAMINSUBTOERNOOI (
TOERNOOI_ID ASC,
SUBTOERNOOI_ID ASC
)
go

/*==============================================================*/
/* Table: TOERNOOI                                              */
/*==============================================================*/
create table TOERNOOI (
   TOERNOOI_ID          D_ID                 not null identity(1, 1),
   TOERNOOINAAM         D_NAAM               not null,
   VERENIGING_NAAM      D_NAAM               not null,
   POSTCODE             D_POSTCODE           not null,
   HUISNUMMER           D_HUISNUMMER         not null,
   START_DATUM          D_DATE               not null,
   EIND_DATUM           D_DATE               null,
   ORGANISATIE          D_NAAM               not null,
   GOEDKEURING          D_BOOLEAN            not null,
   TOERNOOITYPE         D_TOERNOOITYPE       not null,
   MAX_AANTAL_SPELERS   D_NUMMER             not null,
   constraint PK_TOERNOOI primary key nonclustered (TOERNOOI_ID)
)
go

/*==============================================================*/
/* Index: R_TOERNOOI_BIJ_VERENIGING_FK                          */
/*==============================================================*/
create index R_TOERNOOI_BIJ_VERENIGING_FK on TOERNOOI (
VERENIGING_NAAM ASC
)
go

/*==============================================================*/
/* Index: R_ADRES_VAN_TOERNOOI_FK                               */
/*==============================================================*/
create index R_ADRES_VAN_TOERNOOI_FK on TOERNOOI (
POSTCODE ASC,
HUISNUMMER ASC
)
go

/*==============================================================*/
/* Table: VERENIGING                                            */
/*==============================================================*/
create table VERENIGING (
   VERENIGING_NAAM      D_NAAM               not null,
   POSTCODE             D_POSTCODE           not null,
   HUISNUMMER           D_HUISNUMMER         not null,
   TELEFOONNUMMER       D_TELNUMMER          not null,
   EMAIL                D_EMAIL              not null,
   constraint PK_VERENIGING primary key nonclustered (VERENIGING_NAAM)
)
go

execute sp_bindrule R_D_EMAILADRES, D_EMAIL
go

/*==============================================================*/
/* Index: R_ADRES_VAN_VERENIGING_FK                             */
/*==============================================================*/
create index R_ADRES_VAN_VERENIGING_FK on VERENIGING (
POSTCODE ASC,
HUISNUMMER ASC
)
go

/*==============================================================*/
/* Table: WEDSTRIJD                                             */
/*==============================================================*/
create table WEDSTRIJD (
   TOERNOOI_ID          D_ID                 not null,
   SUBTOERNOOI_ID       D_ID                 not null,
   WEDSTRIJD_ID         D_ID                 not null,
   TEAM1                D_ID                 not null,
   TEAM2                D_ID                 not null,
   SCHEIDSRECHTER       D_ID                 null,
   START_DATUM          D_DATE               not null,
   POULECODE            D_POULE              null,
   constraint PK_WEDSTRIJD primary key nonclustered (TOERNOOI_ID, SUBTOERNOOI_ID, WEDSTRIJD_ID)
)
go

/*==============================================================*/
/* Index: R_WEDSTRIJD_VAN_SUBTOERNOOI_FK                        */
/*==============================================================*/
create index R_WEDSTRIJD_VAN_SUBTOERNOOI_FK on WEDSTRIJD (
TOERNOOI_ID ASC,
SUBTOERNOOI_ID ASC
)
go

/*==============================================================*/
/* Index: R_SCHEIDSRECHTER_VAN_WEDSTRIJD_FK                     */
/*==============================================================*/
create index R_SCHEIDSRECHTER_VAN_WEDSTRIJD_FK on WEDSTRIJD (
SCHEIDSRECHTER ASC
)
go

/*==============================================================*/
/* Index: R_TEAM1_VAN_WEDSTRIJD_FK                              */
/*==============================================================*/
create index R_TEAM1_VAN_WEDSTRIJD_FK on WEDSTRIJD (
TEAM1 ASC
)
go

/*==============================================================*/
/* Index: R_TEAM2_VAN_WEDSTRIJD_FK                              */
/*==============================================================*/
create index R_TEAM2_VAN_WEDSTRIJD_FK on WEDSTRIJD (
TEAM2 ASC
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
/* Index: R_FUNCTIE_VAN_WERKNEMER_FK                            */
/*==============================================================*/
create index R_FUNCTIE_VAN_WERKNEMER_FK on WERKNEMER (
FUNCTIE_NAAM ASC
)
go

alter table AANMELDINGENLADDER
   add constraint FK_AANMELDI_AANMELDIN_SPELER foreign key (PERSOON_ID)
      references SPELER (PERSOON_ID)
go

alter table AANMELDINGENLADDER
   add constraint FK_AANMELDI_AANMELDIN_TOERNOOI foreign key (TOERNOOI_ID)
      references TOERNOOI (TOERNOOI_ID)
go

alter table INSCHRIJFADRES
   add constraint FK_INSCHRIJ_R_ADRES_V_ADRES foreign key (POSTCODE, HUISNUMMER)
      references ADRES (POSTCODE, HUISNUMMER)
go

alter table INSCHRIJFADRES
   add constraint FK_INSCHRIJ_R_CONTACT_WERKNEME foreign key (PERSOON_ID)
      references WERKNEMER (PERSOON_ID)
go

alter table INSCHRIJFADRES
   add constraint FK_INSCHRIJ_R_TOERNOO_SUBTOERN foreign key (TOERNOOI_ID, SUBTOERNOOI_ID)
      references SUBTOERNOOI (TOERNOOI_ID, SUBTOERNOOI_ID)
go

alter table LADDER
   add constraint FK_LADDER_R_LADDER__TOERNOOI foreign key (TOERNOOI_ID)
      references TOERNOOI (TOERNOOI_ID)
go

alter table LICENTIE
   add constraint FK_LICENTIE_R_FORMAT__SUBTOERN foreign key (TOERNOOI_ID, SUBTOERNOOI_ID)
      references SUBTOERNOOI (TOERNOOI_ID, SUBTOERNOOI_ID)
go

alter table PERSOON
   add constraint FK_PERSOON_R_CONTACT_VERENIGI foreign key (VERENIGING_NAAM)
      references VERENIGING (VERENIGING_NAAM)
go

alter table PERSOON
   add constraint FK_PERSOON_R_PERSOON_ADRES foreign key (POSTCODE, HUISNUMMER)
      references ADRES (POSTCODE, HUISNUMMER)
go

alter table SCORE
   add constraint FK_SCORE_R_SCORE_V_TEAM foreign key (TEAM_ID)
      references TEAM (TEAM_ID)
go

alter table SCORE
   add constraint FK_SCORE_R_SCORE_V_WEDSTRIJ foreign key (TOERNOOI_ID, SUBTOERNOOI_ID, WEDSTRIJD_ID)
      references WEDSTRIJD (TOERNOOI_ID, SUBTOERNOOI_ID, WEDSTRIJD_ID)
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
   add constraint FK_SPELERIN_SPELERINL_LADDER foreign key (TOERNOOI_ID, JAARTAL)
      references LADDER (TOERNOOI_ID, JAARTAL)
go

alter table SPELERINTEAM
   add constraint FK_SPELERIN_SPELERINT_TEAM foreign key (TEAM_ID)
      references TEAM (TEAM_ID)
go

alter table SPELERINTEAM
   add constraint FK_SPELERIN_SPELERINT_SPELER foreign key (PERSOON_ID)
      references SPELER (PERSOON_ID)
go

alter table SUBTOERNOOI
   add constraint FK_SUBTOERN_R_LEEFTIJ_LEEFTIJD foreign key (CATEGORIE_NAAM)
      references LEEFTIJDSCATEGORIE (CATEGORIE_NAAM)
go

alter table SUBTOERNOOI
   add constraint FK_SUBTOERN_SUBTOERNO_TOERNOOI foreign key (TOERNOOI_ID)
      references TOERNOOI (TOERNOOI_ID)
go

alter table TAFEL
   add constraint FK_TAFEL_R_TAFEL_V_VERENIGI foreign key (VERENIGING_NAAM)
      references VERENIGING (VERENIGING_NAAM)
go

alter table TEAMINSUBTOERNOOI
   add constraint FK_TEAMINSU_TEAMINSUB_TEAM foreign key (TEAM_ID)
      references TEAM (TEAM_ID)
go

alter table TEAMINSUBTOERNOOI
   add constraint FK_TEAMINSU_TEAMINSUB_SUBTOERN foreign key (TOERNOOI_ID, SUBTOERNOOI_ID)
      references SUBTOERNOOI (TOERNOOI_ID, SUBTOERNOOI_ID)
go

alter table TOERNOOI
   add constraint FK_TOERNOOI_R_ADRES_V_ADRES foreign key (POSTCODE, HUISNUMMER)
      references ADRES (POSTCODE, HUISNUMMER)
go

alter table TOERNOOI
   add constraint FK_TOERNOOI_R_TOERNOO_VERENIGI foreign key (VERENIGING_NAAM)
      references VERENIGING (VERENIGING_NAAM)
go

alter table VERENIGING
   add constraint FK_VERENIGI_R_ADRES_V_ADRES foreign key (POSTCODE, HUISNUMMER)
      references ADRES (POSTCODE, HUISNUMMER)
go

alter table WEDSTRIJD
   add constraint FK_WEDSTRIJ_R_SCHEIDS_WERKNEME foreign key (SCHEIDSRECHTER)
      references WERKNEMER (PERSOON_ID)
go

alter table WEDSTRIJD
   add constraint FK_WEDSTRIJ_R_TEAM1_V_TEAM foreign key (TEAM1)
      references TEAM (TEAM_ID)
go

alter table WEDSTRIJD
   add constraint FK_WEDSTRIJ_R_TEAM2_V_TEAM foreign key (TEAM2)
      references TEAM (TEAM_ID)
go

alter table WEDSTRIJD
   add constraint FK_WEDSTRIJ_R_WEDSTRI_SUBTOERN foreign key (TOERNOOI_ID, SUBTOERNOOI_ID)
      references SUBTOERNOOI (TOERNOOI_ID, SUBTOERNOOI_ID)
go

alter table WEDSTRIJD
   add constraint CK_WEDSTRIJD_TEAMS CHECK (Team1 <> Team2)
go

alter table WERKNEMER
   add constraint FK_WERKNEME_INHERITAN_PERSOON foreign key (PERSOON_ID)
      references PERSOON (PERSOON_ID)
go

alter table WERKNEMER
   add constraint FK_WERKNEME_R_FUNCTIE_FUNCTIE foreign key (FUNCTIE_NAAM)
      references FUNCTIE (FUNCTIE_NAAM)
go
-- Programmability
create PROC prcPlaatsSubtoernooi
			@TOERNOOI_ID D_ID,
			@CATEGORIE_NAAM D_CATNAME,
			@GESLACHT D_GESLACHT,
			@ENKEL D_BOOLEAN,
			@LICENTIES VARCHAR(30) = NULL
AS
BEGIN
	BEGIN TRY
	SET NOCOUNT ON
	DECLARE @t int = 0
		IF  @@trancount=0
			BEGIN
				BEGIN TRAN
				set @t =1
			END
		ELSE
			BEGIN
				SAVE TRANSACTION ProcedureSave;
			END
		IF @t =1
		 BEGIN
				--================= Code block ===================---
		DECLARE @SUBTOERNOOI_ID D_ID
			IF NOT EXISTS	( SELECT * FROM SUBTOERNOOI WHERE TOERNOOI_ID = @TOERNOOI_ID)
				BEGIN
					SET @SUBTOERNOOI_ID = 1
				END
			ELSE
				BEGIN
					SELECT @SUBTOERNOOI_ID = MAX(SUBTOERNOOI_ID) +1
					FROM SUBTOERNOOI
					WHERE TOERNOOI_ID = @TOERNOOI_ID
				END

			--LADDER TOERNOOI MOET ALTIJD
						-- VOOR BEIDE GESLACHTEN ZIJN;
						-- ENKELVORMIG
						-- GEEN KLASSE RESTRICTIES
			BEGIN TRY
			IF EXISTS (	SELECT *
						FROM TOERNOOI
						WHERE TOERNOOI_ID = @TOERNOOI_ID	AND
							  TOERNOOITYPE IN ('Ladder')
						)
					BEGIN
						IF(@SUBTOERNOOI_ID > 1)
							BEGIN
								RAISERROR ('Laddertoernooi mag maar één subtoernooi hebben',16,1)
							END
						IF NOT (@GESLACHT IS NULL)
							BEGIN
								RAISERROR ('Laddertoernooi mag geen geslachtsrestricties hebben.',16,1)
							END
						IF (@ENKEL = 0)
							BEGIN
								RAISERROR('Laddertoernooi is alleen voor enkel-vormige teams.',16,1)
							END

					END

			-- PRESTATIETOERNOOI MOET ALTJD
						-- MINIMAAL 1 LICENTIE HEBBEN
			IF NOT EXISTS (	SELECT *
						FROM TOERNOOI
						WHERE TOERNOOI_ID = @TOERNOOI_ID	AND
							  TOERNOOITYPE = 'Prestatie'
						)
				BEGIN
						IF (@LICENTIES IS NOT NULL)
							BEGIN
								RAISERROR('Alleen een prestatietoernooi mag een licentierestricties hebben.',16,1)
							END
				END
			ELSE
				BEGIN
					IF(@LICENTIES IS NULL)
						BEGIN
							RAISERROR('Prestatietoernooi moet minimaal 1 licentierestrictie hebben.',16,1)
						END
				END


			INSERT INTO SUBTOERNOOI
			VALUES
			(@TOERNOOI_ID,@SUBTOERNOOI_ID,@CATEGORIE_NAAM,@GESLACHT, @ENKEL)

			-- LICENTIES

		IF (RIGHT(@LICENTIES,1) != ',')
			BEGIN
				SET @LICENTIES = @LICENTIES + ','
			END

		DECLARE @pos INT
		DECLARE @len INT
		DECLARE @value varchar(8000)


		SET @pos = 0
		SET @len = 0

			WHILE CHARINDEX(',', @LICENTIES, @pos+1)>0
				BEGIN
					SET @len	= CHARINDEX(',', @LICENTIES, @pos+1) - @pos
					SET @value	= SUBSTRING(@LICENTIES, @pos, @len)

					INSERT INTO LICENTIE
					VALUES
					(UPPER(@value), @TOERNOOI_ID,@SUBTOERNOOI_ID)


					SET @pos = CHARINDEX(',', @LICENTIES, @pos+@len) +1
				END

			END TRY
			BEGIN CATCH
				THROW
			END CATCH
				--================================================---

			COMMIT TRAN
		 END
	END TRY
	BEGIN CATCH
		IF @t=0
			BEGIN
				ROLLBACK TRAN ProcedureSave

			END
		ELSE
			BEGIN
				ROLLBACK TRAN
			END;
	THROW
	END CATCH
END
GO
