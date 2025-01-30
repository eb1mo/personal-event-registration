<?php
include 'database.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit;
}

// Handle data deletion when the delete button is clicked
if (isset($_GET['token'])) {
    $token = $_GET['token']; // The alphanumeric token passed in the URL

    // Prepare the delete query using the token
    $sql = "DELETE FROM migration_records WHERE token = ?";

    // Prepare and bind the statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $token); // 's' for string type

        // Execute the deletion
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Record deleted successfully!</div>";
            header("Location: index.php");
        } else {
            echo "<div class='alert alert-danger'>Error deleting record: " . $stmt->error . "</div>";
        }

        // Close the statement
        $stmt->close();
    }
}
