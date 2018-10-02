INSERT INTO categories (name)
VALUES
  ('Доски и лыжи'),
  ('Крепления'),
  ('Ботинки'),
  ('Одежда'),
  ('Инструменты'),
  ('Разное')
;

INSERT INTO users (reg_date, email, name, password, avatar_url, contact)
VALUES
  ('2018-05-12 07:00:10', 'ignat.v@gmail.com', 'Игнат', '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka', 'img/ava1.png', 'Академическая'),
  ('2018-05-11 08:00:10', 'kitty_93@li.ru', 'Леночка', '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa', 'img/ava2.png', 'Скайп'),
  ('2018-05-10 09:00:10', 'warrior07@mail.ru', 'Руслан', '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW', 'img/ava3.png', 'Гитхаб')
;

INSERT INTO lots (create_date, name, description, image_url, start_price, finish_date, bet_step, author_id, winner_id, category_id)
VALUES
  (NOW(), '2014 Rossignol District Snowboard', 'Пустое описание', 'img/lot-1.jpg', 10999, NOW() + INTERVAL FLOOR(RAND() * 14) DAY + INTERVAL FLOOR(RAND() * 24) HOUR, 100, 1, null, 1),
  (NOW(), 'DC Ply Mens 2016/2017 Snowboard', 'Пустое описание', 'img/lot-2.jpg', 15999, NOW() + INTERVAL FLOOR(RAND() * 14) DAY + INTERVAL FLOOR(RAND() * 24) HOUR, 100, 2, null, 1),
  (NOW(), 'Крепления Union Contact Pro 2015 года размер L/XL', 'Пустое описание', 'img/lot-3.jpg', 8000, NOW() + INTERVAL FLOOR(RAND() * 14) DAY + INTERVAL FLOOR(RAND() * 24) HOUR, 100, 3, null, 2),
  (NOW(), 'Ботинки для сноуборда DC Mutiny Charocal', 'Пустое описание', 'img/lot-4.jpg', 7500, NOW() + INTERVAL FLOOR(RAND() * 14) DAY + INTERVAL FLOOR(RAND() * 24) HOUR, 100, 1, null, 4),
  (NOW(), 'Куртка для сноуборда DC Mutiny Charocal', 'Пустое описание', 'img/lot-5.jpg', 7500, NOW() + INTERVAL FLOOR(RAND() * 14) DAY + INTERVAL FLOOR(RAND() * 24) HOUR, 100, 1, null, 4),
  (NOW(), 'Маска Oakley Canopy', 'Пустое описание', 'img/lot-6.jpg', 5400, NOW() + INTERVAL FLOOR(RAND() * 14) DAY + INTERVAL FLOOR(RAND() * 24) HOUR, 100, 2, null, 6)
;

INSERT INTO bets (date, summ, user_id, lot_id)
VALUES
  (NOW() + INTERVAL FLOOR(RAND() * 24) HOUR + INTERVAL FLOOR(RAND() * 60) MINUTE, 16000, 1, 1),
  (NOW() + INTERVAL FLOOR(RAND() * 24) HOUR + INTERVAL FLOOR(RAND() * 60) MINUTE, 17000, 1, 2),
  (NOW() + INTERVAL FLOOR(RAND() * 24) HOUR + INTERVAL FLOOR(RAND() * 60) MINUTE, 18000, 1, 3),
  (NOW() + INTERVAL FLOOR(RAND() * 24) HOUR + INTERVAL FLOOR(RAND() * 60) MINUTE, 19000, 2, 2)
;
