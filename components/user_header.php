
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Winnipeg Art Gallery</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/wag.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
</head>

<body>
    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '
         <div class="message text-center">
            <span>' . $message . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
        }
    }
    ?>
    <!-- Start Top Nav -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="captures_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between ">
                <div class="mt-2">
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none"
                        href="mailto:info@company.com">info@winnipegartgallery.com</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:010-020-0340">010-020-0340</a>
                </div>
                <div>
                    <div class=" flex-sm-fill mt-1 mb-1 col-7 col-sm-auto pr-3">
                        <form action="search.php" method="GET">
                            <div class="input-group">
                                <input type="text" name="query" class="form-control" id="inputMobileSearch"
                                    placeholder="Type something ..." required>
                                <div>
                                    <button type="submit" class="btn-success input-group-text">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->


    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h2 align-self-center" href="index.php">
            Winnipeg Art Gallery
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#captures_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class=" collapse navbar-collapse flex-fill   "
                id="captures_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav   mx-lg-auto">
                        
                        <li class="nav-item">
                            <a class="nav-link" href="posts.php">Published</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About Us</a>
                        </li>


                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    
                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                    <form action="search.php" method="GET">
                        <div class="input-group">
                            <input type="text" name="query" class="form-control" id="inputMobileSearch"
                                placeholder="Type something ..." required>
                            <div >
                            <button type="submit" class="btn-secondary input-group-text">Search</button>
                            </div>
                        </div>
                    </form>
                    </div>


                    
                    <?php
                    $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                    $select_profile->execute([$user_id]);
                    if ($select_profile->rowCount() > 0) {
                        $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                        ?>
                        
                        <a class="nav-icon position-relative text-decoration-none" href="update_user.php">
                            <i class="fa fa-fw fa-arrow-down text-dark mr-3"></i>
                            <span
                                class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">
                                <?= $fetch_profile["name"]; ?>
                            </span>

                        </a>
                        <a class="nav-icon position-relative text-decoration-none text-danger"
                            href="components/user_logout.php">
                            Logout
                        </a>

                        <?php
                    } else {
                        ?>
                        <a class="nav-icon position-relative text-decoration-none" href="user_login.php">
                            <i class="fa fa-fw fa-user text-dark mr-3"></i>

                        </a>
                        <?php
                    }
                    ?>
                </div>
            </div>

        </div>
    </nav>
    <!-- Close Header -->