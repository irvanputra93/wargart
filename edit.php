<?php
// edit.php
include 'koneksi.php'; // Sertakan file koneksi database [cite: 27]

$message = "";
$warga = null;

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $sql = "SELECT * FROM warga WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $warga = $result->fetch_assoc(); // Data sudah terisi sesuai data sebelumnya [cite: 23]
    } else {
        $message = "Data warga tidak ditemukan.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    $nama_lengkap = $conn->real_escape_string($_POST['nama_lengkap']);
    $nomor_kk = $conn->real_escape_string($_POST['nomor_kk']);
    $nik = $conn->real_escape_string($_POST['nik']);
    $alamat = $conn->real_escape_string($_POST['alamat']);
    $status = $conn->real_escape_string($_POST['status']);
    $iuran = isset($_POST['iuran']) ? (int)$_POST['iuran'] : 0;

    $sql = "UPDATE warga SET 
            nama_lengkap = '$nama_lengkap', 
            nomor_kk = '$nomor_kk', 
            nik = '$nik', 
            alamat = '$alamat', 
            status = '$status',
            iuran = '$iuran'
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        $message = "Data warga berhasil diperbarui.";
        // Redirect kembali ke index.php dengan pesan sukses
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
    <title>Edit Data Warga</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        [cite_start]<h2>Edit Data Warga</h2> [cite: 81]

        <?php if ($message): ?>
            <p style="color: green; text-align: center;"><?php echo $message; ?></p>
        <?php endif; ?>

        <?php if ($warga): ?>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($warga['id']); ?>">
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap:</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?php echo htmlspecialchars($warga['nama_lengkap']); ?>" required>
            </div>
            <div class="form-group">
                <label for="nomor_kk">Nomor KK:</label>
                <input type="text" id="nomor_kk" name="nomor_kk" value="<?php echo htmlspecialchars($warga['nomor_kk']); ?>" required>
            </div>
            <div class="form-group">
                <label for="nik">NIK:</label>
                <input type="text" id="nik" name="nik" value="<?php echo htmlspecialchars($warga['nik']); ?>" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <textarea id="alamat" name="alamat" required><?php echo htmlspecialchars($warga['alamat']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="Kepala Keluarga" <?php echo ($warga['status'] == 'Kepala Keluarga') ? 'selected' : ''; ?>>Kepala Keluarga</option>
                    <option value="Anggota Keluarga" <?php echo ($warga['status'] == 'Anggota Keluarga') ? 'selected' : ''; ?>>Anggota Keluarga</option>
                </select>
            </div>
            <div class="form-group">
                <label for="iuran">Iuran (Rp):</label>
                <input type="text" id="iuran" name="iuran" value="<?php echo htmlspecialchars($warga['iuran']); ?>" pattern="[0-9]*" title="Hanya angka diperbolehkan">
            </div>
            [cite_start]<button type="submit" class="btn btn-success btn-block">Simpan Perubahan</button> [cite: 23]
            <p class="text-center"><a href="index.php" class="btn btn-secondary">Kembali</a></p>
        </form>
        <?php else: ?>
            <p class="text-center">Data warga tidak ditemukan atau ID tidak valid.</p>
            <p class="text-center"><a href="index.php" class="btn btn-secondary">Kembali ke Daftar Warga</a></p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>