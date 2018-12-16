<?php
    require_once('connection.php');
    check_ip();

    $connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (!$connection) {
        die('Błąd przy połączeniu z bazą danych: ' . mysqli_connect_error());
    }

    if (empty($_POST['login']) || empty($_POST['password']) || empty($_POST['repeat'])) {
        mysqli_close($connection);
        header('Location: register.php?error=empty');
        die();
    }

    if ($_POST['password'] != $_POST['repeat']) {
        mysqli_close($connection);
        header('Location: register.php?error=different');
        die();
    }

    $login = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
    $password = htmlentities($_POST['password'], ENT_QUOTES, "UTF-8");

    if (database_user_create($connection, $login, $password)) {
        mysqli_close($connection);
        header('Location: login.php?info=success');
        die();
    } else {
        mysqli_close($connection);
        header('Location: register.php?error=wrong');
        die();
    }

    function database_user_create($connection, $login, $passwd) {
       mysqli_query($connection, users_table_create());

       $login = mysqli_real_escape_string($connection, $login);
       $passwd = mysqli_real_escape_string($connection, $passwd);

       $sql_query = "SELECT id FROM users WHERE login = '" . $login . "'";
       $result_count = mysqli_query($connection, $sql_query);
       if (mysqli_num_rows($result_count) != 0) {
           return false;
       }

       $salt = hash('sha256', uniqid(mt_rand(), true));
       $hashed_passwd = hash('sha256', ($passwd . $salt));

       $sql_insert = "INSERT INTO users (login, hash, salt)
       VALUES ('" . $login . "', '" . $hashed_passwd . "', '" . $salt . "')";

       if  (!mysqli_query($connection, $sql_insert)) {
           return false;
       }

       return true;
   }

   mysqli_close($connection);
?>
