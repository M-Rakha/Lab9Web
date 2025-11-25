<?php

include __DIR__ . '/../../config/database.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    echo '<p>Id tidak valid</p>';
    return;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $harga_beli = (float)$_POST['harga_beli'];
    $harga_jual = (float)$_POST['harga_jual'];
    $stok = (int)$_POST['stok'];

    $res0 = mysqli_query($koneksi, "SELECT gambar FROM data_barang WHERE id_barang={$id}");
    $row0 = mysqli_fetch_assoc($res0);
    $gambar_nama = $row0['gambar'];

    if (!empty($_FILES['gambar']['name'])) {

        if (!empty($gambar_nama) && file_exists(__DIR__ . '/../../uploads/' . $gambar_nama)) {
            @unlink(__DIR__ . '/../../uploads/' . $gambar_nama);
        }
        $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $gambar_nama = uniqid('img_') . '.' . $ext;
        move_uploaded_file($_FILES['gambar']['tmp_name'], __DIR__ . '/../../uploads/' . $gambar_nama);
    }

    $sql = "UPDATE data_barang SET kategori='{$kategori}', nama='{$nama}', gambar='{$gambar_nama}', harga_beli='{$harga_beli}', harga_jual='{$harga_jual}', stok='{$stok}' WHERE id_barang={$id}";
    if (mysqli_query($koneksi, $sql)) {
        header('Location: index.php?page=user/list');
        exit;
    } else {
        echo '<p class="error">Gagal update: ' . mysqli_error($koneksi) . '</p>';
    }
}

$res = mysqli_query($koneksi, "SELECT * FROM data_barang WHERE id_barang={$id}");
$data = mysqli_fetch_assoc($res);
if (!$data) {
    echo '<p>Data tidak ditemukan</p>';
    return;
}
?>

<h2>Ubah Barang</h2>
<form method="post" enctype="multipart/form-data">
    <label>Nama Barang<br><input type="text" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" required></label><br>
    <label>Kategori<br><input type="text" name="kategori" value="<?php echo htmlspecialchars($data['kategori']); ?>" required></label><br>
    <label>Gambar saat ini<br>
        <?php if (!empty($data['gambar']) && file_exists(__DIR__ . '/../../uploads/' . $data['gambar'])): ?>
            <img src="<?php echo 'uploads/' . htmlspecialchars($data['gambar']); ?>" style="max-width:100px">
        <?php else: ?>
            <div class="noimg">No Image</div>
        <?php endif; ?>
    </label><br>
    <label>Ganti Gambar<br><input type="file" name="gambar" accept="image/*"></label><br>
    <label>Harga Beli<br><input type="number" name="harga_beli" value="<?php echo $data['harga_beli']; ?>" required></label><br>
    <label>Harga Jual<br><input type="number" name="harga_jual" value="<?php echo $data['harga_jual']; ?>" required></label><br>
    <label>Stok<br><input type="number" name="stok" value="<?php echo $data['stok']; ?>" required></label><br>
    <button type="submit">Update</button>
</form>
<p><a href="index.php?page=user/list">Kembali ke daftar</a></p>