<?php
require_once 'config/init.php';

if (!isset($_SESSION['auth'])) {
    http_response_code(403);
    exit();
}

$sql_connect = require_once 'config/sql_connect.php';
$queries = require_once 'config/queries.php';
$safe_img = require_once 'config/safe_img.php';

$categories = mysqli_query($sql_connect, $queries['get_categories']());
$menu_list = mysqli_fetch_all($categories, MYSQLI_ASSOC);

$errors = [];
$answers = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $answers = $_POST;
    $gump = new GUMP('ru');
    $file = [];

    $gump->validation_rules([
        'lot-name' => 'required',
        'lot-category' => 'required',
        'lot-message' => 'required',
        'lot-rate' => 'required|integer',
        'lot-step' => 'required|integer',
        'lot-date' => 'required|date',
    ]);

    $validated_data = $gump->run($_POST);

    if (!$validated_data) {
        $errors = $gump->get_errors_array();
    }

    if ($_FILES['lot-file']['name']) {
        $img_url = $safe_img($_FILES['lot-file']);

        if ($img_url) {
            $file['img_url'] = $img_url;
        } else {
            $errors['lot-file'] = 'Загрузите картинку в формате jpg или png';
        }
    } else {
        $errors['lot-file'] = 'Вы не загрузили файл';
    }

    if (count($errors) === 0) {
        $cat_id_query = mysqli_query($sql_connect, $queries['get_id_category_by_name']($_POST['lot-category']));
        $cat_id = mysqli_fetch_assoc($cat_id_query)['id'];

        $sql_query = $queries['insert_lot']();

        $sql_values = [
            mysqli_real_escape_string($sql_connect, $_POST['lot-name']),
            mysqli_real_escape_string($sql_connect, $_POST['lot-message']),
            $file['img_url'],
            $_POST['lot-rate'],
            $_POST['lot-date'],
            $_POST['lot-step'],
            1,
            $cat_id,
        ];

        $stmt = db_get_prepare_stmt(
            $sql_connect,
            $sql_query,
            $sql_values
        );

        $res = mysqli_stmt_execute($stmt);

        if ($res) {
            $lot_id = mysqli_insert_id($sql_connect);
            header('Location: lot.php?id=' . $lot_id);
            exit();
        } else {
            print('Не удалось добавить лот в базу');
            exit();
        }
    }
}

$page_content = include_template('add-lot.php', [
    'errors' => $errors,
    'answers' => $answers,
    'menu_list' => $menu_list,
]);

$layout_content = include_template('layout.php', [
    'page_content' => $page_content,
    'menu_list' => $menu_list,
    'title' => 'Главная',
]);

print($layout_content);
