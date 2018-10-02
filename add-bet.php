<?php
require_once 'config/init.php';
$sql_connect = require_once 'config/sql_connect.php';
$queries = require_once 'config/queries.php';

if (!isset($_SESSION['auth'])) {
    http_response_code(403);
    exit();
}

parse_str(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY), $lot);

$bet_sum = $_POST['cost'];
$user_id = $_SESSION['auth']['id'];
$lot_id = $lot['id'];

$errors = [];
$answers = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // список всех ставок
    $bets_query = mysqli_query($sql_connect, $queries['get_bets']($lot_id));
    $bets = mysqli_fetch_all($bets_query, MYSQLI_ASSOC);

    // минимальные размер ставки
    $bet_step_query = mysqli_query($sql_connect, $queries['get_bet_step']($lot_id));
    $bet_step = mysqli_fetch_array($bet_step_query, MYSQLI_ASSOC);

    $minimal_bet = null;

    if (isset($bets[0]['summ'])) {
        $minimal_bet = $bets[0]['summ'] + $bet_step['bet_step'];
    } else {
        // стартовая цена лота
        $lot_query = mysqli_query($sql_connect, $queries['get_lot']($lot_id));
        $lot_start_price = mysqli_fetch_array($lot_query, MYSQLI_ASSOC)['start_price'];

        $minimal_bet = $lot_start_price + $bet_step['bet_step'];
    }

    $answers = $_POST;
    $gump = new GUMP('ru');
    $gump->validation_rules([
        'cost' => 'required|integer',
    ]);
    $validated_data = $gump->run($_POST);

    if ($validated_data) {
        if ($validated_data['cost'] < $minimal_bet) {
            $errors['cost'] = 'Ставка меньше допустимой, минимальная ставка: ' . $minimal_bet;
        }
    } else {
        $errors = $gump->get_errors_array();
    }

    if (count($errors) === 0) {
        unset($_SESSION['auth']['bet']);

        $sql_query = $queries['insert_bet']();
        $sql_values = [mysqli_real_escape_string($sql_connect, $bet_sum), $user_id, $lot_id];
        $stmt = db_get_prepare_stmt($sql_connect, $sql_query, $sql_values);
        $res = mysqli_stmt_execute($stmt);

        if (!$res) {
            print('Не удалось добавить лот в базу');
            exit();
        }
    } else {
        $_SESSION['auth']['bet']['errors'] = $errors;
        $_SESSION['auth']['bet']['answers'] = $answers;
        $_SESSION['auth']['bet']['lot_id'] = $lot_id;
    }

    header('Location: lot.php?id=' . $lot_id);
    exit();
}
