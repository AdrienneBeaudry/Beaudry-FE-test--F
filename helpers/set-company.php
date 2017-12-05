<?php

require 'functions.php';
require 'config.php';

assignCompany($dsn, $username, $password, $options);

if ($success = true) {
    echo "Request successful.";
}
else {
    echo "Error. Please try again.";
}
