<?php

function connectDB() {
    $host = 'mariadb';
    $username = 'myuser';
    $password = 'mypassword';
    $database = 'mydatabase';

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die('Connection failed: ' . mysqli_connect_error());
    }

    return $conn;
}

function closeDB($conn) {
    mysqli_close($conn);
}

function getBlogEntries($searchTerm = null) {
    $conn = connectDB();

    $query = "SELECT * FROM publicaciones";

    // If a search term is provided, add the WHERE clause to filter by title or body
    if ($searchTerm !== null) {
        $query .= " WHERE Titulo LIKE '%$searchTerm%' OR Contenido LIKE '%$searchTerm%'";
    }

    // Add ORDER BY clause to order by date in descending order
    $query .= " ORDER BY FechaPublicacion DESC";

    $result = mysqli_query($conn, $query);

    $blogEntries = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $blogEntries[] = $row;
    }

    closeDB($conn);

    return $blogEntries;
}

function createUser($name, $email, $password) {
    $conn = connectDB();

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // SQL query to insert data into the users table
    $sql = "INSERT INTO usuarios (Nombre, Email, Contraseña) VALUES ('$name', '$email', '$hashedPassword')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // Registration successful
         // Start a session
        session_start();

         // Store user information in the session
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;
         // Redirect the user to index.php
        header("Location: index.php");
    } else {
        // Registration failed
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    closeDB($conn);
}

function login($email, $password, &$error) {
    $conn = connectDB();

    // Retrieve the hashed password from the database
    $sql = "SELECT * FROM usuarios WHERE Email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['Contraseña'];

        // Verify the entered password against the hashed password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, start a session
            session_start();

            // Store user information in the session
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $row['Nombre'];
            $_SESSION['ID'] = $row['UserID'];

            // Redirect to the desired page (e.g., index.php)
            header("Location: index.php");
            exit();
        } else {
            // Incorrect password
            $error = "Incorrect password";
        }
    } else {
        // User not found
        $error = "User not found";
    }

    closeDB($conn);
}

function createEntry($title, $body, $user) {
    $conn = connectDB();

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // SQL query to insert data into the users table
    $sql = "INSERT INTO publicaciones (Titulo, Contenido, AutorID, CategoriaID) VALUES ('$title', '$body', '$user', 1)";
    // $sql = "INSERT INTO usuarios (nombre, usuario_id, password) VALUES ('$name', '$username', '$hashedPassword')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo '<div class="alert alert-success" role="alert">Agregao!, muy peligrosa esa Mondá</div>';
    } else {
        // Registration failed
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        // echo '<div class="alert alert-danger" role="alert">Error adding blog entry.</div>';
    }

    closeDB($conn);
}

// Function to shorten text with ellipsis
function shortenText($text, $maxLength) {
    if (strlen($text) > $maxLength) {
        $shortenedText = substr($text, 0, $maxLength);
        $lastSpace = strrpos($shortenedText, " ");
        $shortenedText = substr($shortenedText, 0, $lastSpace) . '...';
        return $shortenedText;
    } else {
        return $text;
    }
}

// Function to fetch a blog entry by ID
function getBlogEntryById($entryId) {
    $conn = connectDB();

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM publicaciones WHERE PublicacionID = ?");
    $stmt->bind_param("i", $entryId);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch the blog entry details
    $blogEntry = $result->fetch_assoc();

    // Close the statement and connection
    $stmt->close();
    closeDB($conn);

    return $blogEntry;
}

// Function to fetch comments by entry ID
function getCommentsByEntryId($entryId) {
    $conn = connectDB();

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT c.ComentarioID, c.Contenido, c.FechaComentario, u.Nombre FROM comentarios AS c INNER JOIN usuarios AS u ON c.AutorID = u.UserID WHERE PublicacionID = ?");
    $stmt->bind_param("i", $entryId);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch comments
    $comments = [];
    while ($row = $result->fetch_assoc()) {
        $comments[] = $row;
    }

    // Close the statement and connection
    $stmt->close();
    closeDB($conn);

    return $comments;
}

// Function to add a new comment
function addComment($entryId, $commentText, $authorId) {
    $conn = connectDB();

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO comentarios (PublicacionID, Contenido, AutorID) VALUES (?, ?, ?)");
    $stmt->bind_param("isi", $entryId, $commentText, $authorId);
    $stmt->execute();

    // Close the statement and connection
    $stmt->close();

    // Update num_comments in blog_entries table
    $stmtUpdate = $conn->prepare("UPDATE publicaciones SET Comentarios = Comentarios + 1 WHERE PublicacionID = ?");
    $stmtUpdate->bind_param("i", $entryId);
    $stmtUpdate->execute();

    // Close the statement and connection
    $stmtUpdate->close();

    closeDB($conn);
}


?>
