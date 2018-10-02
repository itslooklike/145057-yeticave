<?php

return function ($file) {
    $TYPES = ['image/jpeg', 'image/png'];

    $tmp_name = $file['tmp_name'];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $file_type = finfo_file($finfo, $tmp_name);
    $is_mime_allow = in_array($file_type, $TYPES);

    if (!$is_mime_allow) {
        return false;
    }

    $uploads_path = realpath(__DIR__ . '/..') . '/uploads/';

    $file_ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $new_file_name = uniqid() . '.' . $file_ext;
    $img_url = 'uploads/' . $new_file_name;

    $is_dir_exist = is_dir($uploads_path);

    if (!$is_dir_exist) {
        mkdir($uploads_path, 0777, true);
    }

    move_uploaded_file($tmp_name, $uploads_path . $new_file_name);

    return $img_url;
};
