<?php
include 'koneksi.php';

$query = "SELECT * FROM warga";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Warga RT</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Daftar Warga RT</h1>

    <p><a href="tambah.php" class="btn btn-primary">+ Tambah Warga</a></p>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Nama</th>
            <th>NIK</th>
            <th>Alamat</th>
            <th>Status</th>
            <th>Iuran (Rp)</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['nama']); ?></td>
                <td><?php echo htmlspecialchars($row['nik']); ?></td>
                <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                <td><?php echo htmlspecialchars($row['status']); ?></td>
                <td><?php echo number_format($row['iuran'], 0, ',', '.'); ?></td>
                <td>
                    <?php
                    echo "<a href='edit.php?id=" . $row['id'] . "' class='btn btn-info btn-sm'>Edit</a> ";
                    echo "<a href='hapus.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?');\">Hapus</a>";
                    ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
