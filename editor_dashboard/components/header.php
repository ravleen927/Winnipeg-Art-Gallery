<?php


if (isset($_SESSION['user_id'])) {

    $userId = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($user && $user['role'] === 'admin') {
        $dashboardLink = '<li><a href="dashboard/index.php">Dashboard</a></li>';
    } else {


        $dashboardLink = '<li><a href="logout.php">Logout</a></li>';
    }
} else {

    $dashboardLink = '<li><a href="register.php">Sign Up</a></li>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winnipeg Art Gallery</title>
    <!-- Box-icon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>

<body>
    <header>
        <div class="logo">
            <h1 class="logo-text"><a href="index.php">Winnipeg Art Gallery</a></h1>
        </div>
        
        <ul class="nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="arts.php">Arts</a></li>
            <li><a href="about_us.php">About Us</a></li>
            <?php echo $dashboardLink; ?>
        </ul>
    </header>