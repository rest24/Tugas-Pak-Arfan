<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    header('location: ../login.php');
    exit();
}

include('../includes/db.php');

// Memeriksa apakah parameter ID barang telah diberikan
if (isset($_GET['id'])) {
    $barang_id = $_GET['id'];

    // Memeriksa data barang berdasarkan ID
    $sql = "SELECT * FROM barang WHERE id = $barang_id";
    $result = $conn->query($sql);

    // Memeriksa apakah data barang ditemukan
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nama_barang = $row['nama_barang'];
        $deskripsi = $row['deskripsi'];
        $harga = $row['harga'];
        $stok = $row['stok'];
    } else {
        echo "Barang tidak ditemukan.";
        exit();
    }
} else {
    echo "ID barang tidak tersedia.";
    exit();
}

// Memeriksa apakah form disubmit untuk menyimpan perubahan
if (isset($_POST['submit'])) {
    $nama_barang = $_POST['nama_barang'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Query untuk mengupdate data barang
    $sql = "UPDATE barang SET nama_barang='$nama_barang', deskripsi='$deskripsi', harga='$harga', stok='$stok' WHERE id='$barang_id'";
    $result = $conn->query($sql);

    if ($result) {
        header('location: dashboard.php');
    } else {
        $error = "Gagal mengedit barang.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>
    <link rel="stylesheet" href="../css/admin-style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding-top: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .btn {
            text-decoration: none;
            padding: 10px 15px;
            background-color: #428bca;
            color: #fff;
            border-radius: 4px;
        }

        .btn:hover {
            background-color: #3071a9;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Edit Barang</h1>
        <form method="post" action="">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" value="<?php echo $nama_barang; ?>" required><br><br>

            <label>Deskripsi</label>
            <textarea name="deskripsi" required><?php echo $deskripsi; ?></textarea><br><br>

            <label>Harga</label>
            <input type="text" name="harga" value="<?php echo $harga; ?>" required><br><br>

            <label>Stok</label>
            <input type="text" name="stok" value="<?php echo $stok; ?>" required><br><br>

            <input type="submit" name="submit" value="Simpan Perubahan" class="btn">
        </form>
        <a href="dashboard.php">Kembali ke Dashboard</a> <br>
        <a href="../logout.php">Logout</a>
    </div>
</body>

</html>
