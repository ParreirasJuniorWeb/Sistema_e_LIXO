<?php

    $dbHost = 'Localhost';
    $dbUsername = 'root';
    $dbPassword = '886744@Jo';
    $dbName = 'e_lixo_system';

    $conexao = new mysqli(hostname: $dbHost, username: $dbUsername, password: $dbPassword, database: $dbName);
    $conexao->set_charset(charset: 'utf8mb4');