<?php
require_once 'config/init.php';
$sql_connect = require_once 'config/sql_connect.php';
$queries = require_once 'config/queries.php';

$categories = mysqli_query($sql_connect, $queries['get_categories']());
$menu_list = mysqli_fetch_all($categories, MYSQLI_ASSOC);
$page_content = include_template('404.php');

$layout_content = include_template('layout.php', [
    'page_content' => $page_content,
    'menu_list' => $menu_list,
    'title' => 'Главная',
]);

print($layout_content);
