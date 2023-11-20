<?php
session_start();

include('../includes/db.php');

if (isset($_GET['id'])) {
    $barang_id = $_GET['id'];

    $sql = "SELECT * FROM barang WHERE id = $barang_id";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $stok_sekarang = $row['stok'];
        $nama_barang = $row['nama_barang'];
        $harga_barang = $row['harga'];

        if ($stok_sekarang > 0) {
            $stok_baru = $stok_sekarang - 1; // Mengurangi stok sebanyak 1 unit

            // Update stok di database
            $update_sql = "UPDATE barang SET stok = $stok_baru WHERE id = $barang_id";
            $update_result = $conn->query($update_sql);

            if ($update_result) {
                $id_barang_dibeli = $barang_id;
                $id_user = $_SESSION['id'];
                $tanggal = date("Y-m-d H:i:s"); // Waktu transaksi

                // Memasukkan data transaksi ke tabel transaksi
                $transaksi_sql = "INSERT INTO transaksi (id_barang, id_user, nama_barang, harga, tanggal) VALUES ($id_barang_dibeli, $id_user, '$nama_barang', $harga_barang, '$tanggal')";
                $transaksi_result = $conn->query($transaksi_sql);

                if ($transaksi_result) {
                    header('Location: daftar_transaksi.php');
                    exit();
                } else {
                    echo "Gagal menambahkan transaksi.";
                }
            } else {
                echo "Gagal memperbarui stok barang.";
            }
        } else {
            echo "Stok barang habis.";
        }
    } else {
        echo "Barang tidak ditemukan.";
    }
}
?>
