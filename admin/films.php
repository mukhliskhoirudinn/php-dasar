<?php
$title = "Film";
require 'layout/header.php';

// session_start(); // Memastikan sesi dimulai

if (!isset($_SESSION['login'])) {
    header('Location: login.php'); // Arahkan ke halaman login jika belum login
    exit();
}

$films = query("SELECT f.id_film, f.title, f.studio, f.is_private, f.created_at, c.title AS category_title FROM films f JOIN categories c ON f.category_id = c.id_category ORDER BY f.created_at DESC");

?>

<main class="py-5">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php if (isset($_GET['status']) && $_GET['status'] == 'success') : ?>
                    <div id="alert-success" class="alert alert-success" role="alert">
                        film has been updated successfully.
                    </div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-film"></i>
                        <?= $title; ?>
                    </div>
                    <div class="card-body shadow-sm">
                        <div class="table-responsive">
                            <a href="films-create.php" class="btn btn-primary mb-1"><i class="bi bi-plus"></i>Create</a>
                            <a href="films-download.php" class="btn btn-success mb-1"><i class="bi bi-download">
                                </i>Download</a>
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="1%" class="text-center">No</th>
                                        <th>Name</th>
                                        <th>Studio</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th class="text-center">Create At</th>
                                        <th width="15%" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($films as $film): ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td><?= $film["title"] ?></td>
                                            <td><?= $film["studio"] ?></td>
                                            <td><?= $film["category_title"] ?></td>
                                            <td><?= $film["is_private"] ? 'private' : 'public' ?></td>
                                            <td class="text-center"><?= $film["created_at"] ?></td>
                                            <td class="text-center">
                                                <a href="films-detail.php?id=<?= $film['id_film']; ?>" class="btn btn-sm btn-secondary" title="Detail"><i class="bi bi-eye"></i></a>
                                                <a href="films-update.php?id=<?= $film['id_film']; ?>" class="btn btn-sm btn-success" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                                <a href="films-delete.php?id=<?= $film["id_film"]; ?>" onclick="return confirm('yakin ingin menghapus data? ')" class="btn btn-sm btn-danger" title="Delete"><i class="bi bi-trash"></i></a>
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