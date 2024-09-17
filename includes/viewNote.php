<?php
// Include database connection code
include_once 'db_connectors.php';

// Check if noteId is provided in the GET request
if (isset($_GET['noteId'])) {
    // Get the note ID from the GET request
    $noteId = $_GET['noteId'];

    try {
        // Connect to the database
        $conn = connectDB();

        // Prepare and execute a query to fetch the note content based on noteId
        $stmt = $conn->prepare("SELECT * FROM notes WHERE n_id = ?");
        $stmt->execute([$noteId]);

        // Fetch the note data
        $note = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the note was found
        if ($note) {
            // Output the note content
            echo "<h1>" . $note["title"] . "</h1>";
            // echo "<hr>";
            echo "<p>" . $note["content"] . "</p>";
        } else {
            // If note was not found, output a message
            echo "Note not found.";
        }
    } catch (PDOException $e) {
        // Handle database error
        echo "Error fetching note content: " . $e->getMessage();
    } finally {
        // Close the database connection
        $conn = null;
    }
} else {
    // If noteId is not provided in the GET request, output an error message
    echo "Note ID not provided.";
}
?>