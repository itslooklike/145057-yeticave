<?php
require_once 'config/init.php';

$sql_connect = require_once 'config/sql_connect.php';
$queries = require_once 'config/queries.php';
$safe_img = require_once 'config/safe_img.php';

$categories = mysqli_query($sql_connect, $queries['get_categories']());
$menu_list = mysqli_fetch_all($categories, MYSQLI_ASSOC);

$errors = [];
$answers = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // запоминает ответы пользователя
    foreach ($_POST as $name => $answer) {
        $answers[$name] = $answer;
    }
    $lot = null;

    $gump = new GUMP('ru');

    $gump->validation_rules([
        'email' => 'required|valid_email',
        'password' => 'required|max_len,100|min_len,3',
        'name' => 'required|max_len,100',
        'message' => 'required|max_len,100',
    ]);

    $gump->filter_rules([
        'email' => 'trim|sanitize_email',
        'password' => 'trim',
        'name' => 'trim|sanitize_string',
        'message' => 'trim|noise_words',
    ]);

    $validated_data = $gump->run($_POST);

    if ($validated_data) {
        $user_q = mysqli_query($sql_connect, $queries['get_user_by_email']($validated_data['email']));
        $user = mysqli_fetch_assoc($user_q);

        if ($user && count($user) > 0) {
            $errors['email'] = 'Email уже зарегистрирован';
        }
    } else {
        $errors = $gump->get_errors_array();
    }

    if ($_FILES['avatar']['name']) {
        $file = $_FILES['avatar'];
        $img_url = $safe_img($file);

        if ($img_url) {
            $lot['$img_url'] = $img_url;
        } else {
            $errors['avatar'] = 'Загрузите картинку в формате jpg или png';
        }
    }

    if (count($errors) === 0) {
        $sql_query = $queries['insert_user']();

        $sql_values = [
            mysqli_real_escape_string($sql_connect, $_POST['email']),
            mysqli_real_escape_string($sql_connect, $_POST['name']),
            password_hash($_POST['password'], PASSWORD_DEFAULT),
            $lot['$img_url'] ?? 'img/user-avatar-placeholder.svg',
            mysqli_real_escape_string($sql_connect, $_POST['message']),
        ];

        $stmt = db_get_prepare_stmt(
            $sql_connect,
            $sql_query,
            $sql_values
        );

        $res = mysqli_stmt_execute($stmt);

        if ($res) {
            header('Location: login.php');
            exit();
        } else {
            print('Не удалось добавить пользователя в базу');
            exit();
        }
    }
}

$page_content = include_template('registration.php', [
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
