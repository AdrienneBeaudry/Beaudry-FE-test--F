<?php

require 'functions.php';
require 'config.php';

$individuals = fetchIndividuals($dsn, $username, $password, $options);

$individuals = json_encode($individuals);

//echo $individuals;

print_r($individuals);