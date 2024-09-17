<?php
function connectDB() {
    $host = "localhost";
    $dbname = "online_notes";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    return null;
}

?>
<!-- $stmt = $conn->prepare("SELECT * FROM notes WHERE u_id = ? ORDER BY n_id DESC LIMIT 1");  -->