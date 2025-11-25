<?php

include __DIR__ . '/../../config/database.php';

$sql = "SELECT * FROM data_barang ORDER BY id_barang DESC";
$res = mysqli_query($koneksi, $sql);
?>

<a class="btn" href="index.php?page=user/add">Tambah Barang</a>

<table class="table">
    <thead>
        <tr>
            <th>Gambar</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Harga Jual</th>
            <th>Harga Beli</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
<?php while ($row = mysqli_fetch_assoc($res)): ?>
    <tr>
        <td class="imgcell">
            <?php if (!empty($row['gambar']) && file_exists(__DIR__ . '/../../uploads/' . $row['gambar'])): ?>
                <img src="<?php echo 'uploads/' . htmlspecialchars($row['gambar']); ?>" alt="<?php echo htmlspecialchars($row['nama']); ?>">
            <?php else: ?>
                <div class="noimg">No Image</div>
            <?php endif; ?>
        </td>
        <td><?php echo htmlspecialchars($row['nama']); ?></td>
        <td><?php echo htmlspecialchars($row['kategori']); ?></td>
        <td><?php echo number_format($row['harga_jual'],0,',','.'); ?></td>
        <td><?php echo number_format($row['harga_beli'],0,',','.'); ?></td>
        <td><?php echo (int)$row['stok']; ?></td>
        <td>
            <a href="index.php?page=user/edit&id=<?php echo $row['id_barang']; ?>">Ubah</a> |
            <a href="index.php?page=user/delete&id=<?php echo $row['id_barang']; ?>" onclick="return confirm('Hapus data?')">Hapus</a>
        </td>
    </tr>
<?php endwhile; ?>
    </tbody>
</table>
