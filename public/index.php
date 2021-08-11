<?php

declare(strict_types = 1);

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);
define('DB_PATH', $root . 'db_connect' . DIRECTORY_SEPARATOR);

require DB_PATH . 'connect.php';
require APP_PATH . 'App.php';

$transactions = getTransactions($conn);

$totals = calculateTotals($transactions);

require VIEWS_PATH . 'transactions.php';

$conn -> close();