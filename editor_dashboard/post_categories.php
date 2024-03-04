<?php
include('components/connect.php');

// Fetch data from the database
$stmt = $pdo->query("SELECT * FROM category");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle delete request
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];

    // Perform the deletion
    $stmt = $pdo->prepare("DELETE FROM category WHERE id = ?");
    $stmt->execute([$deleteId]);
    header('Location: post_categories.php');

}
?>
<?php include('components/admin_header.php'); ?>

<div class="main-container">
    <div class="navcontainer">
        <?php include('components/sidebar.php'); ?>
    </div>
    <div class="main">

       

        <div class="report-container2">
            <div class="report-header">
                <h1 class="recent-Posts">Post Categories</h1>
                <a href="add_post_category.php"> <button class="view">Add New</button></a>
            </div>

            <div class="report-body">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>Name</th>
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
                                    <?= htmlspecialchars($row['created_at']) ?>
                                </td>

                                <td>
                                    <a href="edit_post_category.php?edit_id=<?= $row['id'] ?>"
                                        class="action-btn edit-btn">Edit</a>
                                    <a href="post_categories.php?delete_id=<?= $row['id'] ?>" class="action-btn delete-btn"
                                        onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
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