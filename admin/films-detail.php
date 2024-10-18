<?php
$title = "Detail Film";
require 'layout/header.php';

// $films = query("SELECT * FROM films ORDER BY created_at DESC");
$id_film = (int)$_GET['id'];

$film = query("SELECT f.*, c.title AS category_title FROM films f JOIN categories c ON f.category_id = c.id_category WHERE f.id_film = $id_film")[0];

if (!$film) {
    echo "<script>
        alert('Film not found');
        document.location.href = 'films.php';
        </script>";
}


// $film = query("SELECT f.*, c.title AS category_title FROM films f JOIN categories c ON f.category_id = c.id_category WHERE f.id_film = $id_film");

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
                            <table class="table table-striped table-bordered" style="width:100%">
                                <tr>
                                    <th>Vidio</th>
                                    <td><iframe width="560" height="315" src="https://www.youtube.com/embed/tBKOb8Ib5nI?si=j09pTUPywO_xPa8q" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td><?= $film['category_title'] ?></td>
                                </tr>
                                <tr>
                                    <th>Title</th>
                                    <td><?= $film['title'] ?></td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td><?= $film['slug'] ?></td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td><?= $film['description'] ?></td>
                                </tr>
                                <tr>
                                    <th>Release Date</th>
                                    <td><?= $film['release_date'] ?></td>
                                </tr>
                                <tr>
                                    <th>Studio</th>
                                    <td><?= $film['studio'] ?></td>
                                </tr>
                                <tr>
                                    <th>Private</th>
                                    <td><?= $film['is_private'] ? 'Private' : 'Public' ?></td>
                                </tr>
                            </table>
                            <div class="float-end">
                                <a href="films.php" class="btn btn-secondary">Back</a>
                            </div>
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