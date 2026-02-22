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
    ('Severance', 'A group of office workers at a mysterious company discover that their employer has sinister plans for them.', '2022-02-18'),
    ('Flow', 'Cat is a solitary animal, but as its home is devastated by a great flood, he finds refuge on a boat populated by various species, and will have to team up with them despite their differences.', '2024-05-22'),
    ('Interstellar', 'A team of explorers undertakes the most important mission in history: to travel beyond the galaxy to find humanity''s future.', '2014-10-26'),
    ('12 Years a Slave', 'USA, pre-Civil War period. Solomon Northup, a free black man, is kidnapped and sold into slavery. Facing unspeakable cruelty, but also unexpected kindness, Solomon seeks to survive and maintain his dignity. An encounter with a Canadian abolitionist will change his life.', '2014-02-20'),
    ('Avengers: Endgame', 'The fourth part of the Avengers saga is the pinnacle of 22 interconnected Marvel films and the culmination of an epic journey. The world''s greatest heroes will finally understand how fragile our reality is - and the sacrifices necessary to defend it - in a story of friendship and teamwork.', '2019-04-24'),
    ('The Theory of Everything', 'University of Cambridge, 1963. Stephen Hawking, a promising physics student afflicted with a terrible disease, falls in love with and marries Jane Wilde.', '2014-11-07'),
    ('The Batman', 'Batman prepares to eliminate organized crime in Gotham with the help of Jim Gordon and Harvey Dent.', '2022-03-04'),
    ('The Conjuring', 'The Warrens face a powerful demonic entity in their most terrifying investigation.', '2013-08-21'),
    ('Ted Lasso', 'American football coach Ted Lasso is hired to coach a British soccer team, despite having no experience with the sport.', '2020-08-14'),
    ('The Wolf of Wall Street', 'The film follows Belfort''s wild ride on Wall Street, becoming a corrupt market manipulator.', '2014-01-23'),
    ('The Year Earth Changed', 'A documentary that explores the profound impact of the COVID-19 pandemic on the natural world, revealing how reduced human activity has led to unexpected environmental changes.', '2021-03-26'),
    ('Ratchet & Clank: Rift Apart', 'Ratchet and Clank must prevent a robot emperor from subduing interdimensional worlds, with the help of Rivet.', '2021-06-11')
ON DUPLICATE KEY UPDATE description = VALUES(description), release_date = VALUES(release_date);

-- =============================
-- RELATIONSHIPS (FILM → GENRE)
-- =============================
INSERT INTO has_genre (genre_id, film_id)
SELECT g.id, f.id FROM genres g, films f WHERE g.name = 'Heroes' AND f.title IN ('Avengers: Endgame', 'The Batman')
ON DUPLICATE KEY UPDATE genre_id = genre_id;

INSERT INTO has_genre (genre_id, film_id)
SELECT g.id, f.id FROM genres g, films f WHERE g.name = 'Documentaries' AND f.title = 'The Year Earth Changed'
ON DUPLICATE KEY UPDATE genre_id = genre_id;

INSERT INTO has_genre (genre_id, film_id)
SELECT g.id, f.id FROM genres g, films f WHERE g.name = 'Comedy' AND f.title = 'Ted Lasso'
ON DUPLICATE KEY UPDATE genre_id = genre_id;

INSERT INTO has_genre (genre_id, film_id)
SELECT g.id, f.id FROM genres g, films f WHERE g.name = 'Science Fiction' AND f.title IN ('Avengers: Endgame','Interstellar', 'Severance', 'Ratchet & Clank: Rift Apart')
ON DUPLICATE KEY UPDATE genre_id = genre_id;

INSERT INTO has_genre (genre_id, film_id)
SELECT g.id, f.id FROM genres g, films f WHERE g.name = 'Animation' AND f.title IN ('Flow', 'Ratchet & Clank: Rift Apart')
ON DUPLICATE KEY UPDATE genre_id = genre_id;

INSERT INTO has_genre (genre_id, film_id)
SELECT g.id, f.id FROM genres g, films f WHERE g.name = 'True Stories' AND f.title IN ('12 Years a Slave','The Theory of Everything','The Wolf of Wall Street')
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