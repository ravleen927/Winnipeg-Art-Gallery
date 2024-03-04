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

   $update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
   $update_profile->execute([$name, $email, $user_id]);

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $prev_pass = $_POST['prev_pass'];
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   if($old_pass == $empty_pass){
      $message[] = 'please enter old password!';
   }elseif($old_pass != $prev_pass){
      $message[] = 'old password not matched!';
   }elseif($new_pass != $cpass){
      $message[] = 'confirm password not matched!';
   }else{
      if($new_pass != $empty_pass){
         $update_admin_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
         $update_admin_pass->execute([$cpass, $user_id]);
         $message[] = 'password updated successfully!';
      }else{
         $message[] = 'please enter a new password!';
      }
   }
   
}
?>

<?php include 'components/user_header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <form class="p-3" action="" method="post" style="border:1px solid grey;border-radius:2px;" autocomplete="off">
                <h2 class="mb-4 text-center">Change Password</h2>
                <div class="form-group">
                    <label for="password">Old Password</label>
                    <input type="password" class="form-control"  name="old_pass" id="password" placeholder="Enter old password">
                </div><br>
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" class="form-control" name="new_pass" id="password" placeholder="Enter new password">
                </div><br>
                <div class="form-group">
                    <label for="confirmPassword">Confirm New Password</label>
                    <input type="password" class="form-control" name="cpass" id="confirmPassword" placeholder="Confirm password">
                </div><br>
                <button type="submit" class="btn btn-success" name="submit">Update</button>
            </form>
        </div>
    </div>
</div>


<section class="bg-light py-5">
    <div class="container my-4">

    </div>
</section>
<?php include 'components/footer.php'; ?>
</body>

</html>
