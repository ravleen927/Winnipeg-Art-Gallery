<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};



?>


<?php include 'components/user_header.php'; ?>


  

    <!-- Open Content -->
    <section class="bg-light">
        <div class="container pb-5">
        <?php
                    $pid = $_GET['pid'];
                    $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE id = ?"); 
                    $select_posts->execute([$pid]);
                    if($select_posts->rowCount() > 0){
                    while($fetch_post = $select_posts->fetch(PDO::FETCH_ASSOC)){
                    ?>
                <form action="" method="post" class="box">
              <div class="row">
                   
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        <img class="card-img img-fluid p-2" src="upload/<?= $fetch_post['image']; ?>" alt="Card image cap" id="product-detail" style="height:55vh; width:100%; background-size:cover;">
                    </div>
                    
                </div>
                <!-- col end -->
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h2"><?= $fetch_post['name']; ?></h1>
                            <i class="list-inline-item text-dark">By Doe</i>
                            <p class="py-2">
                               Posted on :
                                <span class="list-inline-item text-dark"><?= $fetch_post['created_at']; ?></span>
                            </p>

                            <h6>Description:</h6>
                            <p><?= $fetch_post['description']; ?></p>

                            <form action="" method="GET">
                                <input type="hidden" name="product-title" value="Activewear">
                                <div class="row">
                                    <div class="col-auto">
                                    </div>
                                    
                                </div>
                                
                            </form>

                        </div>
                    </div>
                </div>
            </div>
      
        </div>
        <?php
      }
   }else{
      echo '<p class="empty">no posts added yet!</p>';
   }
   ?>
    </section>
    <!-- Close Content -->

    
    <section class="bg-light py-5">
    <div class="container my-4">

    </div>
</section>

<!-- Start Footer -->
<?php include 'components/footer.php'; ?>
</body>

</html>