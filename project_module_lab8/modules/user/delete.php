<?php

include __DIR__ . '/../../config/database.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id > 0) {

    $res = mysqli_query($koneksi, "SELECT gambar FROM data_barang WHERE id_barang={$id}");
    if ($row = mysqli_fetch_assoc($res)) {
        if (!empty($row['gambar']) && file_exists(__DIR__ . '/../../uploads/' . $row['gambar'])) {
            @unlink(__DIR__ . '/../../uploads/' . $row['gambar']);
        }
    }
    mysqli_query($koneksi, "DELETE FROM data_barang WHERE id_barang={$id}");
}
header('Location: index.php?page=user/list');
exit;
?>