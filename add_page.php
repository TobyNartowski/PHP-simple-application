<?php
    require_once('connection.php');
    check_ip();
    session_start();

    if (!isset($_SESSION['user_login'])) {
        header("Location: index.php");
        die();
    }

    $connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (!$connection) {
        die('Błąd przy połączeniu z bazą danych: ' . mysqli_connect_error());
    }

    if (empty($_POST['name']) || empty($_POST['content'])) {
        mysqli_close($connection);
        if ($_GET['modify'] == 'false') {
            header('Location: new_page.php?info=empty');
        } else {
            header('Location: edit_page.php?info=empty');
        }
        die();
    }

    $link = 0;
    if (filter_var($_POST['content'], FILTER_VALIDATE_URL)) {
        $link = 1;
    }

    $name = $_POST['name'];
    $content = $_POST['content'];

    $error = true;
    if ($_GET['modify'] == 'false') {
        $error = page_add($connection, $name, $content, $link, $_SESSION['user_login']);
    } else {
        $error = page_update($connection, $name, $content, $link);
    }

    mysqli_close($connection);

    if ($error) {
        header('Location: index.php?info=success');
        die();
    } else {
        header('Location: index.php?info=failure');
        die();
    }

    function page_add($connection, $name, $content, $link, $author) {
        mysqli_query($connection, pages_table_create());

        $name = mysqli_real_escape_string($connection, $name);
        $content = mysqli_real_escape_string($connection, $content);

        $sql_insert = "INSERT INTO pages (name, content, is_link, author)
        VALUES ('" . $name . "', '" . $content . "', " . $link . ", '" . $author . "')";

        if  (!mysqli_query($connection, $sql_insert)) {
            return false;
        }

        return true;
    }

    function page_update($connection, $name, $content, $link) {
        $sql = "UPDATE pages SET name = '" . $name . "', content = '" . $content . "', is_link = '" . $link . "', creation = now() WHERE id = " . $_SESSION['page_id'];
        unset_session();

        if (mysqli_query($connection, $sql)) {
            return true;
        }

        return false;
    }

    function unset_session() {
        unset($_SESSION['page_id']);
        unset($_SESSION['page_name']);
        unset($_SESSION['page_content']);
        unset($_SESSION['page_author']);
    }
?>
