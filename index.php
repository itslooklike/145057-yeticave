<?php
require_once 'config/init.php';
$sql_connect = require_once 'config/sql_connect.php';
$queries = require_once 'config/queries.php';

$menu_list_q = mysqli_query($sql_connect, $queries['get_categories']());
$menu_list = mysqli_fetch_all($menu_list_q, MYSQLI_ASSOC);

$search_query = null;

if (isset($_GET['q'])) {
    $search_query = mysqli_real_escape_string($sql_connect, $_GET['q']);
}

$lots_list_q = mysqli_query($sql_connect, $queries['get_actual_lots']($search_query));
$lots_list = mysqli_fetch_all($lots_list_q, MYSQLI_ASSOC);

$page_content = include_template('index.php', [
    'menu_list' => $menu_list,
    'lots_list' => $lots_list,
]);

$layout_content = include_template('layout.php', [
    'page_content' => $page_content,
    'menu_list' => $menu_list,
    'title' => 'Главная',
]);

print($layout_content);
