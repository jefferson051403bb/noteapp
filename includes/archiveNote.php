<?php
include_once 'db_connectors.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['archive'])) {
    $noteID = $_GET['archive'];

    try {
        // Connect to the database
        $conn = connectDB();

        // Check if connection is successful
        if ($conn) {
            // Delete the note from the database
            $stmt = $conn->prepare("UPDATE `notes` SET `archive`= 1 WHERE `n_id` = :note_id");
            $stmt->bindParam(':note_id', $noteID);

            if ($stmt->execute()) {
                // Redirect back to the dashboard.php page with a success message
                echo '<script>
                window.location.href = "../dashboard.php";
                document.addEventListener("DOMContentLoaded", function () {

                    
                    document.getElementById("archiv").classList.remove("hidden");
                    document.getElementById("pageTitle").textContent = "Archives";
                   
                });
            </script>
            ';
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
