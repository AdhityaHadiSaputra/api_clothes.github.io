<?php
$hostname = "1yg.h.filess.io";
$database = "clothesapp_usepoetry";
$port = 3307;
$username = "clothesapp_usepoetry";
$password = "f52ce8802e046628041c13e04e6b2adf4c714e3d";

// Create connection
$connectNow = new mysqli($hostname, $username, $password, $database, $port);

// Check connection
if ($connectNow->connect_error) {
    die("Connection failed: " . $connectNow->connect_error);
}

// Set charset to UTF-8 (optional)
$connectNow->set_charset("utf8");

?>
