<?php
session_start();

include('../includes/db.php');

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'user') {
    header('location: ../login.php');
    exit();
}

// Query untuk mengambil data transaksi untuk pengguna tertentu
$id_user = $_SESSION['id'];
$sql_transaksi = "SELECT transaksi.id_transaksi, transaksi.tanggal, transaksi.id_barang, barang.nama_barang, barang.harga 
                  FROM transaksi 
                  INNER JOIN barang ON transaksi.id_barang = barang.id
                  WHERE transaksi.id_user = $id_user 
                  ORDER BY transaksi.tanggal DESC";
$result_transaksi = $conn->query($sql_transaksi);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Transaksi</title>
    <link rel="stylesheet" href="../css/style.css">
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

        a {
            display: block;
            margin-top: 20px;
            text-align: center;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Daftar Transaksi</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Tanggal Transaksi</th>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_transaksi->num_rows > 0) {
                    while ($row = $result_transaksi->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['id_transaksi'] . "</td>
                                <td>" . $row['tanggal'] . "</td>
                                <td>" . $row['id_barang'] . "</td>
                                <td>" . $row['nama_barang'] . "</td>
                                <td>Rp. " . $row['harga'] . "</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada transaksi.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="dashboard.php">Kembali ke Dashboard</a>
    </div>
</body>

</html>
