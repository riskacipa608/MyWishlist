<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "database.php";

// Jika form dikirim
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $judul = $_POST['judul'];
    $target = $_POST['target'];
    $user_id = $_SESSION['user_id'];

    mysqli_query($conn, "INSERT INTO wishlist (user_id, judul, target, terkumpul) VALUES ($user_id, '$judul', $target, 0)");

    header("Location: wishlist.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Wishlist</title>
    <link rel="stylesheet" href="form.css">
</head>

<body>

    <div class="container">
        <div class="form-box">
            <h2>Tambah Wishlist ✨</h2>

            <form action="" method="POST">

                <label>Judul Wishlist</label>
                <input type="text" name="judul">

                <label>Target (Rp)</label>
                <input type="number" name="target">

                <button type="submit">Simpan</button>
                <a href="wishlist.php" class="back">Kembali</a>

            </form>
        </div>
    </div>

</body>
</html>