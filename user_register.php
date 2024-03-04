<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email,]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $message[] = 'email already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(name, email, password) VALUES(?,?,?)");
         $insert_user->execute([$name, $email, $cpass]);
         $message[] = 'registered successfully, login now please!';
         header('location:user_login.php');
      }
   }

}

?>


<?php include 'components/user_header.php'; ?>

    
    <!-- Registration Form -->

    <div class="container mt-5" >
        <div class="row justify-content-center">
            <div class="col-md-4">
                
                <form class="p-3" action="" method="post" style="border:1px solid grey;border-radius:2px;" autocomplete="off">
                <h2 class="mb-4 text-center">Account Registration</h2>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="name" id="username" placeholder="Enter username">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                    </div><br>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="pass" id="password" placeholder="Enter password">
                    </div><br>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" class="form-control" name="cpass" id="confirmPassword" placeholder="Confirm password">
                    </div><br>
                    <button type="submit" class="btn btn-success" name="submit">Register</button>
                    <p>Already have an account? <a href="user_login.php" class="option-btn">Login</a></p>
                    
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