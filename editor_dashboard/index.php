<?php
include('components/connect.php');

// Count users
$stmt = $pdo->query("SELECT COUNT(*) FROM users");
$userCount = $stmt->fetchColumn();

// Count comments
$stmt = $pdo->query("SELECT COUNT(*) FROM orders");
$ordersCount = $stmt->fetchColumn();

// Count published arts
$stmt = $pdo->query("SELECT COUNT(*) FROM posts");
$publishedArtCount = $stmt->fetchColumn();
?>

<?php include('components/admin_header.php'); ?>

<div class="main-container">
    <div class="navcontainer">
        <?php include('components/sidebar.php'); ?>
    </div>
    <div class="main">



        <div class="box-container">
            <div class="box box1">
                <div class="text">
                    <h2 class="topic-heading">
                        <?= $userCount ?>
                    </h2>
                    <h2 class="topic">Users</h2>
                </div>
                <h2 class="text"><i class="fa fa-user"></i></h2>
            </div>

            <div class="box box3">
                <div class="text">
                    <h2 class="topic-heading">
                        <?= $ordersCount ?>
                    </h2>
                    <h2 class="topic">Orders</h2>
                </div>
                <h2 class="text"><i class="fa fa-list"></i></h2>
            </div>

            <div class="box box4">
                <div class="text">
                    <h2 class="topic-heading">
                        <?= $publishedArtCount ?>
                    </h2>
                    <h2 class="topic">Published</h2>
                </div>
                <h2 class="text"><i class="fa fa-check"></i></h2>
            </div>
        </div>

    </div>
</div>

<script src="script.js"></script>
</body>

</html>