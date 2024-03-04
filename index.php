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

<!-- Start Banner Hero -->
<div id="captures-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#captures-hero-carousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#captures-hero-carousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#captures-hero-carousel" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">

        <div class="carousel-item active">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="./assets/img/banner_img_03.jpg" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h3 class="h2">Explore the Timeless Beauty of Winnipeg Art Gallery</h3>
                            <p>
                                Welcome to our virtual art haven, where you can immerse yourself in a curated collection
                                capturing the essence and rich cultural history of the Winnipeg Art Gallery. Browse and
                                acquire your preferred artworks, bringing the spirit of local artists into your space.
                                Revel
                                in a distinctive art discovery!
                            </p>

                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="./assets/img/banner_img_03.jpg" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h3 class="h2">Explore the Timeless Beauty of Winnipeg Art Gallery</h3>
                            <p>
                                Welcome to our virtual art haven, where you can immerse yourself in a curated collection
                                capturing the essence and rich cultural history of the Winnipeg Art Gallery. Browse and
                                acquire your preferred artworks, bringing the spirit of local artists into your space.
                                Revel
                                in a distinctive art discovery!
                            </p>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Banner Hero -->


<section class="container py-5">
    <div class="row text-center pt-3">
        <div class="col-lg-6 m-auto">
            <h1 class="h1">Discover Artistic Categories</h1>
            <p>
                Immerse yourself in our thoughtfully curated assortment of top categories, showcasing
                captivating artworks from the Winnipeg Art Gallery's diverse collection.
            </p>

        </div>


    </div>
    <div class="row">
        <div class="col-12 col-md-4 p-4 mt-3">
            <a href="shop.php"><img src="./assets/img/historical.jpg" class="rounded-circle img-fluid border"></a>
            <h5 class="text-center mt-3 mb-3">Historical Moments</h5>

        </div>
        <div class="col-12 col-md-4 p-4 mt-3">
            <a href="shop.php"><img src="./assets/img/seasonal.jpg" class="rounded-circle img-fluid border"></a>
            <h2 class="h5 text-center mt-3 mb-3">Seasonal Changes</h2>

        </div>
        <div class="col-12 col-md-4 p-4 mt-3">
            <a href="shop.php"><img src="./assets/img/cultural.jpg" class="rounded-circle img-fluid border"></a>
            <h2 class="h5 text-center mt-3 mb-3">Cultural Events</h2>

        </div>
    </div>
</section>

<section class="bg-light">
    <div class="container py-5">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Featured Art of the Week</h1>
                <p>
                    Begin your art exploration today and enhance your surroundings with the distinctive pieces
                    from the Winnipeg Art Gallery's collection!
                </p>

            </div>

        </div>
        <div class="row">
            <?php
            $select_posts = $conn->prepare("SELECT * FROM `posts` Limit 3 ");
            $select_posts->execute();
            if ($select_posts->rowCount() > 0) {
                while ($fetch_post = $select_posts->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class="col-md-4">

                        <form action="" method="post" class="box">
                            <div class="card mb-4 product-wap rounded-0">
                                <div class="card rounded-0">
                                    <img class="card-img rounded-0 img-fluid" src="upload/<?= $fetch_post['image']; ?>"
                                        style="height:40vh; width:100%">
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
                                    <a href="shop-details.php?pid=<?= $fetch_post['id']; ?>" class="h3 text-decoration-none">
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
                echo '<p class="empty">no posts found!</p>';
            }
            ?>




        </div>
    </div>
</section>



<!-- Start Footer -->
<?php include 'components/footer.php'; ?>
</body>

</html>