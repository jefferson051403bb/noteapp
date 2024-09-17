<?php
include_once 'db_connectors.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete'])) {
    $noteID = $_GET['delete'];

    try {
        // Connect to the database
        $conn = connectDB();

        // Check if connection is successful
        if ($conn) {
            // Delete the note from the database
            $stmt = $conn->prepare("DELETE FROM `notes` WHERE n_id = :note_id");
            $stmt->bindParam(':note_id', $noteID);

            if ($stmt->execute()) {
                // Redirect back to the dashboard.php page with a success message
                header("Location: ../dashboard.php?success=1");
                exit();
            } else {
                // Redirect back to the dashboard.php page with an error message
                header("Location: ../dashboard.php?error=1");
                exit();
            }
        } else {
            // Handle connection error
            echo "Database connection failed.";
            exit();
        }
    } catch (PDOException $e) {
        // Handle database error
        echo "Error: " . $e->getMessage();
        exit();
    }
} else {
    // Redirect to the dashboard.php page if accessed directly or without a valid note ID
    header("Location: ../dashboard.php");
    exit();
}
?>
