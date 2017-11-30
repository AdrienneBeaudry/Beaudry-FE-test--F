<?php

require 'config.php';

function addNewPerson($dsn, $username, $password, $options) {
    $full_name = $_POST['full_name'];
    $nameAdded=null;

    try {
        $pdo = new PDO($dsn, $username, $password, $options);

        $addPersonSQL = "INSERT INTO individuals(full_name) VALUE (:full_name)";

        if ($full_name !== null) {
            $stmt = $pdo->prepare($addPersonSQL);
            $stmt->execute([':full_name' => $full_name]);
            //echo "Name added successfully.";
            $nameAdded = true;
            return $nameAdded;
        }
    } catch (PDOException $e) {
        echo $addPersonSQL . "<br>" . $e->getMessage();
    }

    $conn = null;
}

function addNewCompany($dsn, $username, $password, $options) {
    $company = $_POST['company'];

    try {
        $pdo = new PDO($dsn, $username, $password, $options);

        $addCompanySQL = "INSERT INTO companies(name) VALUE (:name)";

        if ($company !== null) {
            $stmt = $pdo->prepare($addCompanySQL);
            $stmt->execute([':name' => $company]);
            echo "Company added successfully.";
        }

    } catch (PDOException $e) {
        echo $addCompanySQL . "<br>" . $e->getMessage();
    }

    $conn = null;
}

function fetchCompanies($dsn, $username, $password, $options) {
    try {
        $pdo = new PDO($dsn, $username, $password, $options);

        $fetchCompaniesSQL = "SELECT * FROM companies";

        $stmt = $pdo->prepare($fetchCompaniesSQL);

        $stmt->execute();

    } catch (PDOException $e) {
        echo $fetchCompaniesSQL . "<br>" . $e->getMessage();
    }

    $conn = null;

}



