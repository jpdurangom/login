<?php
// Include necessary files and functions
include 'layout/header.php';
include 'layout/navbar.php';
include 'db.php';

// Check if an entry ID is provided in the URL
if (isset($_GET['id'])) {
    $entryId = $_GET['id'];

    // Fetch the blog entry details by ID
    $blogEntry = getBlogEntryById($entryId);

    // Check if the entry exists
    if ($blogEntry) {
      // Handle comment submission
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if the form was submitted
        if (isset($_POST['comment_text'])) {
            // Get the submitted comment text
            $commentText = $_POST['comment_text'];

            // Add the comment to the database
            addComment($entryId, $commentText, $_SESSION['ID']);
        }
      }
      $comments = getCommentsByEntryId($entryId);
      $numComments = count($comments);
        // Display the entry details
?>
        <div class="container mt-5">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title"><?= htmlspecialchars($blogEntry['Titulo']); ?></h2>
                    <p class="card-text"><?= $blogEntry['Contenido']; ?></p>
                    <p class="card-text">Number of Comments: <?=  $numComments; ?></p>
                </div>
            </div>
            <!-- Comment Section -->
            <div class="mt-4">
                <h3>Comments</h3>
                <?php
                // Display comments for the current entry
                
                foreach ($comments as $comment) {
                    echo '<div class="card mb-2">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-subtitle mb-2 text-muted">' . $comment['Nombre'] . '</h5>';
                    echo '<p class="card-text">' . htmlspecialchars($comment['Contenido']) . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>

                <!-- Form to add a new comment -->
                <?php if (isset($_SESSION['name'])) : ?>
                  <form action="" method="post" class="mt-3">
                    <div class="form-group">
                        <label for="comment">Add Comment:</label>
                        <textarea class="form-control" id="comment" name="comment_text" rows="3" required></textarea>
                    </div>
                    <input type="hidden" name="entry_id" value="<?= $entryId; ?>">
                    <button type="submit" class="btn btn-primary">Submit Comment</button>
                  </form>
                <?php endif; ?>

            </div>
        </div>
        <?php
    } else {
        // Handle the case where the entry does not exist
        echo '<div class="container mt-5"><p>Entry not found.</p></div>';
    }
} else {
    // Handle the case where no entry ID is provided
    echo '<div class="container mt-5"><p>Invalid request.</p></div>';
}

// Include the footer
include 'layout/footer.php';
?>
