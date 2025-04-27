<?php
$host = 'database-1.c07ys2mm8y06.us-east-1.rds.amazonaws.com';
$dbname = 'postgres';
$user = 'postgres';
$pass = 'Mahrozar2814';
$port = 5432;

// Path sertifikat SSL Amazon
$sslcert = '/etc/ssl/certs/rds-combined-ca-bundle.pem';

try {
    $pdo = new PDO(
        "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require;sslrootcert=$sslcert",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]
    );
    echo "✅ Koneksi ke database berhasil!<br><br>";
} catch (PDOException $e) {
    die("❌ Error: " . $e->getMessage());
}

// Query ambil data produk
try {
    $query = 'SELECT * FROM produk';
    $stmt = $pdo->query($query);
    $produk = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("❌ Query Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    Toko Mahrozar
</header>

<h1>Daftar Produk</h1>

<div class="produk-container">
    <?php if (!empty($produk)): ?>
        <?php foreach ($produk as $item): ?>
            <div class="produk-item">
                <img src="<?php echo htmlspecialchars($item['gambar_url']); ?>" alt="<?php echo htmlspecialchars($item['nama']); ?>" class="produk-img">
                <h2><?php echo htmlspecialchars($item['nama']); ?></h2>
                <p>Harga: Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></p>
                <p><?php echo htmlspecialchars($item['deskripsi']); ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Belum ada produk tersedia.</p>
    <?php endif; ?>
</div>

<footer>
    &copy; <?php echo date("Y"); ?> Toko Mahrozar. All rights reserved.
</footer>

</body>
</html>
