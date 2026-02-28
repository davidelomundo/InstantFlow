-- Table: films
CREATE TABLE IF NOT EXISTS films (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) UNIQUE NOT NULL,
    description TEXT,
    release_date DATE NOT NULL
);

-- Table: users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARBINARY(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    is_admin BOOLEAN NOT NULL DEFAULT 0
);

-- Table: categories
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) UNIQUE NOT NULL,
    price DECIMAL(6,2) NOT NULL CHECK (price >= 0)
);

-- Table: subscriptions
CREATE TABLE IF NOT EXISTS subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    end_date DATE NOT NULL,
    user_id INT NOT NULL,
    category_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
        ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id)
        ON UPDATE CASCADE ON DELETE CASCADE
);

-- Table: actors
CREATE TABLE IF NOT EXISTS actors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL
);

-- Table: cast (relationship)
CREATE TABLE IF NOT EXISTS cast (
    id INT AUTO_INCREMENT PRIMARY KEY,
    actor_id INT NOT NULL,
    film_id INT NOT NULL,
    FOREIGN KEY (actor_id) REFERENCES actors(id)
        ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (film_id) REFERENCES films(id)
        ON UPDATE CASCADE ON DELETE CASCADE
);

-- Table: genres
CREATE TABLE IF NOT EXISTS genres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) UNIQUE NOT NULL
);

-- Table: has_genre (relationship)
CREATE TABLE IF NOT EXISTS has_genre (
    id INT AUTO_INCREMENT PRIMARY KEY,
    genre_id INT NOT NULL,
    film_id INT NOT NULL,
    FOREIGN KEY (genre_id) REFERENCES genres(id)
        ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (film_id) REFERENCES films(id)
        ON UPDATE CASCADE ON DELETE CASCADE
);

-- Table: watches
CREATE TABLE IF NOT EXISTS watches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    film_id INT NOT NULL,
    watched_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    duration TIME NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
        ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (film_id) REFERENCES films(id)
        ON UPDATE CASCADE ON DELETE CASCADE
);