<?php
    require_once('connection.php');

    $connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (!$connection) {
        die('Błąd przy połączeniu z bazą danych: ' . mysqli_connect_error());
    }

    if (empty($_POST['login']) || empty($_POST['password'])) {
        header('Location: index.php?error=empty');
        mysqli_close($connection);
        die();
    }

    if (user_authorize($connection, $_POST['login'], $_POST['password']) != '-1') {
        // login here
        echo 'Logged';
    } else {
        echo 'Nope';
    }

    function user_table_create() {
          return "CREATE TABLE IF NOT EXISTS users (
              id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              login VARCHAR(128) UNIQUE NOT NULL,
              hash VARCHAR(64) NOT NULL,
              salt VARCHAR(64) NOT NULL
          )";
      }

    function user_authorize($connection, $login, $passwd) {
       mysqli_query($connection, user_table_create());

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
       $entered_hash = hash('sha256', ($passwd . $salt["salt"]));

       if ($entered_hash != $fetched_user['hash']) {
           return -1;
       }

       return $fetched_user["id"];
   }

   mysqli_close($connection);
?>
