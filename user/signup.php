<?php
include '../connection.php'; // Ensure the path to connection.php is correct

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['user_name']) && !empty($_POST['user_email']) && !empty($_POST['user_password'])) {
        $userName = $_POST['user_name'];
        $userEmail = $_POST['user_email'];
        $userPassword = MD5($_POST['user_password']);

        // Check if $connectNow is defined
        if (!isset($connectNow)) {
            die("Database connection failed. Please check the connection file.");
        }

        $stmt = $connectNow->prepare("INSERT INTO users_table (user_name, user_email, user_password) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sss", $userName, $userEmail, $userPassword);
            $resultOfQuery = $stmt->execute();

            if ($resultOfQuery) {
                echo json_encode(array("Success" => true));
            } else {
                echo json_encode(array("Success" => false));
            }

            $stmt->close();
        } else {
            echo json_encode(array("Success" => false, "Message" => "Failed to prepare the SQL statement."));
        }
    } else {
        echo json_encode(array("Success" => false, "Message" => "All fields are required."));
    }
} else {
    echo json_encode(array("Success" => false, "Message" => "Invalid request method."));
}
?>
