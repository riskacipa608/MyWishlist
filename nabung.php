<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "database.php";

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Ambil data wishlist yang mau ditambah nabung
$data = mysqli_query($conn, "SELECT * FROM wishlist WHERE id=$id AND user_id=$user_id");
$wishlist = mysqli_fetch_assoc($data);

if (!$wishlist) {
    echo "Data tidak ditemukan!";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $tambah = $_POST['tambah'];

    // Update total terkumpul
    $baru = $wishlist['terkumpul'] + $tambah;

    mysqli_query($conn, "UPDATE wishlist SET terkumpul=$baru WHERE id=$id");

    header("Location: wishlist.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Nabung</title>
    <link rel="stylesheet" href="form.css">
</head>

<body>

    <div class="container">
        <div class="form-box">
            <h2>Nabung buat: <br> <?= $wishlist['judul'] ?></h2>

            <form action="" method="POST">

                <label>Tambah Nominal (Rp)</label>
                <input type="number" name="tambah">

                <button type="submit">Tambah Nabung</button>
                <a href="wishlist.php" class="back">Kembali</a>

            </form>
        </div>
    </div>

</body>
</html>