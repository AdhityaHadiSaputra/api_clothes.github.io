<?php
$hostname = "1yg.h.filess.io";
$database = "clothesapp_usepoetry";
$port = 3307;
$username = "clothesapp_usepoetry";
$password = "f52ce8802e046628041c13e04e6b2adf4c714e3d";

// Create connection
$conn = new mysqli($hostname, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully\n";

// Execute query
$query = "SELECT 1+1 AS result";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Result: " . $row['result'] . "\n";
    }
} else {
    echo "No results found\n";
}

// Close connection
$conn->close();
?>
