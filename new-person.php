<?php

require 'functions.php';
require 'config.php';

addNewPerson($dsn, $username, $password, $options);

if ($nameAdded = true) {
    header('Location: /company.html');
}
else {
    header('Location: /index.html');
    echo "Name could not be registered. Please try again.";
}
