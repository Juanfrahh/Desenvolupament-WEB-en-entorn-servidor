<?php
require_once __DIR__ . '/config.php';
setcookie('remember_user', '', time() - 3600, "/");
session_unset();
session_destroy();
header('Location: login.php');
exit;
