CREATE TABLE Asiakas(
    id SERIAL PRIMARY KEY,
    tunnus varchar(20) NOT NULL,
    salasana varchar(20) NOT NULL,
    nimi varchar(50) NOT NULL,
    email varchar(50) NOT NULL,
    osoite varchar(50) NOT NULL,
    puh varchar(50) NOT NULL
);

CREATE TABLE Tilaus(
	id SERIAL PRIMARY KEY,
	asiakas_id INTEGER REFERENCES Asiakas(id),
	loppusumma decimal NOT NULL,
	maksettu boolean DEFAULT FALSE
);

CREATE TABLE Tuote(
	id SERIAL PRIMARY KEY,
	nimike varchar(50) NOT NULL,
	hinta decimal NOT NULL,
	kuvaus varchar(200),
	varastosaldo INTEGER NOT NULL CHECK (varastosaldo >= 0),
	halytyssaldo INTEGER NOT NULL CHECK (halytyssaldo > 0)
);

CREATE TABLE Tilatut(
	tilaus_id INTEGER REFERENCES Tilaus(id),
	tuote_id INTEGER REFERENCES Tuote(id),
	lkm INTEGER NOT NULL CHECK (lkm > 0)
);

CREATE TABLE Yllapito(
	id SERIAL PRIMARY KEY,
	tunnus varchar(10) NOT NULL,
	salasana varchar(20) NOT NULL
);
