<?php
$title = "Update User";
require "layout/header.php";

// session_start(); // Memastikan sesi dimulai

// Cek apakah pengguna sudah login
if (!isset($_SESSION['login'])) {
    header('Location: login.php'); // Arahkan ke halaman login jika belum login
    exit();
}

// Cek apakah pengguna yang ingin di-update adalah pengguna yang sedang login
if ($_SESSION['role'] === 'operator' && $_GET['id'] != $_SESSION['id']) {
    header('Location: users.php'); // Redirect jika operator mencoba meng-update pengguna lain
    exit();
}

// Ambil data pengguna dari database
$id_user = (int)$_GET['id'];
$user = query("SELECT * FROM users WHERE id_user = $id_user")[0];

if (isset($_POST['submit'])) {
    // Update data pengguna
    if (update_user($_POST) > 0) {
        echo "<script>
        alert('User has been updated');
        document.location.href = 'users.php';
        </script>";
    } else {
        echo "<script>
        alert('User has not been updated');
        document.location.href = 'users-update.php?id=$id_user';
        </script>";
    }
}
?>

<main class="py-5">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-pencil-square"></i>
                        <?= $title; ?>
                    </div>
                    <div class="card-body shadow-sm">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="password">Password (Kosongkan jika tidak ingin mengubah)</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="mb-3">
                                <label for="role">Role</label>
                                <select class="form-control" id="role" name="role" required>
                                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                    <option value="operator" <?= $user['role'] == 'operator' ? 'selected' : ''; ?>>Operator</option>
                                </select>
                            </div>
                            <input type="hidden" name="id_user" value="<?= $user['id_user']; ?>">
                            <div>
                                <button type="submit" class="btn btn-primary float-end" name="submit">
                                    <i class="bi bi-upload"></i> Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
require "layout/footer.php";
?>