<?php
session_start();
session_destroy();
setcookie('usuario_recordado', '', time() - 3600, '/');
header('Location: login.php');
exit();
?>
