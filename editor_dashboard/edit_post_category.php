<?php
include('components/connect.php');

// Handle edit request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    if (isset($_POST['edit_id'])) {
        // Edit existing category
        $editId = $_POST['edit_id'];

        $stmt = $pdo->prepare("UPDATE category SET name = ?, description = ? WHERE id = ?");
        $stmt->execute([$name, $description, $editId]);

        echo '<script>alert("Category updated successfully.");</script>';
    } else {

        $stmt = $pdo->prepare("INSERT INTO category (name, description) VALUES (?, ?)");
        $stmt->execute([$name, $description]);

        echo '<script>alert("Category added successfully.");</script>';
    }
}

// Fetch data for editing
$editId = isset($_GET['edit_id']) ? $_GET['edit_id'] : null;
$editData = [];
if ($editId) {
    $stmt = $pdo->prepare("SELECT * FROM category WHERE id = ?");
    $stmt->execute([$editId]);
    $editData = $stmt->fetch(PDO::FETCH_ASSOC);
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
                <h1 class="recent-Posts">Edit Category</h1>
                <a href="post_categories.php"> <button class="view">Go Back</button></a>
            </div>

            <div class="report-body">
                <div class="add-post-form">
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="edit_id" value="<?= $editId ?>">

                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="<?= $editData['name'] ?>" required>

                        <label for="description">Description:</label>
                        <textarea id="description" name="description"
                            rows="4"><?= $editData['description'] ?></textarea>

                        <button type="submit">
                            <?= $editId ? 'Update' : 'Add' ?> Category
                        </button>
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
</script>
</body>

</html>