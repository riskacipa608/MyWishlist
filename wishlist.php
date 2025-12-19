<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <link rel="stylesheet" href="wishlist.css">
</head>

<body>

    <div class="navbar">
        <h2 class="logo">MyWishlist</h2>
        <div class="menu">
            <a href="profile.php">Profil</a>
            <a href="logout.php" class="logout">Logout</a>
        </div>
    </div>

    <div class="container">

        <div class="header">
            <h1>Wishlist Kamu ✨</h1>
            <a href="tambah.php" class="btn-add">+ Tambah Wishlist</a>
        </div>

<div class="wishlist-list">

    <?php
    include "database.php";
    $user_id = $_SESSION['user_id'];

    $data = mysqli_query($conn, "SELECT * FROM wishlist WHERE user_id=$user_id");

    if (mysqli_num_rows($data) === 0) {
        echo "<p style='color:#6c7b8c; font-size:16px;'>Belum ada wishlist. Tambah dulu ya ✨</p>";
    } else {
        while ($row = mysqli_fetch_assoc($data)) {
            $percent = ($row['terkumpul'] / $row['target']) * 100;
            if ($percent > 100) $percent = 100;
            
            echo "
            <div class='card'>
                <h3>{$row['judul']}</h3>
                <p class='target'>Target: Rp " . number_format($row['target'], 0, ',', '.') . "</p>

                <div class='progress'>
                    <div class='bar' style='width: {$percent}%;'></div>
                </div>

                <p class='percent'>" . round($percent) . "% terkumpul</p>
                <div class='actions'>
                    <a href='edit.php?id={$row['id']}' class='edit'>Edit</a>
                    <a href='nabung.php?id={$row['id']}' class='edit'>Nabung</a>
                    <a href='hapus.php?id={$row['id']}' class='delete'>Hapus</a>
                </div>
            </div>
            ";
        }
    }
    ?>

</div>

    </div>

</body>
</html>