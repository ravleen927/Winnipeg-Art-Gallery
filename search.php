<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}
;
if (isset($_GET['query'])) {
   
    $searchQuery = htmlspecialchars($_GET['query']);

    
    $stmt = $conn->prepare("SELECT * FROM posts WHERE name LIKE :query OR description LIKE :query");
    $stmt->execute(['query' => "%$searchQuery%"]);

   
    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
} 

?>


    <?php include 'components/user_header.php'; ?>

    <section >
        <div class="container py-5">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                <h1>Search Results</h1>
                    
                </div>

            </div>
            <div class="row">
            <?php if (isset($searchResults) && !empty($searchResults)) : ?>
            <?php foreach ($searchResults as $fetch_post) : ?>
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
                                                        href="shop-details.php?pid=<?= $fetch_post['id']; ?>"><i
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
                        <?php endforeach; ?>
            <?php else : ?>
            <p>No results found.</p>
        <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="bg-light py-5">
    <div class="container my-4">

    </div>
</section>
<section class="bg-light py-5">
    <div class="container my-4">

    </div>
</section>
    <!-- Start Footer -->
    <?php include 'components/footer.php'; ?>
</body>

</html>