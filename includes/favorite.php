<?php
include_once 'db_connectors.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'noteId' and 'isFavorite' parameters are set in the POST request
    if (isset($_POST['noteId']) && isset($_POST['isFavorite'])) {
        // Convert the 'isFavorite' parameter to a boolean value
        $isFavorite = $_POST['isFavorite'] ? 1 : 0; // Convert true or false to 1 or 0
        $noteId = $_POST['noteId']; // Get the note ID

        // Update the note's favorite status in the database
        try {

            // if( $isFavorite){
            //     $star = 1;
            // }else{
            //     $star = 0;
            // }
            $conn = connectDB();
            $stmt = $conn->prepare("UPDATE notes SET favorite = ? WHERE n_id = ?");
            $stmt->execute([$isFavorite, $noteId]);

            // Respond with a success message
            echo "Favorite status updated successfully.";
        } catch (PDOException $e) {
            // Handle any potential database errors
            echo "Error updating favorite status: " . $e->getMessage();
        }
    } else {
        // If 'noteId' or 'isFavorite' parameters are not set, respond with an error message
        echo "Missing parameters 'noteId' or 'isFavorite'.";
    }
} else {
    // If the request method is not POST, respond with an error message
    echo "Invalid request method.";
}
?>
