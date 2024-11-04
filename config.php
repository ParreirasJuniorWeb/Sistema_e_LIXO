<?php

    $dbHost = 'Localhost';
    $dbUsername = 'root';
    $dbName = '';

    $conexao = new mysqli(hostname: $dbHost, username: $dbUsername, password: $dbPassword, database: $dbName);
    $conexao->set_charset(charset: 'utf8mb4');
