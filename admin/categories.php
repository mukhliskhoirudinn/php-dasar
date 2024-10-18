<?php
$title = "Categories";
require 'layout/header.php';

// session_start(); // Memastikan sesi dimulai
// Cek apakah pengguna sudah login
if (!isset($_SESSION['login'])) {
    header('Location: login.php'); // Arahkan ke halaman login jika belum login
    exit();
}

$categories = query("SELECT * FROM categories ORDER BY created_at DESC");
?>

<main class="py-5">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php if (isset($_GET['status']) && $_GET['status'] == 'success') : ?>
                    <div id="alert-success" class="alert alert-success" role="alert">
                        Category has been updated successfully.
                    </div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-list-task"></i>
                        <?= $title; ?>
                    </div>
                    <div class="card-body shadow-sm">
                        <div class="table-responsive">
                            <a href="categories-create.php" class="btn btn-primary mb-1"><i class="bi bi-plus"></i>Create</a>
                            <a href="categories-download.php" class="btn btn-success mb-1"><i class="bi bi-download">
                                </i>Download</a>
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="1%" class="text-center">No</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th class="text-center">Create At</th>
                                        <th width="15%" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($categories as $category): ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td><?= $category["title"] ?></td>
                                            <td><?= $category["slug"] ?></td>
                                            <td class="text-center"><?= $category["created_at"] ?></td>
                                            <td class="text-center">
                                                <a href="categories-update.php?id=<?= $category['id_category']; ?>" class="btn btn-sm btn-success" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                                <a href="categories-delete.php?id=<?= $category["id_category"]; ?>" onclick="return confirm('yakin ingin menghapus data? ')" class="btn btn-sm btn-danger" title="Delete"><i class="bi bi-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
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
        }, 1000);
    });
</script>

<?php
require 'layout/footer.php';
?>