<?php
include('components/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['description'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("INSERT INTO category (name, description) VALUES (?, ?)");
    $stmt->execute([$name, $description]);

    echo '<script>alert("Category added successfully.");</script>';
}
?>
<?php include('components/header.php'); ?>

<div class="main-container">
    <div class="navcontainer">
        <?php include('components/sidebar.php'); ?>
    </div>
    <div class="main">

        <div class="report-container2">
            <div class="report-header">
                <h1 class="recent-Posts">Add New Category</h1>
                <a href="post_categories.php"> <button class="view">Go Back</button></a>
            </div>

            <div class="report-body">
                <div class="add-post-form">
                    <form method="post" enctype="multipart/form-data">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" required>
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" rows="4"></textarea>
                        <button type="submit">Add Category</button>
                    </form>

                </div>

            </div>


        </div>
    </div>
</div>

<script>
  tinymce.init({
    selector: 'textarea',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
  });
</body>

</html>