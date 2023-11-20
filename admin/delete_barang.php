<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    header('location: ../login.php');
    exit();
}

include('../includes/db.php');

if (isset($_GET['id'])) {
    $barang_id = $_GET['id'];

    $sql = "DELETE FROM barang WHERE id='$barang_id'";
    $result = $conn->query($sql);

    if ($result) {
        header('location: dashboard.php');
    } else {
        echo "Gagal menghapus barang.";
    }
}
?>
