-- INSERT SCRIPT FOR INSTANTFLOW DATABASE (OPTIMIZED)
-- Populates initial data: categories, movies, genres, relationships

SET NAMES utf8mb4;

-- =============================
-- CATEGORIES
-- =============================
INSERT INTO categories (name, price) VALUES
    ('Basic', 7.99),
    ('Plus', 9.99),
    ('Pro', 14.99)
ON DUPLICATE KEY UPDATE price = VALUES(price);

-- =============================
-- GENRES
-- =============================
INSERT INTO genres (name) VALUES
    ('Heroes'),
    ('Documentaries'),
    ('Science Fiction'),
    ('Animation'),
    ('Comedy'),
    ('True Stories'),
    ('Horror')
ON DUPLICATE KEY UPDATE name = VALUES(name);

-- =============================
-- FILMS
-- =============================
INSERT INTO films (title, description, release_date) VALUES
    ('12 Years a Slave', 'USA, pre-Civil War period. Solomon Northup, a free black man, is kidnapped and sold into slavery. Facing unspeakable cruelty, but also unexpected kindness, Solomon seeks to survive and maintain his dignity. An encounter with a Canadian abolitionist will change his life.', '2014-02-20'),
    ('Avengers: Endgame', 'The fourth part of the Avengers saga is the pinnacle of 22 interconnected Marvel films and the culmination of an epic journey. The world''s greatest heroes will finally understand how fragile our reality is - and the sacrifices necessary to defend it - in a story of friendship and teamwork.', '2019-04-24'),
    ('Our Planet', 'In this unique documentary film, David Attenborough reflects on the decisive moments of his life and the devastating changes he has witnessed.', '2020-04-16'),
    ('Forrest Gump', 'Forrest Gump is the cinematic event that became an authentic cultural phenomenon. Tom Hanks gives a stunning performance in the role of Forrest.', '1994-10-06'),
    ('Harry Potter and the Deathly Hallows', 'Harry, Ron and Hermione set out on their dangerous mission: to find and destroy Voldemort''s Horcruxes.', '2007-07-21'),
    ('The Lord of the Rings: The Two Towers', 'The sacred mission of Frodo Baggins and other members of the Fellowship continues, aimed at destroying the Ring.', '2003-01-16'),
    ('Interstellar', 'A team of explorers undertakes the most important mission in history: to travel beyond the galaxy to find humanity''s future.', '2014-10-26'),
    ('The Theory of Everything', 'University of Cambridge, 1963. Stephen Hawking, a promising physics student afflicted with a terrible disease, falls in love with and marries Jane Wilde.', '2014-11-07'),
    ('Now You See Me', 'Dylan Rhodes, a special FBI agent, is on the trail of a band of thieves made up of the world''s greatest illusionists.', '2013-05-21'),
    ('Now You See Me 2', 'A year after deceiving the FBI, the illusionists return with a new performance to expose the immoral practices of a tech magnate.', '2016-06-10'),
    ('Passengers', 'The Starship Avalon travels to Homestead II with passengers in cryogenic sleep. Two wake up 90 years before arrival.', '2016-12-22'),
    ('Intouchables', 'A box office hit based on a true story: the friendship between a wealthy disabled man and his ex-con caregiver.', '2012-02-24'),
    ('Quo Vado?', 'The story of a young man obsessed with job security and how he tries to preserve it despite reforms.', '2016-08-11'),
    ('Ratchet & Clank: Rift Apart', 'Ratchet and Clank must prevent a robot emperor from subduing interdimensional worlds, with the help of Rivet.', '2021-06-11'),
    ('Raya and the Last Dragon', 'Join Raya in her search for the last dragon.', '2021-12-31'),
    ('The Martian', 'Astronaut Mark Watney is presumed dead on Mars, but must find a way to contact Earth.', '2015-10-01'),
    ('Spider-Man: Homecoming', 'Peter returns home to Aunt May and relies on Tony Stark as Iron Man.', '2017-07-06'),
    ('The Batman', 'Batman prepares to eliminate organized crime in Gotham with the help of Jim Gordon and Harvey Dent.', '2022-03-04'),
    ('The Conjuring', 'The Warrens face a powerful demonic entity in their most terrifying investigation.', '2013-08-21'),
    ('The Danish Girl', 'Gerda asks her husband Einar to dress as a model for a portrait, and Einar begins to live as a woman.', '2016-02-04'),
    ('The Wolf of Wall Street', 'The film follows Belfort''s wild ride on Wall Street, becoming a corrupt market manipulator.', '2014-01-23')
ON DUPLICATE KEY UPDATE description = VALUES(description), release_date = VALUES(release_date);

-- =============================
-- RELATIONSHIPS (FILM → GENRE)
-- =============================
INSERT INTO has_genre (genre_id, film_id)
SELECT g.id, f.id FROM genres g, films f WHERE g.name = 'Heroes' AND f.title IN ('Avengers: Endgame', 'Spider-Man: Homecoming', 'The Batman')
ON DUPLICATE KEY UPDATE genre_id = genre_id;

INSERT INTO has_genre (genre_id, film_id)
SELECT g.id, f.id FROM genres g, films f WHERE g.name = 'Documentaries' AND f.title = 'Our Planet'
ON DUPLICATE KEY UPDATE genre_id = genre_id;

INSERT INTO has_genre (genre_id, film_id)
SELECT g.id, f.id FROM genres g, films f WHERE g.name = 'Science Fiction' AND f.title IN ('Avengers: Endgame','Harry Potter and the Deathly Hallows','The Lord of the Rings: The Two Towers','Interstellar','Now You See Me','Now You See Me 2','Passengers','Quo Vado?','Ratchet & Clank: Rift Apart')
ON DUPLICATE KEY UPDATE genre_id = genre_id;

INSERT INTO has_genre (genre_id, film_id)
SELECT g.id, f.id FROM genres g, films f WHERE g.name = 'Animation' AND f.title IN ('Quo Vado?','Ratchet & Clank: Rift Apart')
ON DUPLICATE KEY UPDATE genre_id = genre_id;

INSERT INTO has_genre (genre_id, film_id)
SELECT g.id, f.id FROM genres g, films f WHERE g.name = 'Comedy' AND f.title = 'Intouchables'
ON DUPLICATE KEY UPDATE genre_id = genre_id;

INSERT INTO has_genre (genre_id, film_id)
SELECT g.id, f.id FROM genres g, films f WHERE g.name = 'True Stories' AND f.title IN ('12 Years a Slave','Forrest Gump','The Theory of Everything','Passengers','The Wolf of Wall Street','Spider-Man: Homecoming')
ON DUPLICATE KEY UPDATE genre_id = genre_id;

INSERT INTO has_genre (genre_id, film_id)
SELECT g.id, f.id FROM genres g, films f WHERE g.name = 'Horror' AND f.title = 'The Conjuring'
ON DUPLICATE KEY UPDATE genre_id = genre_id;

-- =============================
-- ADMIN USER
-- =============================
INSERT INTO users (first_name, last_name, email, password, is_admin) VALUES
    ('Admin', 'Admin', AES_ENCRYPT('admin@email.com', 'Password!123'), '$2y$10$YourHashedPasswordHere', 1)
ON DUPLICATE KEY UPDATE is_admin = 1;