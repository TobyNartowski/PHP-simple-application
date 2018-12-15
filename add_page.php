<?php
    require_once('connection.php');
    $connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (!$connection) {
        die('Błąd przy połączeniu z bazą danych: ' . mysqli_connect_error());
    }

    session_start();

    if (empty($_POST['name']) || empty($_POST['content'])) {
        mysqli_close($connection);
        header('Location: new_page.php?info=empty');
        die();
    }

    $name = htmlentities($_POST['name'], ENT_QUOTES, "UTF-8");
    $content = htmlentities($_POST['content'], ENT_QUOTES, "UTF-8");

    if (page_add($connection, $name, $content, $_SESSION['user_login'])) {
        mysqli_close($connection);
        header('Location: index.php?info=success');
        die();
    } else {
        mysqli_close($connection);
        header('Location: index.php?info=failure');
        die();
    }

    function page_add($connection, $name, $content, $author) {
        mysqli_query($connection, pages_table_create());

        $name = mysqli_real_escape_string($connection, $name);
        $content = mysqli_real_escape_string($connection, $content);

        $sql_insert = "INSERT INTO pages (name, content, author)
        VALUES ('" . $name . "', '" . $content . "', '" . $author . "')";

        if  (!mysqli_query($connection, $sql_insert)) {
            return false;
        }

        return true;
    }

    mysqli_close($connection);
?>
