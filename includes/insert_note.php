<?php
session_start();


include_once 'db_connectors.php';


if (!isset($_SESSION['user_id'])) {
    echo "User is not logged in";
    exit(); 
}


$title = $_POST['noteTitle'];
$content = $_POST['noteContent'];
$user_id = $_SESSION['user_id']; 

try {
  
    $conn = connectDB();

  
    $stmt = $conn->prepare("INSERT INTO notes (title, content, u_id) VALUES (?, ?, ?)");
    $stmt->execute([$title, $content, $user_id]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['note_insert_message'] = "Note inserted successfully";
        header("Location: ../dashboard.php");
    } else {
        $_SESSION['note_insert_message'] = "Failed to insert note";
    }

 
    $conn = null;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>


