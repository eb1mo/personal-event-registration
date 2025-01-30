<?php
// database.php (to be included in all files)
include 'database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>व्यक्तिगत घटना दर्ता</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="rm-bs.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">व्यक्तिगत घटना दर्ता</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php
                    session_start();
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                        echo "<li class='nav-item'><a href='logout.php' class='nav-link'>Log Out</a></li>";
                    } else {
                        echo "<li class='nav-item'><a href='login.php' class='nav-link'>Login</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="hero">
        <h1>व्यक्तिगत घटना दर्ता</h1>
        <h3 class="fw-light">(Vyaktigat Ghatana Darta)</h3>
    </div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-container">
                    <form method="GET" action="search.php">
                        <label for="tokenInput" class="form-label">Enter Token Number: (6 Digits) </label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="tokenInput" name="token" maxlength="6" placeholder="टोकन नम्बर यहाँ हाल्नुहोस्" required>
                            <button class="btn btn-primary" type="submit"> &#128269; Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card-container">
        <div class="custom-card bg-light text-dark">
            <h4>Birth Registration</h4>
            <h5>( जन्म दर्ता )</h5>
            <a href="birth.php" class="btn btn-primary">Register</a>
        </div>
        <div class="custom-card bg-light text-dark">
            <h4>Death Registration</h4>
            <h5>( मृत्यु दर्ता )</h5>
            <a href="death.php" class="btn btn-danger">Register</a>
        </div>
        <div class="custom-card bg-light text-dark">
            <h4>Migration Registration</h4>
            <h5>( बसाइँसराइ दर्ता )</h5>
            <a href="migration.php" class="btn btn-warning">Register</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>