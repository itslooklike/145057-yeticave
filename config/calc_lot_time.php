<?php

return function ($finish_date) {
    $get_num_ending = require 'get_num_ending.php';
    $endings = ['день', 'дня', 'дней'];

    $time_left = strtotime($finish_date) - time();
    $days_left = floor($time_left / 86400);

    $timer = strftime('%T', $time_left);

    if ($days_left) {
        $timer = $days_left . ' ' . $get_num_ending($days_left, $endings) . ' ' . $timer;
    }

    return $timer;
};
