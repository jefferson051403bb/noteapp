<?php
include 'db_connectors.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $photo = $_FILES['photo']['tmp_name']; // Assuming the file input field is named 'photo'

    $name = htmlspecialchars($name);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Check if a file is uploaded
    if (!empty($photo)) {
        // Read the file content
        $photoContent = file_get_contents($photo);
    }

    $conn = connectDB();

    $sql = "INSERT INTO users (name, email, password, photo) VALUES (?, ?, ?, ?)";
    
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $password);
        $stmt->bindParam(4, $photoContent, PDO::PARAM_LOB); // Use PDO::PARAM_LOB for handling large objects

        $stmt->execute();

        $conn = null;
        header("Location: ../signin.php?action=register_success");
        exit(); 
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
