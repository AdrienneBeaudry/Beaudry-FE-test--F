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

        $companies = $stmt->fetchAll();

        return $companies;

    } catch (PDOException $e) {
        echo $fetchCompaniesSQL . "<br>" . $e->getMessage();
    }

    $conn = null;
}


function fetchEmployees($dsn, $username, $password, $options) {

    $id = $_POST['selected-company'];
    $employees = null;

    try {
        $pdo = new PDO($dsn, $username, $password, $options);

        $fetchEmployeesSQL = "SELECT * FROM individuals WHERE company_id = $id";

        $stmt = $pdo->prepare($fetchEmployeesSQL);

        $stmt->execute();

        $employees = $stmt->fetchAll();

        return $employees;


    } catch (PDOException $e) {
        echo $fetchEmployeesSQL . "<br>" . $e->getMessage();
    }

    $conn = null;
}

function fetchIndividuals($dsn, $username, $password, $options) {
    try {
        $pdo = new PDO($dsn, $username, $password, $options);

        $individualsSQL = "SELECT * FROM individuals WHERE company_id IS NULL OR company_id = ''";

        $stmt = $pdo->prepare($individualsSQL);

        $stmt->execute();

        $individuals = $stmt->fetchAll();

        return $individuals;

    } catch (PDOException $e) {
        echo $individualsSQL . "<br>" . $e->getMessage();
    }

    $conn = null;
}

function deleteEmployee($dsn, $username, $password, $options) {
    $name = $_POST['full_name'];

    try {
        $pdo = new PDO($dsn, $username, $password, $options);

        $employeeSQL = "UPDATE individuals SET company_id=NULL WHERE full_name=$name";

        $stmt = $pdo->prepare($employeeSQL);

        $success = $stmt->execute();

        return $success;

    } catch (PDOException $e) {
        echo $employeeSQL . "<br>" . $e->getMessage();
    }

    $conn = null;
}

function assignCompany($dsn, $username, $password, $options) {
    $person_id = $_POST['select-individual'];
    $company_id = $_POST['select-company'];

    try {
        $pdo = new PDO($dsn, $username, $password, $options);

        $assignCompSQL = "UPDATE individuals SET company_id= :company_id WHERE id= :person_id";

        $stmt = $pdo->prepare($assignCompSQL);

        $success = $stmt->execute([':company_id' => $company_id, ':person_id' => $person_id]);

        return $success;

    } catch (PDOException $e) {
        echo $assignCompSQL . "<br>" . $e->getMessage();
    }

    $conn = null;
}
