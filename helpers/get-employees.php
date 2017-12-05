<?php

require 'config.php';
require 'functions.php';

$options = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false  ];

$employees = fetchEmployees($dsn, $username, $password, $options);

$employees = json_encode($employees);

echo $employees;
