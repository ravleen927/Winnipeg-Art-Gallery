<?php
include('components/connect.php');

$_SESSION = array();

session_destroy();

header("Location: ../index.php");
exit();
?>
