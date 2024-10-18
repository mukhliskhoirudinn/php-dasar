<?php
$title = 'Update Category';
require "layout/header.php";

// Mendapatkan data kategori berdasarkan ID
$id = $_GET['id'];
$category = query("SELECT * FROM categories WHERE id_category = $id")[0];

if (isset($_POST['submit'])) {
    if (update_category($_POST) > 0) {
        echo "<script>
        alert('Category has been updated');
        document.location.href = 'categories.php?status=success';
        </script>";
    } else {
        echo "<script>
        alert('Category has not been updated');
        document.location.href = 'categories-update.php?id=$id&status=failed';
        </script>";
    }
}

?>

<main class="py-5">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php if (isset($_GET['status']) && $_GET['status'] == 'failed') : ?>
                    <div id="alert-failed" class="alert alert-danger" role="alert">
                        Update failed. Please try again.
                    </div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-pencil-square"></i>
                        <?= $title; ?>
                    </div>
                    <div class="card-body shadow-sm">
                        <form action="" method="post">
                            <input type="hidden" name="id_category" value="<?= $category['id_category']; ?>">
                            <div class="mb-3">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?= $category['title']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="slug">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" value="<?= $category['slug']; ?>" readonly>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary float-end" name="submit">
                                    <i class="bi bi-upload"> </i>Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="assets/js/helper.js"></script>

<?php
require "layout/footer.php";
?>