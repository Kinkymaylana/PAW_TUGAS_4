<?php
include 'home.php';
include 'config.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Query untuk mendapatkan daftar bunga dari database
$sql = "SELECT * FROM bunga";
$result = $conn->query($sql);
?>

<h2>Daftar Bunga</h2>
<ul>
    <?php
    // Jika ada bunga yang ditemukan
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<li><a href='detail_bunga.php?id=" . $row["id"] . "'>" . htmlspecialchars($row["nama_bunga"]) . "</a></li>";
        }
    } else {
        // Jika tidak ada bunga
        echo "Tidak ada bunga.";
    }
    ?>
</ul>

<?php
// Tutup koneksi
$conn->close();
include 'footer.php';
?>
