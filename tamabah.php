<?php
// tambah.php
include 'koneksi.php'; // Sertakan file koneksi database [cite: 27]

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_lengkap = $conn->real_escape_string($_POST['nama_lengkap']); // Nama lengkap [cite: 11]
    $nomor_kk = $conn->real_escape_string($_POST['nomor_kk']);     // Nomor KK [cite: 12]
    $nik = $conn->real_escape_string($_POST['nik']);               // NIK [cite: 13]
    $alamat = $conn->real_escape_string($_POST['alamat']);         // Alamat [cite: 14]
    $status = $conn->real_escape_string($_POST['status']);         // Status [cite: 15]
    $iuran = isset($_POST['iuran']) ? (int)$_POST['iuran'] : 0; // Kolom iuran

    $sql = "INSERT INTO warga (nama_lengkap, nomor_kk, nik, alamat, status, iuran) VALUES ('$nama_lengkap', '$nomor_kk', '$nik', '$alamat', '$status', '$iuran')";

    if ($conn->query($sql) === TRUE) {
        $message = "Data warga berhasil ditambahkan."; // Data masuk ke database setelah disimpan [cite: 16]
        // Redirect untuk mencegah resubmission form
        header("Location: index.php?message=" . urlencode($message));
        exit();
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Warga</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        [cite_start]<h2>Tambah Data Warga</h2> [cite: 77]

        <?php if ($message): ?>
            <p style="color: green; text-align: center;"><?php echo $message; ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap:</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" required>
            </div>
            <div class="form-group">
                <label for="nomor_kk">Nomor KK:</label>
                <input type="text" id="nomor_kk" name="nomor_kk" required>
            </div>
            <div class="form-group">
                <label for="nik">NIK:</label>
                <input type="text" id="nik" name="nik" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <textarea id="alamat" name="alamat" required></textarea>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    [cite_start]<option value="Kepala Keluarga">Kepala Keluarga</option> [cite: 15]
                    [cite_start]<option value="Anggota Keluarga">Anggota Keluarga</option> [cite: 15]
                </select>
            </div>
            <div class="form-group">
                <label for="iuran">Iuran (Rp):</label>
                <input type="text" id="iuran" name="iuran" value="0" pattern="[0-9]*" title="Hanya angka diperbolehkan">
            </div>
            [cite_start]<button type="submit" class="btn btn-success btn-block">Simpan</button> [cite: 79]
            <p class="text-center"><a href="index.php" class="btn btn-secondary">Kembali</a></p>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>