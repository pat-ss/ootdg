<?php

    $servidor = "localhost";
    $username = "root";
    $password = "";
    $bdname = "outfitGenerator2";

    $conn = new mysqli($servidor, $username, $password, $bdname);
    global $conn;

    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

?>