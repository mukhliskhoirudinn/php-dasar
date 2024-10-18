<?php
$title = "Users";
require 'layout/header.php';

// session_start(); // Memastikan sesi dimulai

// Cek apakah pengguna sudah login
if (!isset($_SESSION['login'])) {
    header('Location: login.php'); // Arahkan ke halaman login jika belum login
    exit();
}

// Ambil semua pengguna dari database
$users = query("SELECT * FROM users ORDER BY created_at DESC");

// Jika pengguna adalah operator, hanya ambil data mereka sendiri
if ($_SESSION['role'] === 'operator') {
    $users = array_filter($users, function ($user) {
        return $user['id_user'] == $_SESSION['id'];
    });
}
?>

<main class="py-5">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php if (isset($_GET['status']) && $_GET['status'] == 'success') : ?>
                    <div id="alert-success" class="alert alert-success" role="alert">
                        User has been updated successfully.
                    </div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-list-task"></i>
                        <?= $title; ?>
                    </div>
                    <div class="card-body shadow-sm">
                        <div class="table-responsive">
                            <?php if ($_SESSION['role'] === 'admin'): ?>
                                <a href="users-create.php" class="btn btn-primary mb-1"><i class="bi bi-plus"></i>Create</a>
                            <?php endif; ?>
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="1%" class="text-center">No</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th class="text-center">Create At</th>
                                        <th width="15%" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($users as $user): ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td><?= sanitize($user["username"]) ?></td>
                                            <td><?= sanitize($user["email"]) ?></td>
                                            <td class="text-center"><?= sanitize($user["role"]) ?></td>
                                            <td class="text-center"><?= sanitize($user["created_at"]) ?></td>
                                            <td class="text-center">
                                                <?php if ($_SESSION['role'] === 'admin'): ?>
                                                    <a href="users-update.php?id=<?= $user['id_user']; ?>" class="btn btn-sm btn-success" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                                    <!-- Tombol delete hanya tampil jika id_user tidak sama dengan id_user admin -->
                                                    <?php if ($user['id_user'] != $_SESSION['id']): ?>
                                                        <a href="users-delete.php?id=<?= $user["id_user"]; ?>" onclick="return confirm('Yakin ingin menghapus data? ')" class="btn btn-sm btn-danger" title="Delete"><i class="bi bi-trash"></i></a>
                                                    <?php endif; ?>
                                                <?php elseif ($_SESSION['role'] === 'operator' && $_SESSION['id'] == $user['id_user']): ?>
                                                    <a href="users-update.php?id=<?= $user['id_user']; ?>" class="btn btn-sm btn-success" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                                    <!-- Tidak ada tombol delete untuk operator yang melihat data dirinya sendiri -->
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="assets/js/helper.js"></script>

<script>
    // Menyembunyikan alert setelah 5 detik
    $(document).ready(function() {
        setTimeout(function() {
            $('#alert-success').fadeOut('slow');
        }, 5000);
    });
</script>

<?php
require 'layout/footer.php';
?>