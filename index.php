<?php
include 'layout/header.php';
include 'layout/navbar.php';
include 'db.php';

$blogEntries = getBlogEntries($_GET['search']);
?>

<!-- Your Landing Page Content Goes Here -->
<div class="container mt-5">
    <h2>Puras Mierdas</h2>

    <?php
        foreach ($blogEntries as $entry) {
            echo '<div class="card mb-4">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title"> <a href="view.php?id=' . $entry['PublicacionID'] . '" >' . htmlspecialchars($entry['Titulo']) . '</a></h5>';

            // Shorten and display body content with ellipsis
            $shortenedBody = shortenText($entry['Contenido'], 150); // Adjust the length as needed
            echo '<p class="card-text">' . strip_tags($shortenedBody) . '</p>';

            echo '<p class="card-text">Comentarios: ' . $entry['Comentarios'] . '</p>';
            echo '</div>';
            echo '</div>';
        }
    ?>

    <!-- Add more blog entries as needed -->

</div>

<?php include 'layout/footer.php'; ?>
