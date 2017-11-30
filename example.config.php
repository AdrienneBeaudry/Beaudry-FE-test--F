<?php

$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "dbname";
$dsn = "mysql:host=$servername;dbname=$dbname";
$options = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false  ];
