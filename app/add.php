<?php

require_once "./App.php";
require_once "../db_connect/connect.php";

$name = validate($_POST['product_name']);
$price = validate($_POST['price']);

$sql = "INSERT INTO `transactions` (`product_name`, `price`) VALUES ('$name', '$price')";

$query = $conn->query($sql);

if (! $query) {
    echo "Error adding to database: " . $conn->error;
}

$location = '../public/index.php';

header("location: {$location}");
