<?php
// Tampilkan semua error
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'database-1.c07ys2mm8y06.us-east-1.rds.amazonaws.com';
$dbname = 'postgres'; // karena di RDS-mu Nama DB kosong, pakai default 'postgres'
$user = 'postgres';
$pass = 'Mahrozar2814';
$port = 5432;


try {
    // Membuat koneksi ke PostgreSQL RDS
    $pdo = new PDO(
        "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$pass;sslmode=disable",
        null,
        null,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );

    echo "✅ Koneksi database BERHASIL!<br><br>";

    // Ambil data dari tabel produk
    $query = 'SELECT * FROM produk';
    $stmt = $pdo->query($query);
    $produk = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($produk)) {
        echo "✅ Data produk ditemukan:<br><br>";
        foreach ($produk as $item) {
            echo "- " . htmlspecialchars($item['nama']) . "<br>";
        }
    } else {
        echo "⚠️ Tidak ada data di tabel produk.<br>";
    }

} catch (PDOException $e) {
    echo "❌ Error koneksi atau query: " . $e->getMessage();
}
?>
