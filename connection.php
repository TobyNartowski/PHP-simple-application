<?php
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'test';


    function check_ip() {
        $deny = array("192.168.1.12", "192.168.1.13", "192.168.1.14");

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
          $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
          $ip = $_SERVER['REMOTE_ADDR'];
        }

        if (in_array($ip, $deny)) {
            header('Location: forbidden.php');
            die();
        }
    }

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
