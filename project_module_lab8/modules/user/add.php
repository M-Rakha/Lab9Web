<?php

include __DIR__ . '/../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $harga_beli = (float)$_POST['harga_beli'];
    $harga_jual = (float)$_POST['harga_jual'];
    $stok = (int)$_POST['stok'];

    $gambar_nama = '';
    if (!empty($_FILES['gambar']['name'])) {
        $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $gambar_nama = uniqid('img_') . '.' . $ext;
        move_uploaded_file($_FILES['gambar']['tmp_name'], __DIR__ . '/../../uploads/' . $gambar_nama);
    }

    $sql = "INSERT INTO data_barang (kategori, nama, gambar, harga_beli, harga_jual, stok) VALUES ('{$kategori}','{$nama}','{$gambar_nama}','{$harga_beli}','{$harga_jual}','{$stok}')";
    if (mysqli_query($koneksi, $sql)) {
        header('Location: index.php?page=user/list');
        exit;
    } else {
        echo '<p class="error">Gagal simpan: ' . mysqli_error($koneksi) . '</p>';
    }
}
?>

<h2>Tambah Barang</h2>
<form method="post" enctype="multipart/form-data">
    <label>Nama Barang<br><input type="text" name="nama" required></label><br>
    <label>Kategori<br><input type="text" name="kategori" required></label><br>
    <label>Gambar<br><input type="file" name="gambar" accept="image/*"></label><br>
    <label>Harga Beli<br><input type="number" name="harga_beli" required></label><br>
    <label>Harga Jual<br><input type="number" name="harga_jual" required></label><br>
    <label>Stok<br><input type="number" name="stok" required></label><br>
    <button type="submit">Simpan</button>
</form>
<p><a href="index.php?page=user/list">Kembali ke daftar</a></p>