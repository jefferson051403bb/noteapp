<?php
session_start(); 
include 'db_connectors.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $conn = connectDB();

    $sql = "SELECT u_id, name, password FROM users WHERE email = ?";

    try {
      
        $stmt = $conn->prepare($sql);
      
        $stmt->bindParam(1, $email);
      
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
         
            $hashed_password = $user['password']; 
            
            if (password_verify($password, $hashed_password)) {
            
                $_SESSION['user_id'] = $user['u_id']; 
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_photo'] = $user['photo']; 
                header("Location: ../dashboard.php?login=true"); 
                exit();
            } else {
                header("Location: ../form.php?login=false"); 
            }
        } else {
           
            echo "User not found";
        }

    } catch (PDOException $e) {
      
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
}
?>
