<?php
include "database.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
    mysqli_query($conn, $query);

    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="login-box">
        <h2>Daftar Akun</h2>

        <form action="register.php" method="POST">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Masukkan email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password" required>
            </div>

            <button type="submit">Daftar</button>

            <p class="register">Sudah punya akun? <a href="login.php">Login</a></p>
        </form>
    </div>

</body>
</html>