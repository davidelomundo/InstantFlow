-- INSERT SCRIPT FOR INSTANTFLOW DATABASE (OPTIMIZED)
-- Populates initial data: categories, movies, genres, relationships

SET NAMES utf8mb4;

-- =============================
-- CATEGORIES
-- =============================
INSERT INTO categorie (nome, prezzo) VALUES
    ('Basic', 7.99),
    ('Plus', 9.99),
    ('Pro', 14.99)
ON DUPLICATE KEY UPDATE prezzo = VALUES(prezzo);

-- =============================
-- GENRES
-- =============================
INSERT INTO generi (nome) VALUES
    ('Eroi'),
    ('Documentari'),
    ('Fantascienza'),
    ('Animazione'),
    ('Comico'),
    ('Storie vere'),
    ('Horror')
ON DUPLICATE KEY UPDATE nome = VALUES(nome);

-- =============================
-- FILMS
-- =============================
INSERT INTO films (titolo, descrizione, data_uscita) VALUES
    ('12 Anni Schiavo', 'USA, periodo pre-guerra civile. Solomon Northup, un uomo nero libero, viene rapito e venduto come schiavo. Affrontando crudeltà inaudite, ma anche gentilezze inaspettate, Solomon cerca di sopravvivere e mantenere la propria dignità. L’incontro con un abolizionista canadese gli cambierà la vita.', '2014-02-20'),
    ('Avengers: Endgame', 'La quarta parte della saga degli Avengers è l\'apice di 22 film interconnessi della Marvel e il culmine di un viaggio epico. I più grandi eroi del mondo finalmente capiranno quanto è fragile la nostra realtà - e i sacrifici necessari per difenderla - in una storia di amicizia e lavoro di squadra.', '2019-04-24'),
    ('Una vita sul nostro pianeta', 'In questo film documentario unico nel suo genere, David Attenborough riflette sui momenti decisivi della sua vita e sui cambiamenti devastanti a cui ha assistito.', '2020-04-16'),
    ('Forrest Gump', 'Forrest Gump è l’evento cinematografico divenuto un autentico fenomeno di costume. Tom Hanks dà una sbalorditiva prova d’attore nel ruolo di Forrest.', '1994-10-06'),
    ('Harry Potter e i Doni Della Morte', 'Harry, Ron ed Hermione partono per compiere la loro pericolosa missione: trovare e distruggere gli Horcrux di Voldemort.', '2007-07-21'),
    ('Il Signore degli Anelli: le Due Torri', 'Prosegue la sacra missione di Frodo Baggins e degli altri membri della Compagnia volta a distruggere l’Anello.', '2003-01-16'),
    ('Interstellar', 'Un team di esploratori intraprende la più importante missione della storia: viaggiare oltre i confini della galassia per trovare il futuro dell\'umanità.', '2014-10-26'),
    ('La Teoria del Tutto', 'Università di Cambridge, 1963. Stephen Hawking, promettente studente di fisica affetto da una terribile malattia, si innamora e sposa Jane Wilde.', '2014-11-07'),
    ('Now You See Me', 'Dylan Rhodes, agente speciale dell\'FBI, è sulle tracce di una banda di ladri formata dai più grandi illusionisti del mondo.', '2013-05-21'),
    ('Now You See Me 2', 'Un anno dopo aver ingannato l\'FBI, gli illusionisti ritornano con una nuova performance per smascherare le pratiche immorali di un magnate della tecnologia.', '2016-06-10'),
    ('Passengers', 'L\'astronave Starship Avalon viaggia verso Homestead II con passeggeri in sonno criogenico. Due si svegliano 90 anni prima dell\'arrivo.', '2016-12-22'),
    ('Quasi Amici', 'Commedia campione d\'incassi basata su una storia vera: l\'amicizia tra un ricco disabile ed il suo badante ex detenuto.', '2012-02-24'),
    ('Quo Vado', 'Racconta la storia di un giovane ossessionato dal posto fisso e come cerca di preservarlo nonostante le riforme.', '2016-08-11'),
    ('Ratchet & Clank: Rift Apart', 'Ratchet e Clank devono impedire che un imperatore robot sottometta i mondi interdimensionali, con l\'aiuto di Rivet.', '2021-06-11'),
    ('Raya e l\'Ultimo Drago', 'Unisciti a Raya nella sua ricerca dell\'ultimo drago.', '2021-12-31'),
    ('Sopravvissuto - The martian', 'L\'astronauta Mark Watney viene dato per morto su Marte, ma deve trovare il modo di contattare la Terra.', '2015-10-01'),
    ('Spider-Man: Homecoming', 'Peter torna a casa dalla zia May e si affida a Tony Stark nei panni di Iron Man.', '2017-07-06'),
    ('The Batman', 'Batman si prepara a eliminare il crimine organizzato a Gotham con l\'aiuto di Jim Gordon e Harvey Dent.', '2022-03-04'),
    ('The Conjuring - L\'Evocazione', 'I Warren affrontano una potente entità demoniaca nella loro indagine più terrificante.', '2013-08-21'),
    ('The Danish Girl', 'Gerda chiede a suo marito Einar di travestirsi da modella per un ritratto, e Einar inizia a vivere come donna.', '2016-02-04'),
    ('The Wolf of Wall Street', 'Il film segue la folle cavalcata di Belfort a Wall Street, diventando un corrotto manipolatore dei mercati.', '2014-01-23')
ON DUPLICATE KEY UPDATE descrizione = VALUES(descrizione), data_uscita = VALUES(data_uscita);

-- =============================
-- RELATIONSHIPS (FILM → GENRE)
-- =============================
INSERT INTO appartiene (id_genere, id_film)
SELECT g.id, f.id FROM generi g, films f WHERE g.nome = 'Eroi' AND f.titolo IN ('Avengers: Endgame', 'Spider-Man: Homecoming', 'The Batman')
ON DUPLICATE KEY UPDATE id_genere = id_genere;

INSERT INTO appartiene (id_genere, id_film)
SELECT g.id, f.id FROM generi g, films f WHERE g.nome = 'Documentari' AND f.titolo = 'Una vita sul nostro pianeta'
ON DUPLICATE KEY UPDATE id_genere = id_genere;

INSERT INTO appartiene (id_genere, id_film)
SELECT g.id, f.id FROM generi g, films f WHERE g.nome = 'Fantascienza' AND f.titolo IN ('Avengers: Endgame','Harry Potter e i Doni Della Morte','Il Signore degli Anelli: le Due Torri','Interstellar','Now You See Me','Now You See Me 2','Passengers','Quo Vado','Ratchet & Clank: Rift Apart')
ON DUPLICATE KEY UPDATE id_genere = id_genere;

INSERT INTO appartiene (id_genere, id_film)
SELECT g.id, f.id FROM generi g, films f WHERE g.nome = 'Animazione' AND f.titolo IN ('Quo Vado','Ratchet & Clank: Rift Apart')
ON DUPLICATE KEY UPDATE id_genere = id_genere;

INSERT INTO appartiene (id_genere, id_film)
SELECT g.id, f.id FROM generi g, films f WHERE g.nome = 'Comico' AND f.titolo = 'Quasi Amici'
ON DUPLICATE KEY UPDATE id_genere = id_genere;

INSERT INTO appartiene (id_genere, id_film)
SELECT g.id, f.id FROM generi g, films f WHERE g.nome = 'Storie vere' AND f.titolo IN ('12 Anni Schiavo','Forrest Gump','La Teoria del Tutto','Passengers','The Wolf of Wall Street','Spider-Man: Homecoming')
ON DUPLICATE KEY UPDATE id_genere = id_genere;

INSERT INTO appartiene (id_genere, id_film)
SELECT g.id, f.id FROM generi g, films f WHERE g.nome = 'Horror' AND f.titolo = 'The Conjuring - L\'Evocazione'
ON DUPLICATE KEY UPDATE id_genere = id_genere;

-- =============================
-- ADMIN PROMOTION
-- =============================
UPDATE utenti SET is_admin = 1
WHERE email = AES_ENCRYPT('davide@email.com', 'Password!123');