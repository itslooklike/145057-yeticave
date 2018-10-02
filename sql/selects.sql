
-- получить все категории
SELECT * FROM categories
;

-- получить самые новые, открытые лоты.
-- Каждый лот должен включать:
-- название, стартовую цену, ссылку на изображение, цену, количество ставок, название категории
SELECT
  lots.id,
  lots.name as title,
  lots.start_price,
  lots.image_url,
  (SELECT MAX(bets.summ) FROM bets WHERE lots.id = bets.lot_id) max_price,
  (SELECT COUNT(bets.lot_id) FROM bets WHERE lots.id = bets.lot_id GROUP BY bets.lot_id) bets_amount,
  categories.name as category
FROM lots
JOIN categories ON categories.id = lots.category_id
-- JOIN bets ON bets.lot_id = lots.id
WHERE lots.finish_date > NOW()
GROUP BY lots.name, lots.start_price, lots.image_url, categories.name, lots.create_date, lots.id
ORDER BY lots.create_date DESC
;

-- показать лот по его id. Получите также название категории, к которой принадлежит лот
SELECT lots.name, categories.name AS 'category' FROM lots
JOIN categories ON lots.category_id = categories.id
WHERE lots.id = 1
;

-- обновить название лота по его идентификатору
UPDATE lots SET name = '2014 Rossignol District Snowboard NEW' WHERE id = 1
;

-- получить список самых свежих ставок для лота по его идентификатору
SELECT * FROM bets WHERE lot_id = 1 ORDER BY date DESC
;

-- получить юзера
SELECT * FROM users WHERE email = 'warrior07@mail.ru'
;

-- поиск
SELECT * FROM lots
WHERE name LIKE '%куртка%' OR start_price LIKE '%10%'
;
