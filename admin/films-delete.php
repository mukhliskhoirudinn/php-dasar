<?php
require "config/app.php";

// Ambil ID film dari URL
$id_film = $_GET['id'];

// Cek apakah ID valid dan lakukan penghapusan
if (delete_film($id_film) > 0) {
    echo "<script>
        alert('Film has been deleted successfully.');
        document.location.href = 'films.php';
    </script>";
} else {
    echo "<script>
        alert('Failed to delete the film.');
        document.location.href = 'films.php';
    </script>";
}
