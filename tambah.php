<?php
include 'koneksi.php';
$pesan = '';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_produk'];
    $kategori = $_POST['kategori'];
    $harga = (int)$_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $stok = (int)$_POST['stok'];

    $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
    $foto = uniqid().'.'.$ext;

    if (in_array($ext, ['jpg','jpeg','png','webp']) &&
        getimagesize($_FILES['foto']['tmp_name'])) {

        if (!is_dir('uploads')) mkdir('uploads');

        if (move_uploaded_file($_FILES['foto']['tmp_name'], 'uploads/'.$foto)) {

            $stmt = mysqli_prepare($conn, "INSERT INTO produk (nama_produk,kategori,harga,deskripsi,stok,foto) VALUES (?,?,?,?,?,?)");
            mysqli_stmt_bind_param($stmt, "ssisis", $nama, $kategori, $harga, $deskripsi, $stok, $foto);

            if (mysqli_stmt_execute($stmt)) {
                header('Location: index.php');
                exit;
            } else {
                $pesan = 'Gagal menyimpan produk.';
            }
        }
    } else {
        $pesan = 'Foto tidak sesuai.';
    }
}

include 'header.php';
?>

<style>
body {
    text-align: center;
}

.form-box {
    width: 400px;
    max-width: 100%;
    margin: auto;
}

label {
    display: block;
}

input, textarea {
    width: 100%;
    padding: 5px;
    margin: 5px 0 10px;
    box-sizing: border-box;
}
</style>

<div class="form-box">
    <h2>Tambah Produk</h2>
    <p><?= htmlspecialchars($pesan) ?></p>

    <form method="POST" enctype="multipart/form-data">

        <label>Nama Produk</label>
        <input name="nama_produk" required>

        <label>Kategori</label>
        <input name="kategori" required>

        <label>Harga</label>
        <input type="number" name="harga" min="0" required>

        <label>Deskripsi</label>
        <textarea name="deskripsi" required></textarea>

        <label>Stok</label>
        <input type="number" name="stok" value="0" min="0" required>

        <label>Foto Produk</label>
        <input type="file" name="foto" accept=".jpg,.jpeg,.png,.webp" required>

        <button name="simpan">Simpan Produk</button>
    </form>

    <p><a href="index.php">Kembali ke Katalog</a></p>
</div>

<?php include 'footer.php'; ?>