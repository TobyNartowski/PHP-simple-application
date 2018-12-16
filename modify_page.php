<?php
    require_once('connection.php');
    $connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (!$connection) {
        die('Błąd przy połączeniu z bazą danych: ' . mysqli_connect_error());
    }

    if (empty($_POST['delete']) && empty($_POST['modify'])) {
        mysqli_close($connection);
        header('Location: index.php');
        die();
    }

    if (!empty($_POST['delete']) && $_POST['delete']) {
        echo $_POST['delete'];
        if (delete_page($connection, $_POST['delete'])) {
            mysqli_close($connection);
            header('Location: index.php?info=success');
            die();
        } else {
            mysqli_close($connection);
            header('Location: index.php?info=failure');
            die();
        }
    }

    if (!empty($_POST['modify']) && $_POST['modify']) {
        session_start();

        if (fetch_page_data($connection, $_POST['modify'])) {
            mysqli_close($connection);
            header('Location: edit_page.php?');
            die();
        } else {
            mysqli_close($connection);
            header('Location: index.php?info=failure');
            die();
        }
    }

    function delete_page($connection, $id) {
        $id = mysqli_real_escape_string($connection, $id);
        if(!mysqli_query($connection, 'DELETE FROM pages WHERE id = ' . $id)) {
            return false;
        }

        return true;
    }

    function fetch_page_data($connection, $id) {
        $sql = 'SELECT name, content, author FROM pages WHERE id = ' . $id;
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION['page_id'] = $id;
                $_SESSION['page_name'] = $row['name'];
                $_SESSION['page_content'] = $row['content'];
                $_SESSION['page_author'] = $row['author'];
            }
            return true;
        }

        return false;
    }

    mysqli_close($connection);
?>
