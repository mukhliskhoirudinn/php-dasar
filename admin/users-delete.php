<?php
require 'layout/header.php';

// session_start(); // Memastikan sesi dimulai

// Cek apakah pengguna sudah login
if (!isset($_SESSION['login'])) {
    header('Location: login.php'); // Arahkan ke halaman login jika belum login
    exit();
}

// Cek apakah ID pengguna diberikan
if (isset($_GET['id'])) {
    $id_user = (int)$_GET['id']; // Mengonversi ID ke integer untuk keamanan

    // Panggil fungsi untuk menghapus pengguna
    if (delete_user($id_user) > 0) {
        // Jika berhasil menghapus
        echo "<script>
                alert('User has been deleted successfully.');
                document.location.href = 'users.php';
            </script>";
    } else {
        // Jika gagal menghapus
        echo "<script>
                alert('User could not be deleted.');
                document.location.href = 'users.php';
            </script>";
    }
} else {
    // Jika tidak ada ID diberikan
    echo "<script>
            alert('No user ID provided.');
            document.location.href = 'users.php';
        </script>";
}

require 'layout/footer.php';
