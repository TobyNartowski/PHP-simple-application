<?php
    require_once('connection.php');
    check_ip();
    session_start();

    $_SESSION = array();
    session_destroy();

    header('Location: index.php');
    die();
?>
