<?php

$servername = "localhost";
$username   = 'mufid';
$password   = 'developer42';
$db         = 'my_database';

$conn = new mysqli($servername, $username, $password, $db);

if ($conn -> connect_error)
{
    die("Connection failed: " . $conn -> connect_error);
}
