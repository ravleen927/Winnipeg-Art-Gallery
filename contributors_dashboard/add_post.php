<?php
include('components/connect.php');
$msg = "";
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch form data
    $name = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    $image = 'image.jpg';

    if (!empty($_FILES['image']['tmp_name'])) {
        $uploadsDir = '..\upload/';
        $imageName = basename($_FILES['image']['name']);
        $image = $uploadsDir . $imageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $image);


        $imageFilename = $imageName;
    }

    $stmt = $pdo->prepare("INSERT INTO posts (name, category, image, description) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name,  $category, $imageFilename, $description]);

    header('Location: add_post.php');
    $msg = "Post Deleted successfully ";
    exit();
}

?>
<?php include('components/header.php'); ?>

<div class="main-container">
    <div class="navcontainer">
        <?php include('components/sidebar.php'); ?>
    </div>
    <div class="main">

       
        <?php if ($msg) { ?>

            <strong>Well done!</strong>
            <?php echo htmlentities($msg); ?>

        <?php } ?>
        <div class="report-container2">
            <div class="report-header">
                <h1 class="recent-Posts">Add New Post</h1>
                <a href="posts.php"> <button class="view">Go Back</button></a>
            </div>

            <div class="report-body">
                <div class="add-post-form">
                    <form method="post" id="artForm" enctype="multipart/form-data">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" required>

                        <?php
                        $stmt = $pdo->query("SELECT id, name FROM category");
                        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <label for="category">Category:</label>
                        <select id="category" name="category" required>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= htmlspecialchars($category['name']) ?>">
                                    <?= htmlspecialchars($category['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <label for="image">Select Image:</label>
                        <input type="file" id="image" name="image">

                        <label for="description">Description:</label>
                        <textarea id="description" name="description" rows="4"></textarea>

                        <button type="submit">Add Post</button>
                    </form>

                </div>

            </div>


        </div>
    </div>
</div>

</body>

</html>