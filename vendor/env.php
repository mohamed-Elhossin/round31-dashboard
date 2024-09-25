<?php

$host =  "localhost";
$user = "root";
$password = "";
$dbName = "round31";

try {
    $connect = mysqli_connect($host, $user, $password, $dbName);
} catch (Exception $e) {
    echo $e->getMessage();
}
