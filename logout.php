<?php
require_once 'config/init.php';

unset($_SESSION['auth']);
header('Location: index.php');
exit();
