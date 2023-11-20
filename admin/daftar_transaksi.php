<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    header('location: ../login.php');
    exit();
}

include('../includes/db.php');

$sql = "SELECT transaksi.*, users.username FROM transaksi
        INNER JOIN users ON transaksi.id_user = users.id ORDER BY transaksi.tanggal DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Semua Transaksi</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* Sesuaikan dengan gaya CSS yang Anda inginkan */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: auto;
            padding-top: 20px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Daftar Semua Transaksi</h2>
        <table>
            <thead>
                <tr>
                    <th>Tanggal Transaksi</th>
                    <th>ID Transaksi</th>
                    <th>ID Barang</th>
                    <th>ID User</th>
                    <th>Username Pembeli</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <!-- Tambah kolom lain sesuai kebutuhan -->
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['tanggal'] . "</td>
                                <td>" . $row['id_transaksi'] . "</td>
                                <td>" . $row['id_barang'] . "</td>
                                <td>" . $row['id_user'] . "</td>
                                <td>" . $row['username'] . "</td>
                                <td>" . $row['nama_barang'] . "</td>
                                <td>Rp. " . $row['harga'] . "</td>
                                <!-- Tambah kolom lain sesuai kebutuhan -->
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Tidak ada transaksi.</td></tr>";
                }
                ?>
            </tbody>
        </table> <br>
        <a href="dashboard.php">Kembali ke Dashboard</a>
    </div>
</body>

</html>
