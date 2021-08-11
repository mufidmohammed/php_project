<?php

require_once "./App.php";
require_once "../db_connect/connect.php";

$id = $_POST['id'];

$sql = "DELETE FROM `transactions` WHERE id = '$id' ";

$query = $conn -> query($sql);

if (! $query) {
    echo "Error executing command: " . $conn -> error;
}

$location = '../public/index.php';

header ("location: $location");
