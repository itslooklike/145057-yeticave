<?php
$calc_lot_time = require 'config/calc_lot_time.php';

$endings = ['день', 'дня', 'дней'];
$time_left = strtotime($finish_date) - time();
$days_left = floor($time_left / 86400);

$page_content = include_template('_item-list.php', [
    'image_url' => $image_url,
    'category' => $category,
    'id' => $id,
    'title' => $title,
    'start_price' => $start_price,
    'timer' => $calc_lot_time($finish_date),
]);

print($page_content);
