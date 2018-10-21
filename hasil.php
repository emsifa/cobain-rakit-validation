<?php

$data = isset($_GET['data']) ? (array) $_GET['data'] : null;

// Kalau nggak ada data kiriman dari submit.php, 
// redirect ke index.php aja
if (!$data) {
    header("Location: index.php");
    exit;
}

?>
<!-- Tampilkan data dalam bentuk RAW -->
<pre><?= print_r($data) ?></pre>
<a href="index.php">Kembali ke formulir</a>
