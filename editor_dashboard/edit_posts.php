<?php
include('components/connect.php');

// Handle edit request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $editId = $_POST['edit_id'];

    // Fetch existing data
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->execute([$editId]);
    $existingData = $stmt->fetch(PDO::FETCH_ASSOC);

    // Update the data
    $name = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $status = $_POST['status'];  // Add this line

    // Check if a new image is provided
    if (!empty($_FILES['image']['name'])) {
        $uploadsDir = '..\upload/';
        $newImageName = uniqid() . '_' . basename($_FILES['image']['name']);
        $imagePath = $uploadsDir . $newImageName;
    
        if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            if ($existingData['image'] !== 'default.jpg') {
                // unlink($uploadsDir . $existingData['image']);
            }
            $stmt = $pdo->prepare("UPDATE posts SET name = ?, category = ?, description = ?, image = ?, status = ? WHERE id = ?");
            $stmt->execute([$name, $category, $description, $newImageName, $status, $editId]);
        } else {
            echo '<script>alert("Error uploading the image.");</script>';
        }
    } else {
        $stmt = $pdo->prepare("UPDATE posts SET name = ?, category = ?, description = ?, status = ? WHERE id = ?");
        $stmt->execute([$name, $category, $description, $status, $editId]);
    }

    echo '<script>alert("Post updated successfully.");</script>';
}


// Fetch data for editing
$editId = isset($_GET['edit_id']) ? $_GET['edit_id'] : null;
$editData = [];
if ($editId) {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
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
                <h1 class="recent-Posts">Edit Post</h1>
                <a href="posts.php"> <button class="view">Go Back</button></a>
            </div>

            <div class="report-body">
                <div class="add-post-form">
                    <form method="post" id="artForm" enctype="multipart/form-data">
                        <input type="hidden" name="edit_id" value="<?= $editId ?>">

                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="<?= $editData['name'] ?>" required>

                        <label for="category">Category:</label>
                        <input type="text" id="category" name="category" value="<?= $editData['category'] ?>" required>

                        <label for="image">Select Image:</label>
                        <input type="file" id="image" name="image">

                        <label for="description">Description:</label>

                        <textarea  name="description" rows="4"><?= $editData['description'] ?></textarea>

                        <label for="status">Status:</label>
                        <select id="status" name="status" required>
                            <option value="Pending" <?= ($editData['status'] == 'Pending') ? 'selected' : ''; ?>>Pending
                            </option>
                            <option value="Approved" <?= ($editData['status'] == 'Approved') ? 'selected' : ''; ?>>
                                Approved</option>
                        </select>

                        <button type="submit">Update Post</button>
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