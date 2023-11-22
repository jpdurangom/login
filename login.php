<?php
include 'db.php';

// Initialize the error variable
$error = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate the username and password (you may want to add more validation)
    if (!empty($username) && !empty($password)) {
        // Perform your authentication logic here (e.g., check against a database)
        login($username, $password, $error);
    } else {
        $error = "Both username and password are required";
    }
}

include 'layout/header.php'; 
include 'layout/navbar.php'; 
?>

<!-- Your Landing Page Content Goes Here -->
<div class="container mt-5">
    <h1 class="mb-4">¿Aquí vive Damian?</h1>

    <!-- Login Form -->
    <form action="login.php" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Correo:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Péguelo</button>

        <!-- Display the error message below the login button -->
        <?php
        if (!empty($error)) {
            echo '<div class="mt-3 alert alert-danger" role="alert">' . $error . '</div>';
        }
        ?>
    </form>

    <p class="mt-3">¿El servicio no es muy claro? <a href="register.php">Trágatela</a></p>
</div>

<?php include 'layout/footer.php'; ?>
