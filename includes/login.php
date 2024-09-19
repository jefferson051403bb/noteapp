<?php
session_start(); 
include 'db_connectors.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize email input
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Connect to the database using mysqli
    $conn = connectDB();

    // Prepare the SQL query
    $sql = "SELECT u_id, name, password FROM users WHERE email = ?";

    try {
        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {

            // Bind the parameters (s means string)
            $stmt->bind_param("s", $email);

            // Execute the query
            $stmt->execute();

            // Bind result variables
            $stmt->bind_result($u_id, $name, $hashed_password);

            // Fetch the results
            if ($stmt->fetch()) {

                // Verify the password
                if (password_verify($password, $hashed_password)) {

                    // Store user info in the session
                    $_SESSION['user_id'] = $u_id;
                    $_SESSION['user_name'] = $name;

                    // Redirect to dashboard on success
                    header("Location: ../dashboard.php?login=true");
                    exit();
                } else {
                    // Incorrect password
                    header("Location: ../form.php?login=false");
                    exit();
                }
            } else {
                // User not found
                echo "User not found";
            }

            // Close the statement
            $stmt->close();
        }
    } catch (mysqli_sql_exception $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the connection
    $conn->close();
}
?>
