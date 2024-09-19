<?php
function connectDB() {
    $host = getenv('DB_HOST');
    $username = getenv('DB_USERNAME');
    $password = getenv('DB_PASSWORD');
    $dbname = getenv('DB_DATABASE');
    $port = getenv('DB_PORT') ?: '3306'; // Default to 3306 if not set

    // Establish connection using mysqli
    $conn = mysqli_connect($host, $username, $password, $dbname, $port);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $conn;
}
?>
