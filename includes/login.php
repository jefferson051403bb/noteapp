<?php
session_start(); 
include 'db_connectors.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize the email
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Connect to the database
    $conn = connectDB();

    // SQL query to select user information based on the provided email
    $sql = "SELECT u_id, name, password, photo FROM users WHERE email = ?";

    try {
        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);
        
        // Bind the email parameter (use 's' to indicate string)
        $stmt->bind_param("s", $email);
        
        // Execute the statement
        $stmt->execute();
        
        // Get the result
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // Check if the user exists
        if ($user) {
            $hashed_password = $user['password']; // Get the hashed password from the database
            
            // Verify the provided password against the hashed password
            if (password_verify($password, $hashed_password)) {
                // Set session variables
                $_SESSION['user_id'] = $user['u_id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_photo'] = $user['photo'];
                
                // Redirect to the dashboard on successful login
                header("Location: ../dashboard.php?login=true"); 
                exit();
            } else {
                // If password verification fails, redirect to login form with failure message
                header("Location: ../form.php?login=false"); 
                exit();
            }
        } else {
            // If no user is found, display an error message
            echo "User not found";
        }

    } catch (mysqli_sql_exception $e) {
        // Handle any SQL errors
        echo "Error: " . $e->getMessage();
    }

    // Close the connection
    $stmt->close();
    $conn->close();
}
?>
