<?php
session_start();

include('includes/db.php');

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    $result = $conn->query($sql);

    if ($result) {
        $_SESSION['message'] = "Registrasi berhasil!";
        header('location: login.php');
    } else {
        $error = "Registrasi gagal!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registrasi</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <form method="post" action="">
            <h2>Registrasi</h2>
            <?php if (isset($error)) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username">
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password">
            </div>
            <div class="input-group">
                <button type="submit" class="btn" name="register">Daftar</button>
            </div>
            <p>Sudah punya akun? <a href="login.php">Login disini</a></p>
        </form>
    </div>
</body>

</html>
