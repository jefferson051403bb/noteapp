<?php
include 'db_connectors.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $photo = $_FILES['photo']['tmp_name']; // Assuming the file input field is named 'photo'

    // Sanitize inputs
    $name = htmlspecialchars($name);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Check if a file is uploaded
    if (!empty($photo)) {
        // Read the file content
        $photoContent = file_get_contents($photo);
    }

    $conn = connectDB(); // Connect to the database

    $sql = "INSERT INTO users (name, email, password, photo) VALUES (?, ?, ?, ?)";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    // Bind parameters to the statement (use 's' for string, 'b' for blob)
    $stmt->bind_param("ssss", $name, $email, $password, $photoContent); // 'ssss' means four strings

    // Execute the statement
    if ($stmt->execute()) {
        // Success: Redirect to the signin page
        header("Location: ../signin.php?action=register_success");
        exit();
    } else {
        // Error occurred
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
