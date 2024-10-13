<?php
session_start();
include 'home.php';
include 'config.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Cek apakah parameter 'id' diberikan
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Menggunakan prepared statement untuk menghindari SQL injection
    $stmt = $conn->prepare("SELECT * FROM bunga WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Jika bunga ditemukan
    if ($result->num_rows > 0) {
        $bunga = $result->fetch_assoc();
    } else {
        echo "Bunga tidak ditemukan.";
        exit();
    }
} else {
    echo "ID bunga tidak diberikan.";
    exit();
}
?>

<h2>Detail Bunga</h2>
<p>Nama: <?= htmlspecialchars($bunga['nama_bunga']) ?></p>
<p>Harga: Rp<?= number_format($bunga['harga'], 0, ',', '.') ?></p>
<p>Deskripsi: <?= htmlspecialchars($bunga['deskripsi']) ?></p>
<a href="list_bunga.php">Kembali ke Daftar Bunga</a>

<?php
// Menutup statement dan koneksi
$stmt->close();
$conn->close();
include 'footer.php';
?>
