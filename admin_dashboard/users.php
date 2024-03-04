<?php
include('components/connect.php');

// Fetch data from the database
$stmt = $pdo->query("SELECT * FROM users");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle delete request
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];

    // Perform the deletion
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$deleteId]);
    header('Location: users.php');

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
                <h1 class="recent-Posts">Registered Users</h1>
            </div>

            <div class="report-body">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Registration Date</th>
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
                                    <?= htmlspecialchars($row['email']) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($row['role']) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($row['registeration_date']) ?>
                                </td>

                                <td>
                                    <a href="edit_users.php?edit_id=<?= $row['id'] ?>" class="action-btn edit-btn">Edit</a>
                                    <a href="users.php?delete_id=<?= $row['id'] ?>" class="action-btn delete-btn"
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

<script src="assets/script.js"></script>
</body>

</html>