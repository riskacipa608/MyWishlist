<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "database.php";

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

mysqli_query($conn, "DELETE FROM wishlist WHERE id=$id AND user_id=$user_id");

// Kembali ke wishlist
header("Location: wishlist.php");
exit();
?>