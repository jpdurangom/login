<?php
include 'db.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input from the form
    $name = $_POST['newName'];
    $email = $_POST['newEmail'];
    $password = $_POST['newPassword'];

    // You can perform additional validation here before calling createUser

    // Call the createUser function to insert data into the users table
    createUser($name, $email, $password);
}

include 'layout/header.php';
include 'layout/navbar.php';

?>

<div class="container mt-5">
        <h1 class="mb-4">Entrar a la casa del Güiro</h1>

        <!-- Registration Form -->
        <form action="register.php" method="post">
            <div class="mb-3">
                <label for="newName" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="newName" name="newName" required>
            </div>
            <div class="mb-3">
                <label for="newEmail" class="form-label">Correo:</label>
                <input type="email" class="form-control" id="newEmail" name="newEmail" required>
            </div>
            <div class="mb-3">
                <label for="newPassword" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword" required>
            </div>
            <button type="submit" class="btn btn-primary">Péguelo</button> 
        </form>
        <p class="mt-3"><a href="index.php">Se fue la luz pana :(</a></p>
    </div>

<?php include 'layout/footer.php'; ?>
