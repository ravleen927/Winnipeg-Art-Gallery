
<?php
$host = 'localhost';
$db_name = 'captures';
$user_name = 'wag'; 
$user_password = '';

$dsn = "mysql:host=$host;dbname=$db_name;charset=utf8mb4";

try {
    $conn = new PDO($dsn, $user_name, $user_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
