<?php
require_once 'config/init.php';

$sql_connect = require_once 'config/sql_connect.php';
$queries = require_once 'config/queries.php';
$safe_img = require_once 'config/safe_img.php';

$categories = mysqli_query($sql_connect, $queries['get_categories']());
$menu_list = mysqli_fetch_all($categories, MYSQLI_ASSOC);

$errors = [];
$answers = [];
$user = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $answers = $_POST;
    $gump = new GUMP('ru');

    $gump->validation_rules([
        'email' => 'required|valid_email',
        'password' => 'required|max_len,100',
    ]);

    $validated_data = $gump->run($_POST);

    if ($validated_data) {
        $user_q = mysqli_query($sql_connect, $queries['get_user_by_email']($validated_data['email']));
        $user = mysqli_fetch_assoc($user_q);
        $isUserExist = $user && count($user) > 0;

        if ($isUserExist) {
            $isPasswordCorrect = password_verify($validated_data['password'], $user['password']);

            if (!$isPasswordCorrect) {
                $errors['password'] = 'Пароль введен неверный';
            }
        } else {
            $errors['email'] = 'Email введен неверный';
        }
    } else {
        $errors = $gump->get_errors_array();
    }

    if (count($errors) === 0) {
        $_SESSION['auth'] = [
            'name' => $user['name'],
            'avatar_url' => $user['avatar_url'],
            'id' => $user['id'],
        ];
        header('Location: index.php');
        exit();
    }
}

$page_content = include_template('login.php', [
    'menu_list' => $menu_list,
    'answers' => $answers,
    'errors' => $errors,
]);

$layout_content = include_template('layout.php', [
    'page_content' => $page_content,
    'menu_list' => $menu_list,
    'title' => 'Главная',
]);

print($layout_content);
