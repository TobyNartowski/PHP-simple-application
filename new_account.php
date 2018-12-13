<?php
    if (empty($_POST['login']) || empty($_POST['password']) || empty($_POST['repeat'])) {
        header('Location: register.php?error=empty');
        die();
    }

    if ($_POST['password'] != $_POST['repeat']) {
        header('Location: register.php?error=different');
        die();
    }
?>
