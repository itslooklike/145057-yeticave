<?php

return (function () {
    function get_categories()
    {
        return 'SELECT name FROM categories ORDER by id ASC;';
    }

    function get_id_category_by_name($name)
    {
        return 'SELECT id FROM categories WHERE name = "' . $name . '";';
    }

    function get_actual_lots($search_word = false)
    {
        $search = $search_word ? ' AND MATCH(lots.name, lots.description) AGAINST("' . $search_word . '")' : '';

        return "SELECT
            lots.id,
            lots.name as title,
            lots.start_price,
            lots.finish_date,
            lots.image_url,
            (SELECT MAX(bets.summ) FROM bets WHERE lots.id = bets.lot_id) max_price,
            (SELECT COUNT(bets.lot_id) FROM bets WHERE lots.id = bets.lot_id GROUP BY bets.lot_id) bets_amount,
            categories.name as category
        FROM lots
        JOIN categories ON categories.id = lots.category_id
        -- JOIN bets ON bets.lot_id = lots.id
        WHERE lots.finish_date > NOW(){$search}
        GROUP BY
        lots.name, lots.start_price, lots.finish_date, lots.image_url, categories.name, lots.create_date, lots.id
        ORDER BY lots.create_date DESC;";
    }

    function search_lot($search_word)
    {
        return 'SELECT * FROM lots WHERE MATCH(name,description) AGAINST("' . $search_word . '");';
    }

    function get_lot($id)
    {
        return 'SELECT
            lots.name,
            lots.description,
            lots.image_url,
            lots.bet_step,
            lots.start_price,
            lots.finish_date,
            categories.name AS category
        FROM lots
        JOIN categories ON lots.category_id = categories.id
        WHERE lots.id = ' . $id . ';';
    }

    function get_bets($id)
    {
        return 'SELECT bets.date, bets.summ, users.name
        FROM bets
        JOIN users ON bets.user_id = users.id
        WHERE lot_id = ' . $id . ' ORDER BY summ DESC;';
    }

    function get_bet_step($id)
    {
        return 'SELECT bet_step
        FROM lots
        WHERE id = ' . $id . ';';
    }

    function get_user_by_email($email)
    {
        return 'SELECT * FROM users WHERE email = "' . $email . '";';
    }

    function insert_bet()
    {
        return 'INSERT INTO bets (date, summ, user_id, lot_id) VALUES (NOW(), ?, ?, ?)';
    }

    function insert_lot()
    {
        return 'INSERT INTO lots
        (create_date, name, description, image_url, start_price, finish_date, bet_step, author_id, winner_id, category_id)
        VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?, NULL, ?)';
    }

    function insert_user()
    {
        return 'INSERT INTO users
        (reg_date, email, name, password, avatar_url, contact)
        VALUES (NOW(), ?, ?, ?, ?, ?)';
    }

    return [
        'get_categories' => 'get_categories',
        'get_id_category_by_name' => 'get_id_category_by_name',
        'get_actual_lots' => 'get_actual_lots',
        'search_lot' => 'search_lot',
        'get_lot' => 'get_lot',
        'get_bets' => 'get_bets',
        'get_bet_step' => 'get_bet_step',
        'get_user_by_email' => 'get_user_by_email',
        'insert_bet' => 'insert_bet',
        'insert_lot' => 'insert_lot',
        'insert_user' => 'insert_user',
    ];
})();
