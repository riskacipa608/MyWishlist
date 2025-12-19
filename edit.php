<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "database.php";

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Ambil data wishlist yang mau diedit
$data = mysqli_query($conn, "SELECT * FROM wishlist WHERE id=$id AND user_id=$user_id");
$wishlist = mysqli_fetch_assoc($data);

// Jika datanya tidak ada
if (!$wishlist) {
    echo "Data tidak ditemukan!";
    exit();
}

// Jika form dikirim
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $judul = $_POST['judul'];
    $target = $_POST['target'];

    mysqli_query($conn, "UPDATE wishlist SET judul='$judul', target=$target WHERE id=$id");

    header("Location: wishlist.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Wishlist</title>
    <link rel="stylesheet" href="form.css">
</head>

<body>

    <div class="container">
        <div class="form-box">
            <h2>Edit Wishlist ✏</h2>

            <form action="" method="POST">

                <label>Judul Wishlist</label>
                <input type="text" name="judul" value="<?= $wishlist['judul'] ?>" required>

                <label>Target (Rp)</label>
                <input type="number" name="target" value="<?= $wishlist['target'] ?>" required>

                <button type="submit">Simpan Perubahan</button>
                <a href="wishlist.php" class="back">Kembali</a>

            </form>
        </div>
    </div>

</body>
</html>