/*
Created		10/05/2017
Modified		31/05/2017
Project		
Model		
Company		
Author		
Version		
Database		mySQL 5 
*/


Create table skladbe (
	id Int NOT NULL AUTO_INCREMENT,
	album_id Int NOT NULL,
	naslov Varchar(50) NOT NULL,
	url Varchar(100) NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;

Create table zanri (
	id Int NOT NULL,
	ime Varchar(50) NOT NULL,
	opis Text,
 Primary Key (id)) ENGINE = MyISAM;

Create table avtorji (
	id Int NOT NULL AUTO_INCREMENT,
	ime Varchar(50) NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;

Create table skladbe_zanri (
	id Int NOT NULL AUTO_INCREMENT,
	zanr_id Int NOT NULL,
	skladba_id Int NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;

Create table izvajalci (
	id Int NOT NULL AUTO_INCREMENT,
	ime Varchar(50) NOT NULL,
	opis Text,
 Primary Key (id)) ENGINE = MyISAM;

Create table avtorji_skladbe (
	id Int NOT NULL AUTO_INCREMENT,
	avtor_id Int NOT NULL,
	skladba_id Int NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;

Create table izvajalci_skladbe (
	id Int NOT NULL AUTO_INCREMENT,
	skladba_id Int NOT NULL,
	izvajalec_id Int NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;

Create table albumi (
	id Int NOT NULL AUTO_INCREMENT,
	ime Varchar(50) NOT NULL,
	leto_izida Varchar(20),
 Primary Key (id)) ENGINE = MyISAM;

Create table uporabniki (
	id Int NOT NULL AUTO_INCREMENT,
	u_ime Varchar(50) NOT NULL,
	geslo Varchar(50) NOT NULL,
	e_mail Varchar(50) NOT NULL,
	admin Bool NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;

Create table skladbe_uporabniki (
	id Int NOT NULL AUTO_INCREMENT,
	uporabnik_id Int NOT NULL,
	skladba_id Int NOT NULL,
	besedilo Text NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;


Alter table skladbe_zanri add Foreign Key (zanr_id) references skladbe (id) on delete  restrict on update  restrict;
Alter table avtorji_skladbe add Foreign Key (avtor_id) references skladbe (id) on delete  restrict on update  restrict;
Alter table izvajalci_skladbe add Foreign Key (izvajalec_id) references skladbe (id) on delete  restrict on update  restrict;
Alter table skladbe_uporabniki add Foreign Key (uporabnik_id) references skladbe (id) on delete  restrict on update  restrict;
Alter table skladbe_zanri add Foreign Key (skladba_id) references zanri (id) on delete  restrict on update  restrict;
Alter table avtorji_skladbe add Foreign Key (skladba_id) references avtorji (id) on delete  restrict on update  restrict;
Alter table izvajalci_skladbe add Foreign Key (skladba_id) references izvajalci (id) on delete  restrict on update  restrict;
Alter table skladbe add Foreign Key (album_id) references albumi (id) on delete  restrict on update  restrict;
Alter table skladbe_uporabniki add Foreign Key (skladba_id) references uporabniki (id) on delete  restrict on update  restrict;


