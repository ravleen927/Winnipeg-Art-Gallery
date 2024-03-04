<?php

include 'components/connect.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
    $select_user->execute([$email, $pass]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if ($select_user->rowCount() > 0) {
        $_SESSION['user_id'] = $row['id'];

        // Check the user role and redirect accordingly
        if ($row['role'] == 'Admin') {
            header('location: dashboard/'); 
        } elseif ($row['role'] == 'Editor') {
            header('location: editor_dashboard/'); 
        } elseif ($row['role'] == 'Contributor') {
            header('location: contributors_dashboard/'); 
        } else {
            header('location: index.php'); 
        }
    } else {
        $message[] = 'Incorrect username or password!';
    }
}


?>


<?php include 'components/user_header.php'; ?>

    
    <!-- Login Form -->

    <div class="container mt-5" >
        <div class="row justify-content-center">
            <div class="col-md-4">
                
                <form class="p-3" action="" method="post" style="border:1px solid grey;border-radius:2px;" autocomplete="off">
                <h2 class="mb-4 text-center">Account Login</h2>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" autocomplete="off">
                    </div><br>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="pass" id="password" placeholder="Enter password">
                    </div><br>
                    
                    <button type="submit" class="btn btn-success" name="submit">Login</button>
                    <p>Don't have an account?  <a href="user_register.php" class="option-btn">Register</a></p>
     
                </form>
            </div>
        </div>
    </div>
    <br>
    <br>
    
    <section class="bg-light py-5">
    <div class="container my-4">

    </div>
</section>

<!-- Start Footer -->
<?php include 'components/footer.php'; ?>
</body>

</html>