/*create database YHEventApp;
use YHEventApp;*/
create table Event(
	idEvent int primary key not null auto_increment,
	titleEvent varchar(500) not null,
    logoEvent text,
    lieuEvent varchar(100) not null,
    lieuEventPic text,
    datedebutEvent datetime not null,
    datefinEvent datetime not null,
    datedebutInsc datetime not null,
    datefinInsc datetime not null,
);

create table Event1(
	idEvent int primary key not null auto_increment,
	titleEvent varchar(500) not null check(titleEvent!=''),
    logoEvent text,
    lieuEvent varchar(100) not null check(lieuEvent!=''),
    lieuEventPic text,
    datedebutEvent datetime,
    datefinEvent datetime
);
create table inscription(
	idEvent int not null,
    idInsc int primary key not null auto_increment,
	genre varchar(10) not null check(genre in ('Monsieur','Madame')),
    nom varchar(50) not null,
    prenom varchar(50) not null,
    niveauExp varchar(10) not null check(niveauExp in ('Débutant','Confirmé','Expert')),
	email text not null,
    tel varchar(15),
    adressePost varchar(500),
    dept varchar(50) not null,
    pays varchar(50) not null,
    repas text,
    pdf int DEFAULT 0,
    foreign key (idEvent) references Event(idEvent)
);
create table repas(
    idInsc int not null,
	dateRepas datetime not null check(dateRepas between (select datedebutEvent from Event as e,inscription as i where e.idEvent=i.idEvent) and (select datefinEvent from Event as e,inscription as i where e.idEvent=i.idEvent)),
    primary key (idInsc,dateRepas)
);
CREATE table master(
  username VARCHAR(300),
  pass VARCHAR(300)
);
--crypté avec echo crypt("crazyadmin","HarounShmayroYesWeCan");
insert into master  VALUES ('Shmayro','HaZJ7VUd3UmuM');
