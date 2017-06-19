INSERT INTO Asiakas (tunnus, salasana, nimi, email, osoite, puh, tilauskielto) VALUES ('jukankalakauppa', 'kala123', 'Jukan Kalakauppa Oy', 'kalaa@jukankalakauppa.com', 'Kampelatie 1, 12345 Kalalaakso', '02123456', false);
INSERT INTO Asiakas (tunnus, salasana, nimi, email, osoite, puh, tilauskielto) VALUES ('seponsiika', 'kala', 'Sepon Siikakauppa Oy', 'kalaa@seponsiika.com', 'Siikatie 1, 12345 Siikalaakso', '09123456', 'false');

INSERT INTO Tuote (nimike, hinta, kuvaus, varastosaldo, halytyssaldo) VALUES ('Siika', 14.90, 'Tuore kala', 10, 5);

INSERT INTO Yllapito (tunnus, salasana) VALUES ('yp', 'aaa');