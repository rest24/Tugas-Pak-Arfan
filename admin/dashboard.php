<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    header('location: ../login.php');
    exit();
}

include('../includes/db.php');

$sql = "SELECT * FROM barang";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Seller Dashboard</title>
    <link rel="stylesheet" href="../css/admin-style.css">
</head>

<body>
    <div class="container">
        <h1>Selamat datang Seller..!!</h1>
        <a href="daftar_transaksi.php" class="btn">Daftar Semua Transaksi</a>
        <h2>Daftar Barang</h2>
        <a href="add_barang.php" class="btn">Tambah Barang Baru</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['nama_barang'] . "</td>
                                <td>" . $row['deskripsi'] . "</td>
                                <td>Rp. " . $row['harga'] . "</td>
                                <td>" . $row['stok'] . " Unit</td>
                                <td>
                                    <a href='edit_barang.php?id=" . $row['id'] . "' class='btn'>Edit</a>
                                    <a href='delete_barang.php?id=" . $row['id'] . "' class='btn btn-danger'>Hapus</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Tidak ada barang.</td></tr>";
                }
                ?>
            </tbody>
        </table> <br>
        <a href="../logout.php">Logout</a>
    </div>
</body>

</html>
