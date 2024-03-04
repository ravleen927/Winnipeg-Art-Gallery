<?php
include('components/connect.php');
$msg = "";
// Fetch data from the database
$stmt = $pdo->query("SELECT * FROM posts");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle delete request
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];

    // Perform the deletion
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->execute([$deleteId]);
    header('Location: posts.php');
    $msg = "Post Deleted successfully ";


}
?>
<?php include('components/admin_header.php'); ?>

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
                <h1 class="recent-Posts">Published Posts</h1>
                <a href="add_post.php"> <button class="view">Add New</button></a>
            </div>

            <div class="report-body">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Creation Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $row): ?>
                            <tr>
                                <td>
                                    <?= htmlspecialchars($row['name']) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($row['category']) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($row['created_at']) ?>
                                </td>

                                <td>
                                    <a href="edit_posts.php?edit_id=<?= $row['id'] ?>" class="action-btn edit-btn">Edit</a>
                                    <a href="posts.php?delete_id=<?= $row['id'] ?>" class="action-btn delete-btn"
                                        onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>


        </div>
    </div>
</div>

<script src="script.js"></script>
</body>

</html>