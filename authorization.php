<?php
    require_once('connection.php');
    $connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (!$connection) {
        die('Błąd przy połączeniu z bazą danych: ' . mysqli_connect_error());
    }

    if (empty($_POST['login']) || empty($_POST['password'])) {
        header('Location: index.php?info=empty');
        mysqli_close($connection);
        die();
    }

    $login = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
    $password = htmlentities($_POST['password'], ENT_QUOTES, "UTF-8");

    $login = $_POST['login'];
    $password = $_POST['password'];

    $result = user_authorize($connection, $_POST['login'], $_POST['password']);
    if ($result != '-1') {
            if (!session_id()) {
                session_start();
            }

            $_SESSION['user_id']  = $result;
            $_SESSION['user_login'] = $login;

            header('Location: dashboard.php');
            mysqli_close($connection);
            die();
    } else {
        header('Location: index.php?info=wrong');
        mysqli_close($connection);
        die();
    }

    function user_authorize($connection, $login, $passwd) {
       mysqli_query($connection, users_table_create());

       $login = mysqli_real_escape_string($connection, $login);
       $passwd = mysqli_real_escape_string($connection, $passwd);

       $sql_query_salt = "SELECT salt FROM users WHERE login = '" . $login . "'";
       $salt_result = mysqli_query($connection, $sql_query_salt);
       if (mysqli_num_rows($salt_result) == 0) {
           return -1;
       }

       $sql_query_user = "SELECT * FROM users WHERE login = '" . $login . "'";
       $user_result = mysqli_query($connection, $sql_query_user);
       if (mysqli_num_rows($user_result) == 0) {
           return -1;
       }
       $fetched_user = $user_result->fetch_assoc();

       $salt = $salt_result->fetch_assoc();
       $entered_hash = hash('sha256', ($passwd . $salt['salt']));

       if ($entered_hash != $fetched_user['hash']) {
           return -1;
       }

       return $fetched_user['id'];
   }

   mysqli_close($connection);
?>
