<?php

return (function () {
    $db = [
        'host' => 'localhost',
        'user' => 'root',
        'password' => '',
        'database' => 'yeticave',
    ];

    $sql_connect = mysqli_connect(
        $db['host'],
        $db['user'],
        $db['password'],
        $db['database']
    );

    if ($sql_connect == false) {
        print('Ошибка подключения: ' . mysqli_connect_error());
        exit();
    }

    mysqli_set_charset($sql_connect, 'utf8');

    return $sql_connect;
})();
