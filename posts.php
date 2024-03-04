<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}
;



?>


<?php include 'components/user_header.php'; ?>


<div class="container py-5">
    <div class="row">
        <div class="col-lg-3">
            <h1 class="h2 pb-4">Categories</h1>
            <ul class="list-unstyled">
                <?php
                $select_categories = $conn->prepare("SELECT * FROM `category`");
                $select_categories->execute();

                while ($category = $select_categories->fetch(PDO::FETCH_ASSOC)) {
                    echo '<li class="pb-4"><a href="?category=' . urlencode($category['name']) . '">' . htmlspecialchars($category['name']) . '</a></li>';
                }
                ?>
            </ul>
        </div>



        <div class="col-lg-9">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-inline shop-top-menu pb-3 pt-1">
                        <li class="list-inline-item">
                            <a class="h3 text-dark text-decoration-none mr-3" href="#">All</a>
                        </li>

                    </ul>
                </div>

            </div>
            <div class="row">
                <?php
                if (isset($_GET['category'])) {
                    $selectedCategory = urldecode($_GET['category']);
                    $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE category = ?");
                    $select_posts->execute([$selectedCategory]);
                } else {
                    $select_posts = $conn->prepare("SELECT * FROM `posts`");
                    $select_posts->execute();
                }

                if ($select_posts->rowCount() > 0) {
                    while ($fetch_post = $select_posts->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <div class="col-md-4">

                            <form action="" method="post" class="box">
                                <div class="card mb-4 product-wap rounded-0">
                                    <div class="card rounded-0">
                                        <img class="card-img rounded-0 img-fluid"
                                            src="upload/<?= $fetch_post['image']; ?>" style="height:40vh; width:100%">
                                        <div
                                            class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                            <ul class="list-unstyled">
                                                <li><a class="btn btn-success text-white mt-2"
                                                        href="post_details.php?pid=<?= $fetch_post['id']; ?>"><i
                                                            class="far fa-eye"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <a href="shop-details.php?pid=<?= $fetch_post['id']; ?>"
                                            class="h3 text-decoration-none">
                                            <?= $fetch_post['name']; ?>
                                        </a>
                                        <p class="py-2">
                                            Posted on :
                                            <span class="list-inline-item text-dark">
                                                <?= $fetch_post['created_at']; ?>
                                            </span>
                                        </p>
                                       
                                        
                                    </div>


                                </div>

                        </div>
                        </form>
                        <?php
                    }
                } else {
                    echo '<p class="empty">No posts found for the selected category!</p>';
                }

                ?>




            </div>

        </div>

    </div>
</div>
<!-- End Content -->

<section class="bg-light py-5">
    <div class="container my-4">

    </div>
</section>

<!-- Start Footer -->
<?php include 'components/footer.php'; ?>
</body>

</html>