<?php
// Include your database connection file
include_once('database.php');  // Ensure the path to database.php is correct

// Check if the connection is successful
if (!$conn) {
    die("Database connection failed.");
}

// Get the token, file, and table from the query parameters
if (isset($_GET['token']) && isset($_GET['file']) && isset($_GET['table'])) {
    $token = $_GET['token'];       // The token identifier
    $file = $_GET['file'];         // The file type to download (e.g., 'signature', 'left_thumb')
    $table = $_GET['table'];       // The table name (e.g., 'birth_records', 'death_records', 'migration_records')

    // Prepare the SQL query to fetch the file path from the appropriate table
    $query = "SELECT `$file` FROM `$table` WHERE `token` = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $token); // Binding the token parameter
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    // Check if the record exists
    if (mysqli_stmt_num_rows($stmt) > 0) {
        // Fetch the file path
        mysqli_stmt_bind_result($stmt, $file_path);
        mysqli_stmt_fetch($stmt);

        // Verify the file exists
        if (file_exists($file_path)) {
            // Send the file to the browser for download
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
            readfile($file_path);
            exit;
        } else {
            echo "Error: File not found.";
        }
    } else {
        echo "Error: Invalid token.";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo "Error: Missing required parameters.";
}
