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

<section class=" py-5">
    <div class="container ">
        <div class="row align-items-center py-5 ">
            <div class="col-md-8 ">
                <h1>About Winnipeg Art Gallery</h1>
                <p>
                    Explore the vibrant world of art at Winnipeg Art Gallery's online platform. Immerse yourself in a
                    diverse collection of captivating visuals, showcasing the rich artistic tapestry of our local
                    talents.
                    From awe-inspiring exhibitions to educational resources, we invite you to delve into the heart of
                    art.
                    <br>
                    Delight in our curated categories, each presenting a unique blend of creativity and expression.
                    Discover
                    and acquire your favorite pieces, bringing the spirit of local artistry to your personal space.
                    <br>
                    Join us on this journey of artistic exploration. Elevate your surroundings, support local artists,
                    and
                    experience the joy of connecting with the cultural heritage of Winnipeg.
                </p>

            </div>
            <div class="col-md-4">
                <img src="assets/img/about-hero.jpg" width="100%" alt="About Hero">
            </div>
        </div>
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