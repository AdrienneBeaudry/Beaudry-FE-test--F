<?php

require 'functions.php';
require 'config.php';

$companies = fetchCompanies($dsn, $username, $password, $options);

$companies = json_encode($companies);

echo $companies;