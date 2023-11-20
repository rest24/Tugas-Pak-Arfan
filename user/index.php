<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'user') {
    header('location: ../login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Area</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <h1>Selamat datang, <?php echo $_SESSION['username']; ?> (User)</h1>
        <a href="../logout.php">Logout</a>
    </div>
</body>

</html>
