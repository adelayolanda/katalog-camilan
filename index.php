<?php
require_once "koneksi.php";
require_once "functions.php";
include "header.php";

$query = mysqli_query($conn, "SELECT * FROM produk ORDER BY id DESC");
?>

<style>
    body {
        text-align: center;
        font-family: "Times New Roman";
    }

    .daftar {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
    }

    .produk {
        width: 200px;
        padding: 10px;
        border: 1px solid black;
    }

    .produk img {
        width: 100%;
        height: 140px;
        object-fit: cover;
    }
</style>

<h1>Katalog Camilan</h1>
<p>Jajanan enak di sekitar sekolah</p>

<h2><?= sapaan_waktu() ?>, selamat datang di Katalog Camilan!</h2>

<h2>Daftar Jajanan</h2>
<p>Silakan lihat pilihan makanan dan minuman kami.</p>

<div class="daftar">
    <?php while ($row = mysqli_fetch_assoc($query)) { ?>
        <div class="produk">
            <?php
            $foto = $row['foto'] ?? '';
            $lokasi = 'uploads/' . basename($foto);

            if ($foto && is_file($lokasi)) {
            ?>
                <img src="<?= htmlspecialchars($lokasi) ?>">
            <?php } ?>

            <h3><?= htmlspecialchars($row['nama_produk']) ?></h3>

            <p><?= htmlspecialchars($row['deskripsi'] ?? '') ?></p>

            <b>Rp<?= number_format((int)$row['harga'], 0, ',', '.') ?></b>

            <p>Stok: <?= (int)($row['stok'] ?? 0) ?></p>
        </div>
    <?php } ?>
</div>

<?php include "footer.php"; ?>