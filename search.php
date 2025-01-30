<?php
// search.php

// Check if the token is set
if (isset($_GET['token'])) {
    $tokenRaw = $_GET['token'];
    $token = trim($tokenRaw);

    // Validate the token length and ensure it's 6 characters
    if (strlen($token) == 6) {
        // Check the first letter of the token
        $firstChar = strtoupper($token[0]);

        // Redirect based on the first letter of the token
        if ($firstChar == 'B') {
            header("Location: view_birth.php?token=$token");
        } elseif ($firstChar == 'D') {
            header("Location: view_death.php?token=$token");
        } elseif ($firstChar == 'M') {
            header("Location: view_migration.php?token=$token");
        } else {
            // Handle invalid token starting letter if needed
            echo "Invalid token format.";
        }
    } else {
        // Handle invalid token length
        echo "Token must be 6 characters.";
    }
} else {
    // Handle case if no token is provided
    echo "No token provided.";
}
