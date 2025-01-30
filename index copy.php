<?php
// database.php (to be included in all files)
include 'database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Event Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?php
                    // Check if the user is logged in
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                        // If the user is logged in, display the Logout button
                        echo "<li class=\"nav-item\"> <a href='logout.php' class='nav-link active'>Log Out</a> </li>";
                    } else {
                        // If the user is not logged in, display the Login button
                        echo "<li class=\"nav-item\"> <a href='login.php' class='nav-link active'>Login</a> </li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Event Management System</h1>

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="mb-4">
                    <form method="GET" action="search.php">
                        <label for="tokenInput" class="form-label">Enter Token Number:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="tokenInput" name="token" maxlength="6" placeholder="Enter 6-digit token" required>
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div>

                <div class="text-center">
                    <a href="birth.php" class="btn btn-success btn-lg me-2">Birth Registration</a>
                    <a href="death.php" class="btn btn-danger btn-lg me-2">Death Registration</a>
                    <a href="migration.php" class="btn btn-warning btn-lg">Migration Registration</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>