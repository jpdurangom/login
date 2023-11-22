<?php
include 'layout/header.php';
include 'layout/navbar.php';
include 'db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $title = $_POST['title'];
    $body = $_POST['body'];

    createEntry($title, $body, $_SESSION['ID']);
}
?>

<div class="container mt-5">
    <h2>Agregar una Modá nueva</h2>
    <p class="text-muted">¿Le quedam dudams?</p>
    <!-- Blog Entry Form -->
    <form action="new.php" method="post">
        <div class="form-group">
            <label for="title">Título:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="body">Contenido:</label>
            <textarea class="form-control" id="body" name="body" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Péguelo</button>
    </form>
</div>

<!-- TinyMCE Initialization Script -->
<!-- Place the first <script> tag in your HTML's <head> -->
<script src="https://cdn.tiny.cloud/1/l7mjfiyq4ahwbkhv9fepm1w7sl5gwk002439tevvj6mbdlf6/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
  tinymce.init({
    selector: 'textarea',
    plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
      { value: 'First.Name', title: 'First Name' },
      { value: 'Email', title: 'Email' },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
  });
</script>



<?php include 'layout/footer.php'; ?>
