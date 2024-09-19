<?php
session_start(); 
include 'db_connectors.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize email input
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Connect to the database using PDO
    $conn = connectDB();

    // SQL query to select the user based on email
    $sql = "SELECT u_id, name, password, photo FROM users WHERE email = ?";

    try {
        // Prepare the statement using PDO
        $stmt = $conn->prepare($sql);
        
        // Bind the email parameter
        $stmt->bindParam(1, $email);
        
        // Execute the query
        $stmt->execute();
        
        // Fetch the result as an associative array
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user exists
        if ($user) {
            // Get the hashed password from the database
            $hashed_password = $user['password'];
            
            // Verify the password
            if (password_verify($password, $hashed_password)) {
                
                // Store user data in session variables
                $_SESSION['user_id'] = $user['u_id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_photo'] = $user['photo']; // Assuming photo is stored in the database
                
                // Redirect to dashboard after successful login
                header("Location: ../dashboard.php?login=true");
                exit();
            } else {
                // Redirect to login form if password verification fails
                header("Location: ../form.php?login=false");
                exit();
            }
        } else {
            // If user not found, return an error
            echo "User not found";
        }

    } catch (PDOException $e) {
        // Handle errors with PDO
        echo "Error: " . $e->getMessage();
    }

    // Close the connection
    $conn = null;
}
?>

