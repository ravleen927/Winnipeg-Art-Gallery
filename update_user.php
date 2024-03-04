<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
    $update_profile->execute([$name, $email, $user_id]);

    // Check if role option is set in $_POST
    $role = isset($_POST['role']) ? $_POST['role'] : '';
    $update_role = $conn->prepare("UPDATE `users` SET role = ? WHERE id = ?");
    $update_role->execute([$role, $user_id]);

    $message[] = 'Profile updated successfully!';
}

?>

<?php include 'components/user_header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <form class="p-3" action="" method="post" style="border:1px solid grey;border-radius:2px;"
                autocomplete="off">
                <h2 class="mb-4 text-center">Update Account</h2>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="name" id="username" placeholder="Enter username"
                        value="<?= $fetch_profile["name"]; ?>">
                </div>
                <br>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter email"
                        value="<?= $fetch_profile["email"]; ?>">
                </div>
                <br>
                <div class="form-group">
                    <label for="isContributor">Become a Contributor?</label>
                    <select class="form-control" name="role">
                        <option value="Contributor" <?= ($fetch_profile['role'] == 'Contributor') ? 'selected' : ''; ?>>
                            Yes</option>
                        <option value="" <?= ($fetch_profile['role'] == '') ? 'selected' : ''; ?>>No</option>
                    </select>
                </div>

                <br>
                <button type="submit" class="btn btn-success" name="submit">Update</button><br>
                <p>To change password <a href="change_password.php" class="option-btn">Click here</a></p>
            </form>
        </div>
    </div>
</div>
<br>

<section class="bg-light py-5">
    <div class="container my-4">

    </div>
</section>

<!-- Start Footer -->
<?php include 'components/footer.php'; ?>
</body>

</html>
