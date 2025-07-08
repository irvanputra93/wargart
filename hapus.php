<?php
// hapus.php
include 'koneksi.php'; // Sertakan file koneksi database [cite: 27]

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Konfirmasi penghapusan dilakukan di index.php melalui JavaScript confirm()
    // Jika user mengklik "OK", maka proses hapus akan dilanjutkan di sini.
    $sql = "DELETE FROM warga WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        $message = "Data warga berhasil dihapus.";
    } else {
        $message = "Error menghapus data: " . $conn->error;
    }
    // Redirect kembali ke index.php setelah penghapusan
    header("Location: index.php?message=" . urlencode($message));
    exit();
} else {
    // Jika tidak ada ID yang diberikan, redirect kembali ke index.php
    header("Location: index.php?message=" . urlencode("ID warga tidak ditemukan."));
    exit();
}

$conn->close();
?>