<?php
include 'home.php';
include 'config.php';

// Cek apakah pengguna sudah login
if (isset($_SESSION['username'])) {
    echo "<h2>Selamat datang, " . $_SESSION['username'] . "!</h2>";
    echo '<a href="list_bunga.php">Lihat Daftar Bunga</a>';
} else {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

include 'footer.php';
?>
