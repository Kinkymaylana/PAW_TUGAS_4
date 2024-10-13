<?php
include 'home.php';
include 'config.php';

// Proses registrasi pengguna baru jika form dikirimkan via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash password untuk keamanan

    // Insert data pengguna ke database
    $sql = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $sql->bind_param("ss", $username, $password);

    // Eksekusi query dan cek apakah berhasil
    if ($sql->execute()) {
        echo "Pendaftaran berhasil!";
    } else {
        echo "Error: " . $sql->error;
    }
    
    // Tutup prepared statement dan koneksi
    $sql->close();
    $conn->close();
}
?>

<h2>Register</h2>
<form method="post" action="">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" value="Register">
</form>

<?php include 'footer.php'; ?>
