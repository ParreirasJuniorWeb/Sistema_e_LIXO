<?php

    $dbHost = 'Localhost';
    $dbUsername = 'root';
    $dbName = 'e_lixo_system';

    $conexao = new mysqli(hostname: $dbHost, username: $dbUsername, password: $dbPassword, database: $dbName);
    $conexao->set_charset(charset: 'utf8mb4');
