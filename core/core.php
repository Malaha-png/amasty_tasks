<?php

$action = $_POST['action'];

require_once './fun.php';

switch ($action) {
    case 'banknoteRand':
        banknoteRand();
        break;
    case 'banknoteGet':
        banknoteGet();
        break;

    default:

        break;
}
