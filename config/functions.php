<?php

function sum_format($sum)
{
    $trimmed = ceil($sum);
    $formatted = number_format($trimmed, null, null, ' ');

    return strval($formatted) . ' ₽';
}

function include_template($path, $data = [])
{
    $template_path = realpath('templates/' . $path);

    if (!file_exists($template_path)) {
        return '';
    }

    ob_start();
    extract($data);
    require $template_path;
    $contents = ob_get_contents();
    ob_end_clean();

    return $contents;
}

function today_end_time()
{
    $ts_midnight = strtotime('tomorrow');
    $secs_to_midnight = $ts_midnight - time();

    $result = [
        'hours' => floor($secs_to_midnight / 3600),
        'minutes' => floor(($secs_to_midnight % 3600) / 60),
        'seconds' => floor(($secs_to_midnight % 3600) % 60),
    ];

    return strtotime($result['hours'] . ':' . $result['minutes'] . ':' . $result['seconds']);
}
