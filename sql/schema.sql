DROP DATABASE yeticave;

CREATE DATABASE yeticave
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE yeticave;

CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(64)
);
CREATE UNIQUE INDEX name ON categories(name);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  reg_date DATETIME,
  email VARCHAR(64),
  name VARCHAR(64),
  password VARCHAR(64),
  avatar_url VARCHAR(128),
  contact VARCHAR(128)
);
CREATE UNIQUE INDEX email ON users(email);

CREATE TABLE lots (
  id INT AUTO_INCREMENT PRIMARY KEY,
  create_date DATETIME,
  name VARCHAR(64),
  description VARCHAR(128),
  image_url VARCHAR(128),
  start_price INT,
  finish_date DATETIME,
  bet_step INT,
  author_id INT,
  winner_id INT,
  category_id INT,
  FOREIGN KEY (author_id) REFERENCES users(id),
  FOREIGN KEY (winner_id) REFERENCES users(id),
  FOREIGN KEY (category_id) REFERENCES categories(id)
);
CREATE INDEX l_name ON lots(name);
CREATE INDEX l_description ON lots(description);

CREATE TABLE bets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date DATETIME,
  summ INT,
  user_id INT,
  lot_id INT,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (lot_id) REFERENCES lots(id)
);

CREATE FULLTEXT INDEX lots_search ON lots(name, description);
