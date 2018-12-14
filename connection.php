<?php
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'test';

    function users_table_create() {
          return "CREATE TABLE IF NOT EXISTS users (
              id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              login VARCHAR(128) UNIQUE NOT NULL,
              hash VARCHAR(64) NOT NULL,
              salt VARCHAR(64) NOT NULL
          )";
      }
?>
