<?php
require 'proteksi.php';
include 'koneksi.php';

$id = (int)($_GET['id'] ?? 0);

$query = mysqli_query($conn, "SELECT * FROM produk WHERE id=$id");
$p = mysqli_fetch_assoc($query);

if (!$p) die("Produk tidak ditemukan.");
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    mysqli_query($conn, "UPDATE produk SET
        nama_produk='$nama',
        deskripsi='$deskripsi',
        harga='$harga',
        stok='$stok'
        WHERE id=$id");

    header("Location: kelola.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Produk</title>
<style>
body { text-align:center; }
form { width:400px; max-width:100%; margin:auto; padding:15px; border:1px solid black; box-sizing:border-box; }
input, textarea { width:100%; padding:8px; margin:5px 0; box-sizing:border-box; }
</style>
</head>
<body>

<h2>Edit Produk</h2>
<form method="POST">
Nama Produk
<input name="nama_produk" value="<?= htmlspecialchars($p['nama_produk']) ?>" required>

Deskripsi
<textarea name="deskripsi" required><?= htmlspecialchars($p['deskripsi']) ?></textarea>

Harga
<input type="number" name="harga" value="<?= $p['harga'] ?>" required>

Stok
<input type="number" name="stok" value="<?= $p['stok'] ?>" required>

<button name="simpan">Simpan Perubahan</button>
</form>

<p><a href="kelola.php">Kembali</a></p>
</body>
</html>