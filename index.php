<?php
include 'layout/header.php';
include 'layout/navbar.php';
include 'db.php';

$blogEntries = getBlogEntries($_GET['search'], $_GET['page']);

function generatePagination($currentPage, $totalPages) {
    echo '<ul class="pagination">';
    echo '<li class="page-item"><a class="page-link" href="?page=1">First</a></li>';

    for ($i = max(1, $currentPage - 2); $i <= min($currentPage + 2, $totalPages); $i++) {
        echo '<li class="page-item' . ($i == $currentPage ? ' active' : '') . '">';
        echo '<a class="page-link" href="?page=' . $i . '">' . $i . '</a>';
        echo '</li>';
    }

    echo '<li class="page-item"><a class="page-link" href="?page=' . $totalPages . '">Last</a></li>';
    echo '</ul>';
}

?>

<!-- Your Landing Page Content Goes Here -->
<div class="container mt-5">
    <h2>Puras Mierdas</h2>
    <nav aria-label="Page navigation example">
    <?php
        // Assuming $totalPages is the total number of pages based on your query result
        $totalPages = getTotalPages();

        // Assuming $currentPage is the current page number obtained from $_GET['page']
        $currentPage = $_GET['page'] ?? 1;

        // Generate the pagination links at the top
        generatePagination($currentPage, $totalPages);
    ?>
    </nav>

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

        generatePagination($currentPage, $totalPages);
    ?>

    <!-- Add more blog entries as needed -->

</div>

<?php include 'layout/footer.php'; ?>
