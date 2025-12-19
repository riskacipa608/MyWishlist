<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "database.php";
$user_id = $_SESSION['user_id'];

// Ambil email user
$u = mysqli_query($conn, "SELECT * FROM users WHERE id=$user_id");
$user = mysqli_fetch_assoc($u);

// Ambil data wishlist milik user
$w = mysqli_query($conn, "SELECT * FROM wishlist WHERE user_id=$user_id");

$total_target = 0;
$total_terkumpul = 0;
$jumlah = mysqli_num_rows($w);

while ($row = mysqli_fetch_assoc($w)) {
    $total_target += $row['target'];
    $total_terkumpul += $row['terkumpul'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="profile.css">
</head>

<body>

<div class="profile-card">
    <h2>Profil Kamu</h2>
    <p class="email"><?= $user['email'] ?></p>

    <div class="stats">

        <div class="stat-item">
            <div class="stat-icon">📝</div>
            <div class="stat-text">
                <span>Wishlist Dibuat</span>
                <span><?= $jumlah ?></span>
            </div>
        </div>

        <div class="stat-item">
            <div class="stat-icon">🎯</div>
            <div class="stat-text">
                <span>Total Target</span>
                <span>Rp <?= number_format($total_target, 0, ',', '.') ?></span>
            </div>
        </div>

        <div class="stat-item">
            <div class="stat-icon">💰</div>
            <div class="stat-text">
                <span>Total Terkumpul</span>
                <span>Rp <?= number_format($total_terkumpul, 0, ',', '.') ?></span>
            </div>
        </div>

    </div>

    <a href="wishlist.php" class="btn">Kembali</a>
</div>

</body>
</html>