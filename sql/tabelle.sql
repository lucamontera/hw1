drop schema homework; 
create schema homework;
use homework;



create table CREDENZIALI
(
	idUtente integer primary key auto_increment,
	nome varchar(255) not null, 
    cognome varchar(255) not null,
    dataNascita varchar(255),
    username varchar(255) not null unique,
    password text(20) not null,
	email varchar(255) not null unique, 
    immagineProfilo blob,
    descrizione text, 
    numeroOpereCaricate integer, 
    numeroPost integer
)Engine='InnoDB';


create table OPERA
(
	idOpera integer primary key auto_increment,
    username varchar(255), 
    nome varchar(255) not null, 
    tema varchar(255), 
    descrizione varchar(255) not null,
    prezzo varchar(255), 
    dimensioni varchar(255), 
    srcImmagine longblob not null,
    likes integer default 0,
    commenti integer default 0, 
    INDEX idx_username(username),
    FOREIGN KEY(username) REFERENCES CREDENZIALI(username)
)Engine='InnoDB';

create table LIKES
(
	id integer primary key auto_increment,
	idOpera integer,
    username varchar(255),
    
    INDEX idx_username(username),
    FOREIGN KEY(username) REFERENCES CREDENZIALI(username),
	INDEX idx_idOpera(idOpera),
    FOREIGN KEY(idOpera) REFERENCES OPERA(idOpera)
); 

create table PREFERITO
(
	id integer primary key auto_increment,
	idOpera integer,
    username varchar(255),
    
    INDEX idx_username(username),
    FOREIGN KEY(username) REFERENCES CREDENZIALI(username),
	INDEX idx_idOpera(idOpera),
    FOREIGN KEY(idOpera) REFERENCES OPERA(idOpera)
); 

create table COMMENTI
(
	id integer primary key auto_increment,
	idOpera integer,
    username varchar(255),
    commento text,
    
    INDEX idx_username(username),
    FOREIGN KEY(username) REFERENCES CREDENZIALI(username),
	INDEX idx_idOpera(idOpera),
    FOREIGN KEY(idOpera) REFERENCES OPERA(idOpera)
); 




/*TRIGGER*/

create trigger incrementoOpere 
after insert on OPERA
for each row 
update CREDENZIALI 
set numeroOpereCaricate = numeroOpereCaricate + 1
where username = new.username; 



create trigger incrementoLike 
after insert on LIKES
for each row
update OPERA 
set likes = likes+1
where idOpera = new.idOpera;

create trigger decrementoLike 
after delete on LIKES
for each row
update OPERA 
set likes = likes-1
where idOpera = old.idOpera;

create trigger incrementoCommenti
after insert on COMMENTI
for each row
update OPERA 
set commenti = commenti+1
where idOpera = new.idOpera;

create trigger decrementoCommenti
after delete on COMMENTI
for each row
update OPERA 
set commenti = commenti-1
where idOpera = old.idOpera;

drop trigger incrementoLike;
drop trigger numeroOpereCaricate;
use homework;

select * from CREDENZIALI; 

insert into CREDENZIALI values (0,'luca','montera','2 maggio 1998', 'lucamontera','ingegneria', 'luca.montera98@gmail.com', null,null, 0,0);

