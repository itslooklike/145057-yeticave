<?php
require_once 'config/init.php';

$sql_connect = require_once 'config/sql_connect.php';
$queries = require_once 'config/queries.php';
$fmt = require 'config/getNumEnding.php';

$lot_id = intval($_GET['id']);
$lot_query = mysqli_query($sql_connect, $queries['get_lot']($lot_id));
$lot = mysqli_fetch_array($lot_query, MYSQLI_ASSOC);

if (!$lot) {
    http_response_code(404);
    header('Location: 404.php');
    exit();
}

// сбрасываем информацию о ставке, если перешли на другой лот
$from_page = $_SESSION['auth']['bet']['lot_id'] ?? false;
if ($from_page && ($from_page != $lot_id)) {
    unset($_SESSION['auth']['bet']);
}

$categories = mysqli_query($sql_connect, $queries['get_categories']());
$menu_list = mysqli_fetch_all($categories, MYSQLI_ASSOC);

$bets_query = mysqli_query($sql_connect, $queries['get_bets']($lot_id));
$bets = mysqli_fetch_all($bets_query, MYSQLI_ASSOC);

$time_left = strtotime($lot['finish_date']) - time();
$days_left = floor($time_left / 86400);

$timer = strftime('%T', $time_left);

if ($days_left) {
    $endings = ['день', 'дня', 'дней'];
    $timer = $days_left . ' ' . $fmt($days_left, $endings) . ' ' . $timer;
}

$page_content = include_template('lot.php', [
    'lot' => $lot,
    'bets' => $bets,
    'errors' => $_SESSION['auth']['bet']['errors'] ?? false,
    'answers' => $_SESSION['auth']['bet']['answers'] ?? false,
    'timer' => $timer,
]);

$layout_content = include_template('layout.php', [
    'page_content' => $page_content,
    'menu_list' => $menu_list,
    'title' => 'Главная',
]);

print($layout_content);
