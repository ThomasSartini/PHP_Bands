DROP DATABASE IF EXISTS bands;
create database bands;
use bands;

Create table administrator(
	id int auto_increment primary key,
	user varchar(25) not null,
	password varchar(300) not null
);

Create table band(
	id int auto_increment primary key,
	user varchar(25) not null,
	password varchar(300) not null
);

create table genere(
	genere varchar(25) primary key
);

create table tipologia(
	tipologia varchar(25) primary key
);

create table strumento(
	strumento varchar(25) primary key
);

create table canzone(
	id int auto_increment primary key,
	titolo varchar(25) not null,
	autore varchar(25) not null,
	anno int(4) not null,
	descrizione  varchar(25) not null,
	audio  varchar(250) not null,
    testo varchar(700),
	album  varchar(25) not null,
	bpm int(3) not null,
	genere VARCHAR(25),
    tipologia VARCHAR(25),
    band_id INT,
    FOREIGN KEY(band_id) REFERENCES band(Id),
	FOREIGN KEY(genere) REFERENCES genere(genere),
    FOREIGN KEY(tipologia) REFERENCES tipologia(tipologia)
);


create table annotazione(
	id INT PRIMARY KEY auto_increment,
    posizione INT,
    testo VARCHAR(25),
    canzone_id INT,
    FOREIGN KEY(canzone_id) REFERENCES canzone(id)
);

create table accordo(
	id INT PRIMARY KEY auto_increment,
    indice_parola INT,
    testo VARCHAR(15),
    inizio_fine TINYINT(1),
    canzone_id INT,
    FOREIGN KEY(canzone_id) REFERENCES canzone(id)
);

create table scaletta(
	id INT PRIMARY KEY auto_increment,
    nome varchar(30),
    data DATE,
    ora_inizio TIME,
    ora_fine TIME,
    band_id INT,
    FOREIGN KEY(band_id) REFERENCES band(id)
);

create table scaletta_canzone(
	scaletta_id INT,
    canzone_id INT,
    FOREIGN KEY(scaletta_id) REFERENCES scaletta(id),
    FOREIGN KEY(canzone_id) REFERENCES canzone(id),
    PRIMARY KEY(scaletta_id, canzone_id)
);

create table strumento_canzone(
	strumentoNome varchar(25),
    canzone_id INT,
    FOREIGN KEY(strumentoNome) REFERENCES strumento(strumento),
    FOREIGN KEY(canzone_id) REFERENCES canzone(id),
    PRIMARY KEY(strumentoNome, canzone_id)
);

-- INSERT

INSERT INTO band(user, password) VALUES("ale", "a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3");

INSERT INTO genere(genere) VALUES("rock"),("metal"),("blues"),("pop"),("rap"),("jazz");
INSERT INTO tipologia(tipologia) VALUES("lenta"),("tranquilla"),("veloce"),("invitante"),("scatenata"),("difficile");
INSERT INTO strumento(strumento) VALUES("chitarra"),("basso"),("batteria"),("piano"),("tromba"),("violino");

