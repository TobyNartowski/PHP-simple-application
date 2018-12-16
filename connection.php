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

    function pages_table_create() {
        return "CREATE TABLE IF NOT EXISTS pages (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(128) NOT NULL,
            content VARCHAR(65536) NOT NULL,
            author VARCHAR(128) NOT NULL,
            creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
    }
?>
