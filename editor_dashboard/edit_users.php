<?php
include('components/connect.php');

// Handle edit request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role = $_POST['role'];

    if (isset($_POST['edit_id'])) {
        $editId = $_POST['edit_id'];

        $stmt = $pdo->prepare("UPDATE users SET role = ? WHERE id = ?");
        $stmt->execute([$role, $editId]);

        echo '<script>alert("User updated successfully.");</script>';
    }
}

// Fetch data for editing
$editId = isset($_GET['edit_id']) ? $_GET['edit_id'] : null;
$editData = [];
if ($editId) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$editId]);
    $editData = $stmt->fetch(PDO::FETCH_ASSOC);
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
                <h1 class="recent-Posts">Edit User</h1>
                <a href="users.php"> <button class="view">Go Back</button></a>
            </div>

            <div class="report-body">
                <div class="add-post-form">
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="edit_id" value="<?= $editId ?>">

                        <label for="role">Role:</label>
                        <select id="role" name="role" required>
                            <option value="<?= $editData['role'] ?>">
                                <?= $editData['role'] ?>
                            </option>
                            <option value="User"> User </option>
                            <option value="Admin"> Admin </option>
                        </select>
                        <button type="submit">
                            <?= $editId ? 'Update' : 'Add' ?> User
                        </button>
                    </form>

                </div>

            </div>

        </div>
    </div>
</div>


</body>

</html>