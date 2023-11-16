<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="mb-4">Register a New User</h1>

        <!-- Registration Form -->
        <form action="register_process.php" method="post">
            <div class="mb-3">
                <label for="newUsername" class="form-label">Username:</label>
                <input type="text" class="form-control" id="newUsername" name="newUsername" required>
            </div>
            <div class="mb-3">
                <label for="newPassword" class="form-label">Password:</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        <p class="mt-3"><a href="index.php">Go back</a></p>
    </div>

    <!-- Bootstrap JS scripts (required for some features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
