<?php

include __DIR__ . '/views/header.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'user/list';

$page = preg_replace('/[^a-zA-Z0-9_\/\-]/', '', $page);

$path = __DIR__ . '/modules/' . $page . '.php';

if (file_exists($path)) {
    include $path;
} else {
    echo "<h2>Halaman tidak ditemukan</h2>";
}

include __DIR__ . '/views/footer.php';
?>