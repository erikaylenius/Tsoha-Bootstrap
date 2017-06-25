CREATE TABLE Asiakas(
    id SERIAL PRIMARY KEY,
    tunnus varchar(20) NOT NULL,
    salasana varchar(20) NOT NULL,
    nimi varchar(50) NOT NULL,
    email varchar(50) NOT NULL,
    osoite varchar(50) NOT NULL,
    puh varchar(20) NOT NULL
);

CREATE TABLE Tilaus(
	id SERIAL PRIMARY KEY,
	asiakas_id INTEGER REFERENCES Asiakas(id),
	loppusumma decimal NOT NULL,
	pvm DATE
);

CREATE TABLE Tuote(
	id SERIAL PRIMARY KEY,
	nimike varchar(50) NOT NULL,
	hinta decimal NOT NULL,
	kuvaus varchar(200)
);

CREATE TABLE Tilattava(
	id SERIAL PRIMARY KEY,
	tilaus_id INTEGER REFERENCES Tilaus(id),
	tuote_id INTEGER REFERENCES Tuote(id),
	lkm INTEGER NOT NULL CHECK (lkm > 0)
);

CREATE TABLE Yllapito(
	id SERIAL PRIMARY KEY,
	tunnus varchar(10) NOT NULL,
	salasana varchar(20) NOT NULL
);
