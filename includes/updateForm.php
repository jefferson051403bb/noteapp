<?php 
include_once 'db_connectors.php';

if (isset($_GET['noteId'])) {
    // Get the note ID from the GET request
    $noteId = $_GET['noteId'];

    $conn = connectDB();
    if ($conn) {
        $stmt = $conn->prepare("SELECT * FROM notes WHERE n_id = ?");
        $stmt->execute([$noteId]);
        $note = $stmt->fetch(PDO::FETCH_ASSOC);

        echo '<span class="close" onclick ="hideOverlay2()">&times;</span>
              <h2 style="color:white;font-size:20px; font-weight: 900;text-shadow: 5px 5px 10px black;">Edit Note</h2>
              <form action="./includes/update_note_process.php" method="post">
                <input type="hidden" name="note_id" value="'. $note["n_id"] .'"/>
                <input type="text" placeholder="Title here..." id="noteTitle" name="title" value="' . $note['title'] . '" required><br><br>
                <textarea id="noteContent" placeholder="Add Note..." name="note_content" required>' . $note['content'] . '</textarea><br><br>
                <button type="submit" id="add" style="color:white;">Update Note</button>
              </form>';
    }
}
?>

