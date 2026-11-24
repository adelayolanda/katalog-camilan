<?php
require_once 'koneksi.php';
$query = mysqli_query($conn, "SELECT * FROM produk");
include 'header.php';
?>

<style>
body {
    text-align: center;
}

table {
    margin: auto;
}
</style>

<h3>Katalog Produk</h3>

<a href="tambah.php">+ Tambah Produk</a>

<br><br>

<table border="1" cellpadding="10">
<tr>
    <th>Nama Produk</th>
    <th>Harga</th>
    <th>Deskripsi</th>
</tr>

<?php while ($produk = mysqli_fetch_assoc($query)) { ?>
<tr>
    <td><?= $produk['nama_produk'] ?></td>
    <td>Rp<?= $produk['harga'] ?></td>
    <td><?= $produk['deskripsi'] ?></td>
</tr>
<?php } ?>

</table>

<?php include 'footer.php'; ?>