<?php
require_once 'proteksi.php';
require_once 'koneksi.php';

include 'header.php';

$query = mysqli_query($conn, "SELECT * FROM produk ORDER BY id DESC");
?>

<style>
    .kelola {
        text-align: center;
        font-family: "Times New Roman";
    }

    .aksi {
        margin: 20px;
    }

    .aksi a {
        margin: 0 15px;
    }

    table {
        margin: auto;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid black;
        padding: 10px;
    }
</style>

<div class="kelola">

    <h2>Kelola Produk</h2>

    <div class="aksi">
        <a href="produk.php">Lihat Katalog</a>
        <a href="tambah.php">Tambah Produk</a>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>

        <?php $no = 1; while ($p = mysqli_fetch_assoc($query)): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $p['nama_produk']; ?></td>
            <td><?= $p['kategori']; ?></td>
            <td><?= $p['harga']; ?></td>
            <td><?= $p['stok']; ?></td>
            <td>
                <a href="edit.php?id=<?= $p['id']; ?>">Edit</a>
                <a href="hapus.php?id=<?= $p['id']; ?>"
                   onclick="return confirm('Hapus produk?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</div>

<?php include 'footer.php'; ?>