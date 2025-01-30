<?php
// Include the database connection
include('database.php');

// Start the session to track user login status
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare an SQL statement to check if the user exists in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username); // Bind parameter (string)

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        // User found, fetch the row
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Set session variables upon successful login
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            echo "<div class='alert alert-success'>Logged in Successfully!</div>";
            header("Location: index.php");
        } else {
            echo "<div class='alert alert-danger'>Invalid password. Please try again.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Invalid username. Please try again.</div>";
    }

    // Close the statement
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="rm-bs.css">
</head>

<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="text-center mb-4">Login</h2>
                        <!-- Login Form -->
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                        <a href="index.php" class="btn btn-link mt-3">Back to Home</a>
                        <!-- Display Alerts (these are dynamically shown if login fails or succeeds) -->
                        <div id="alert-container">
                            <!-- Alerts will be dynamically injected here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3 JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0z94yO+f5OfNKM1bd8TxM7tpbVdENkw67R2MR6O0m07wI02O" crossorigin="anonymous"></script>
</body>

</html>