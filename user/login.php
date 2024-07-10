<?php
include '../connection.php';

// Check if the form data is received
if (isset($_POST['user_email']) && isset($_POST['user_password'])) {
    $userEmail = $_POST['user_email'];
    $userPassword = MD5($_POST['user_password']);

    // Debugging: Print the received email and password (hashed)
    error_log("Email: $userEmail");
    error_log("Password: $userPassword");

    $sqlQuery = "SELECT * FROM users_table WHERE user_email='$userEmail' AND user_password='$userPassword'";

    // Debugging: Print the SQL query
    error_log("SQL Query: $sqlQuery");

    $resultOfQuery = $connectNow->query($sqlQuery);

    // Check if the query executed successfully
    if ($resultOfQuery === false) {
        error_log("SQL Error: " . $connectNow->error);
        echo json_encode(array("Success" => false, "message" => "Database query failed"));
        exit();
    }

    if ($resultOfQuery->num_rows > 0) {
        $userRecord = array();
        while ($rowFound = $resultOfQuery->fetch_assoc()) {
            $userRecord[] = $rowFound;
        }

        echo json_encode(
            array(
                "Success" => true, 
                "userData" => $userRecord[0]
            )
        );
    } else {
        // Debugging: No matching user found
        error_log("No matching user found for email: $userEmail and password: $userPassword");
        echo json_encode(array("Success" => false, "message" => "Invalid email or password"));
    }
} else {
    // Debugging: Missing form fields
    error_log("Required fields are missing");
    echo json_encode(array("Success" => false, "message" => "Required fields are missing"));
}
?>
