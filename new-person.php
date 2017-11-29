<?php

//require 'functions.php';
require 'config.php';

$full_name = $_POST['full_name'];
$company = $_POST['company'];

try {
    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false];

    $pdo = new PDO($dsn, $username, $password, $options);

    $addPersonSQL = "INSERT INTO individuals(full_name) VALUE (:full_name)";
    $addCompanySQL = "INSERT INTO companies(name) VALUE (:name)";


    if ($full_name !== null) {

    }
    $stmt = $pdo->prepare($addPersonSQL);
    $stmt->execute([':full_name' => $full_name]);
    echo "Name added successfully. ";

    $stmt = $pdo->prepare($addCompanySQL);
    $stmt->execute([':name' => $company]);
    echo "Company added successfully.";


} catch (PDOException $e) {
    echo $addPersonSQL . "<br>" . $e->getMessage();
    echo $sqlAddress . "<br>" . $e->getMessage();
}

$conn = null;
