<?php
include_once 'db_connectors.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $noteID = $_POST['note_id'];
    $newTitle = $_POST['title'];
    $newContent = $_POST['note_content'];
    $conn = connectDB();
    // Update the note in the database
    $stmt = $conn->prepare("UPDATE `notes` SET title = :title, content = :content WHERE n_id = :note_id");
    $stmt->bindParam(':title', $newTitle);
    $stmt->bindParam(':content', $newContent);
    $stmt->bindParam(':note_id', $noteID);

    if ($stmt->execute()) {
        // Redirect to the update.php page with a success message
        header("Location: ../dashboard.php?error=1");
        exit();
    } else {
        // Redirect to the update.php page with an error message
        header("Location: ../dashboard.php?error=1");
        exit();
    }
} else {
    // Redirect to the update.php page if accessed directly without submitting the form
    header("Location: ../dashboard.php?error=1");
    exit();
}
?>
