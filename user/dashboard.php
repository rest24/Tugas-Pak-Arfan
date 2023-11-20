<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'user') {
    header('location: ../login.php');
    exit();
}

include('../includes/db.php');

$result = null; // Inisialisasi variabel $result

$sql = "SELECT * FROM barang";
$result = $conn->query($sql);

if (!$result || $result->num_rows === 0) {
    echo "<p>Tidak ada barang.</p>";
} else {
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="../css/customer-style.css">
</head>

<body>
    <div class="container">
        <h1>Selamat datang Customer..!!</h1>
        <div class="card-container">
            <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='card'>
                            <h3>" . $row['nama_barang'] . "</h3>
                            <p>Deskripsi: " . $row['deskripsi'] . "</p>
                            <p>Harga: Rp. " . $row['harga'] . "</p>
                            <p>Stok: " . $row['stok'] . " Unit</p>
                            <div class='action-buttons'>
                                <a href='customer_dashboard.php?id=".$row['id'] . "' class='btn btn-buy'>Beli</a> <br> <br> 
                                <a href='#' class='btn btn-cart'>Masukkan ke Keranjang</a>
                            </div>
                        </div>";
                }
            ?>
        </div> <br>
        <a href="../logout.php">Logout</a>
    </div>
</body>

</html>
<?php
} // Menutup blok else
?>
